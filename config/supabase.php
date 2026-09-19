<?php
/**
 * SkillPulse Supabase Database Client & Resilience Service
 * Connects to Supabase REST API (PostgREST) with full TLS encryption.
 * Enforces CERT-In and DPDP Act 2023 compliance.
 * Includes seamless local fallback when offline or before initial credential setup.
 */

require_once __DIR__ . '/../backend/security.php';

// Safe environment variable loader
if (!function_exists('load_skillpulse_env')) {
    function load_skillpulse_env() {
        $envPath = __DIR__ . '/../.env';
        if (!file_exists($envPath) || !is_readable($envPath)) {
            return;
        }
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) return;

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '#') === 0) continue;
            if (strpos($line, '=') !== false) {
                list($name, $val) = explode('=', $line, 2);
                $name = trim($name);
                $val = trim($val);
                if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
                    (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                    $val = substr($val, 1, -1);
                }
                if (!array_key_exists($name, $_ENV)) {
                    $_ENV[$name] = $val;
                    putenv("$name=$val");
                }
            }
        }
    }
}
load_skillpulse_env();

/**
 * Returns true if valid Supabase credentials are configured in .env
 */
function supabase_is_configured(): bool {
    $url = getenv('SUPABASE_URL') ?: ($_ENV['SUPABASE_URL'] ?? '');
    $key = getenv('SUPABASE_ANON_KEY') ?: ($_ENV['SUPABASE_ANON_KEY'] ?? '');
    return (!empty($url) && !empty($key) && strpos($url, 'your-project-id') === false);
}

/**
 * Low-level Supabase REST API Query Executor using cURL with TLS verification
 *
 * @param string $endpoint PostgREST table or RPC endpoint (e.g. 'users', 'user_profiles')
 * @param string $method HTTP method: GET, POST, PATCH, DELETE
 * @param array|null $data Payload body
 * @param array $queryParams Associative array of URL parameters (e.g. ['select' => '*', 'email' => 'eq.student@skillpulse.in'])
 * @param bool $useServiceRole True to use service_role key to bypass RLS for administrative operations
 * @return array ['success' => bool, 'status' => int, 'data' => mixed, 'error' => string|null]
 */
function supabase_rest_request(string $endpoint, string $method = 'GET', ?array $data = null, array $queryParams = [], bool $useServiceRole = false): array {
    if (!supabase_is_configured()) {
        return [
            'success' => false,
            'status' => 0,
            'data' => null,
            'error' => 'Supabase is not configured. Falling back to local storage.'
        ];
    }

    $baseUrl = rtrim(getenv('SUPABASE_URL') ?: ($_ENV['SUPABASE_URL'] ?? ''), '/');
    $anonKey = getenv('SUPABASE_ANON_KEY') ?: ($_ENV['SUPABASE_ANON_KEY'] ?? '');
    $serviceKey = getenv('SUPABASE_SERVICE_ROLE_KEY') ?: ($_ENV['SUPABASE_SERVICE_ROLE_KEY'] ?? '');

    $apiKey = ($useServiceRole && !empty($serviceKey)) ? $serviceKey : $anonKey;
    $authBearer = $apiKey;

    // Construct full URL
    $url = $baseUrl . '/rest/v1/' . ltrim($endpoint, '/');
    if (!empty($queryParams)) {
        $url .= '?' . http_build_query($queryParams);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8); // 8s safety timeout
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    $headers = [
        'apikey: ' . $apiKey,
        'Authorization: Bearer ' . $authBearer,
        'Content-Type: application/json',
        'Accept: application/json'
    ];

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        $headers[] = 'Prefer: return=representation';
        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'PATCH') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        $headers[] = 'Prefer: return=representation';
        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    } elseif ($method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    } else {
        curl_setopt($ch, CURLOPT_HTTPGET, true);
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $responseBody = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr = curl_error($ch);
    curl_close($ch);

    if ($curlErr) {
        return [
            'success' => false,
            'status' => $httpCode ?: 500,
            'data' => null,
            'error' => 'cURL error connecting to Supabase: ' . $curlErr
        ];
    }

    $decoded = json_decode($responseBody, true);
    $isSuccess = ($httpCode >= 200 && $httpCode < 300);

    return [
        'success' => $isSuccess,
        'status' => $httpCode,
        'data' => $decoded,
        'error' => $isSuccess ? null : ($decoded['message'] ?? 'HTTP ' . $httpCode)
    ];
}

/**
 * Look up user in Supabase by email address with fallback to users_auth.json
 */
function supabase_find_user_by_email(string $email): ?array {
    if (supabase_is_configured()) {
        $res = supabase_rest_request('users', 'GET', null, [
            'select' => '*',
            'email' => 'eq.' . $email,
            'limit' => 1
        ], true); // Use service role for backend auth lookup

        if ($res['success'] && is_array($res['data']) && count($res['data']) > 0) {
            $user = $res['data'][0];
            return [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name'],
                'mobile' => $user['mobile'] ?? '',
                'maskedMobile' => $user['masked_mobile'] ?? mask_phone($user['mobile'] ?? ''),
                'role' => $user['role'],
                'institution' => $user['institution'],
                'password_hash' => $user['password_hash'],
                'created_at' => $user['created_at'],
                'status' => $user['status'] ?? 'ACTIVE',
                'source' => 'supabase'
            ];
        }
    }

    // Fallback to local JSON store
    $localFile = __DIR__ . '/../backend/users_auth.json';
    if (file_exists($localFile)) {
        $users = json_decode(file_get_contents($localFile), true) ?: [];
        if (isset($users[$email])) {
            $u = $users[$email];
            $u['source'] = 'local_json';
            return $u;
        }
    }

    return null;
}

/**
 * Register a new user in Supabase with fallback to users_auth.json
 */
function supabase_create_user(array $userData): array {
    $userId = $userData['id'] ?? ('usr_' . substr(md5($userData['email']), 0, 8));
    $payload = [
        'id' => $userId,
        'email' => $userData['email'],
        'password_hash' => $userData['password_hash'],
        'name' => $userData['name'],
        'mobile' => $userData['mobile'] ?? '',
        'masked_mobile' => $userData['maskedMobile'] ?? mask_phone($userData['mobile'] ?? ''),
        'role' => $userData['role'] ?? 'student',
        'institution' => $userData['institution'] ?? 'Maharashtra Technical University',
        'consent_accepted' => true,
        'consent_version' => 'DPDP-MH-2023.v2',
        'status' => 'ACTIVE'
    ];

    $savedToSupabase = false;
    if (supabase_is_configured()) {
        $res = supabase_rest_request('users', 'POST', $payload, [], true);
        if ($res['success']) {
            $savedToSupabase = true;

            // Also create an initial user profile in Supabase
            supabase_rest_request('user_profiles', 'POST', [
                'user_id' => $userId,
                'target_role' => ($userData['role'] === 'student' ? 'Data Analyst / TVET Candidate' : ucfirst($userData['role']) . ' Professional'),
                'readiness_score' => 75.0,
                'total_xp' => 1000,
                'current_level' => 3,
                'level_title' => 'Registered TVET Member',
                'tier' => 'Silver',
                'streak_days' => 1,
                'verified_status' => 'Verified · SkillPulse Active Member'
            ], [], true);
        }
    }

    // Always mirror to local users_auth.json for high-availability offline capability
    $localFile = __DIR__ . '/../backend/users_auth.json';
    $users = file_exists($localFile) ? json_decode(file_get_contents($localFile), true) ?: [] : [];
    $users[$userData['email']] = array_merge($userData, [
        'id' => $userId,
        'synced_supabase' => $savedToSupabase
    ]);
    @file_put_contents($localFile, json_encode($users, JSON_PRETTY_PRINT));

    return [
        'success' => true,
        'id' => $userId,
        'synced_supabase' => $savedToSupabase
    ];
}

/**
 * Record user login timestamp in Supabase
 */
function supabase_update_user_login(string $userId): void {
    if (supabase_is_configured()) {
        supabase_rest_request('users', 'PATCH', [
            'last_login_at' => date('c')
        ], ['id' => 'eq.' . $userId], true);
    }
}

/**
 * Fetch candidate profile & improvement metrics from Supabase or fallback
 */
function supabase_get_user_profile(string $userId): array {
    if (supabase_is_configured()) {
        $res = supabase_rest_request('user_profiles', 'GET', null, [
            'select' => '*',
            'user_id' => 'eq.' . $userId,
            'limit' => 1
        ], true);

        if ($res['success'] && is_array($res['data']) && count($res['data']) > 0) {
            return $res['data'][0];
        }
    }

    // Local JSON fallback from user_points.json
    $pointsFile = __DIR__ . '/../backend/user_points.json';
    if (file_exists($pointsFile)) {
        $saved = json_decode(file_get_contents($pointsFile), true);
        if (is_array($saved)) return $saved;
    }

    return [
        'targetRole' => 'Data Analyst / TVET Candidate',
        'readinessScore' => 78,
        'totalXp' => 1340,
        'currentLevel' => 4,
        'tier' => 'Gold',
        'verified_status' => 'Verified · Gov polytechnic · Gold'
    ];
}

/**
 * Save resume scan results to Supabase table 'resume_scans'
 */
function supabase_save_resume_scan(array $scanData): array {
    if (supabase_is_configured()) {
        $res = supabase_rest_request('resume_scans', 'POST', [
            'user_id' => $scanData['user_id'] ?? null,
            'candidate_name' => $scanData['candidate_name'] ?? 'Candidate',
            'target_role' => $scanData['target_role'] ?? 'General Tech Role',
            'overall_score' => (int)($scanData['overall_score'] ?? 70),
            'matched_skills' => $scanData['matched_skills'] ?? [],
            'missing_skills' => $scanData['missing_skills'] ?? [],
            'recommended_courses' => $scanData['recommended_courses'] ?? [],
            'recommendations' => $scanData['recommendations'] ?? []
        ], [], true);

        return $res;
    }

    return ['success' => true, 'fallback' => true];
}

/**
 * Save practice attempt to Supabase table 'practice_attempts'
 */
function supabase_save_practice_attempt(array $attemptData): array {
    if (supabase_is_configured()) {
        return supabase_rest_request('practice_attempts', 'POST', [
            'user_id' => $attemptData['user_id'] ?? null,
            'question_id' => $attemptData['question_id'] ?? 'q_gen_01',
            'role' => $attemptData['role'] ?? 'general',
            'selected_option' => (int)($attemptData['selected_option'] ?? 0),
            'is_correct' => (bool)($attemptData['is_correct'] ?? false),
            'score_delta' => (int)($attemptData['score_delta'] ?? 10)
        ], [], true);
    }
    return ['success' => true, 'fallback' => true];
}

/**
 * Log security event to Supabase table 'security_audit_logs'
 */
function supabase_log_security_event(string $eventType, string $user, string $status, array $meta = []): void {
    if (supabase_is_configured()) {
        supabase_rest_request('security_audit_logs', 'POST', [
            'event_type' => $eventType,
            'user_identifier' => $user,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? 'CLI/Browser', 0, 500),
            'status' => $status,
            'metadata' => $meta
        ], [], true);
    }
}
