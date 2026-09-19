<?php
$pageTitle = 'Candidate Dashboard & Point Scoring Engine | SkillPulse TVET';
$pageDesc = 'Personalized career readiness cockpit tracking skill acquisition milestones, activity points, and weekly improvement velocity.';
$activeNav = 'dashboard';
require_once __DIR__ . '/backend/security.php';
apply_government_security_headers();
require_once __DIR__ . '/includes/header.php';
?>

<main id="main-content" style="flex:1;padding:2.5rem 0 4rem 0;" tabindex="-1">
  <div class="container" style="display:flex;flex-direction:column;gap:2.25rem;">

    <!-- Welcome Back Banner Component -->
    <welcome-back-banner 
      id="userWelcomeBanner" 
      name="<?php echo htmlspecialchars($activeUser['name'] ?? 'Aditya'); ?>" 
      target-role="Data Analyst" 
      readiness="78" 
      practice-url="practice.php" 
      retest-url="skill-gap-analyzer.php">
    </welcome-back-banner>


    <!-- Overview Stats Grid Connected to Activity Scoring -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-card-top">
          <span class="stat-card-label">Readiness Score</span>
          <div class="stat-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg></div>
        </div>
        <div class="stat-card-val" id="statReadinessVal" style="color:var(--primary-600);">78%</div>
        <span class="badge badge-success" id="statReadinessGrowth">+16% Growth (All-Time)</span>
        <div class="stat-card-sub">Industry placement benchmark: 80%</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-top">
          <span class="stat-card-label">Total Activity XP</span>
          <div class="stat-card-icon" style="background:var(--cyan-50);color:var(--cyan-600);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div>
        </div>
        <div class="stat-card-val" id="statTotalXpVal" style="color:var(--cyan-600);">1,340 XP</div>
        <span class="badge badge-cyan" id="statLevelBadge">Level 4: Advanced</span>
        <div class="stat-card-sub" id="statNextLevelSub">160 XP to Level 5 (Diamond)</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-top">
          <span class="stat-card-label">Maharashtra State Rank</span>
          <div class="stat-card-icon" style="background:var(--success-bg);color:var(--success);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
        </div>
        <div class="stat-card-val" style="color:var(--success);">Top 8%</div>
        <span class="badge badge-primary">Pune / Mumbai Cohort</span>
        <div class="stat-card-sub">Across 42,000+ TVET candidates</div>
      </div>

      <div class="stat-card">
        <div class="stat-card-top">
          <span class="stat-card-label">Learning Streak</span>
          <div class="stat-card-icon" style="background:var(--warning-bg);color:var(--warning);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg></div>
        </div>
        <div class="stat-card-val" style="color:var(--warning);">12 Days 🔥</div>
        <span class="badge badge-warning">High Consistency</span>
        <div class="stat-card-sub">Bonus multiplier: 1.25x XP</div>
      </div>
    </div>

    <!-- EXPLAINABILITY PANEL: SUB-SCORE BREAKDOWN & RECENT VELOCITY -->
    <div class="card explain-panel-card" style="margin-top:0;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem;margin-bottom:1rem;">
        <div>
          <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;flex-wrap:wrap;">
            <span style="font-size:1.25rem;">📊</span>
            <h2 style="font-size:1.15rem;font-weight:800;color:var(--navy-900);margin:0;">
              Readiness Score Explainability &amp; Sub-Score Breakdown
            </h2>
            <span class="badge badge-success" style="font-size:0.75rem;font-weight:700;">+6.6% Recent Velocity</span>
          </div>
          <p style="font-size:0.8rem;color:var(--navy-500);margin:0;">
            Deterministic breakdown of feature contributions that drove your score from 71.4% to 78.0%:
          </p>
        </div>
        <button type="button" class="btn btn-secondary btn-sm" id="btnToggleWhyScore" style="display:inline-flex;align-items:center;gap:0.4rem;font-size:0.78rem;padding:0.4rem 0.85rem;background:#fff;border-color:var(--border);" aria-expanded="false" aria-controls="aiWhyScorePanel">
          <span>🤖 Why this score? (AI Model)</span>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
      </div>

      <!-- 4 Feature Contribution Bars -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:1rem;margin-top:0.75rem;">
        <div style="background:var(--navy-50);padding:0.85rem 1rem;border-radius:8px;border:1px solid var(--border);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.35rem;font-size:0.8rem;">
            <span style="font-weight:700;color:var(--navy-800);">Technical Practice</span>
            <span style="font-weight:800;color:var(--success);">+2.5%</span>
          </div>
          <div class="contrib-bar-track"><div class="contrib-bar-fill" style="width:38%;background:var(--primary-600);"></div></div>
          <div style="font-size:0.7rem;color:var(--navy-500);margin-top:0.3rem;">20 problems solved (38% contribution)</div>
        </div>

        <div style="background:var(--navy-50);padding:0.85rem 1rem;border-radius:8px;border:1px solid var(--border);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.35rem;font-size:0.8rem;">
            <span style="font-weight:700;color:var(--navy-800);">Bridging Courses</span>
            <span style="font-weight:800;color:var(--success);">+2.0%</span>
          </div>
          <div class="contrib-bar-track"><div class="contrib-bar-fill" style="width:30%;background:var(--cyan-500);"></div></div>
          <div style="font-size:0.7rem;color:var(--navy-500);margin-top:0.3rem;">SQL &amp; Power BI Capstones (30% contribution)</div>
        </div>

        <div style="background:var(--navy-50);padding:0.85rem 1rem;border-radius:8px;border:1px solid var(--border);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.35rem;font-size:0.8rem;">
            <span style="font-weight:700;color:var(--navy-800);">Diagnostic Retests</span>
            <span style="font-weight:800;color:var(--success);">+1.2%</span>
          </div>
          <div class="contrib-bar-track"><div class="contrib-bar-fill" style="width:18%;background:#F59E0B;"></div></div>
          <div style="font-size:0.7rem;color:var(--navy-500);margin-top:0.3rem;">Closed 3 priority trade gaps (18% contribution)</div>
        </div>

        <div style="background:var(--navy-50);padding:0.85rem 1rem;border-radius:8px;border:1px solid var(--border);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.35rem;font-size:0.8rem;">
            <span style="font-weight:700;color:var(--navy-800);">Govt Verification</span>
            <span style="font-weight:800;color:var(--success);">+0.9%</span>
          </div>
          <div class="contrib-bar-track"><div class="contrib-bar-fill" style="width:14%;background:#10B981;"></div></div>
          <div style="font-size:0.7rem;color:var(--navy-500);margin-top:0.3rem;">DigiLocker MSBTE ADV Sync (14% contribution)</div>
        </div>
      </div>

      <!-- Expandable "Why this score?" AI Panel -->
      <div id="aiWhyScorePanel" style="display:none;margin-top:1.25rem;padding:1.25rem;background:linear-gradient(135deg, rgba(37,99,235,0.04), rgba(6,182,212,0.04));border:1.5px dashed var(--primary-500);border-radius:var(--radius-md);">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem;flex-wrap:wrap;gap:0.5rem;">
          <div>
            <span style="font-size:0.72rem;font-weight:700;color:var(--primary-700);text-transform:uppercase;">Isolated Python ML Microservice Inference (FastAPI)</span>
            <div style="font-weight:800;font-size:1.05rem;color:var(--navy-900);" id="aiModelPlacementProb">Estimated Placement Likelihood: 84.4% (Gold Tier)</div>
          </div>
          <span class="badge badge-primary" id="aiModelBadge" style="font-size:0.72rem;">Gradient-Boosted Ridge Regressor</span>
        </div>
        <p style="font-size:0.8rem;color:var(--navy-600);margin:0 0 0.85rem 0;" id="aiModelSummary">
          Based on your activity velocity, 12-day streak, and verified technical capstones, our regression model places you in the <strong>top 8th percentile</strong> of Maharashtra TVET candidates with a 95% confidence interval of [80.2% - 88.6%].
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:0.5rem;" id="aiFeatureTagsContainer">
          <span class="badge" style="background:#fff;border:1px solid var(--border);color:var(--navy-700);font-size:0.72rem;">⚡ Technical Practice: +22.4 pts (High Positive)</span>
          <span class="badge" style="background:#fff;border:1px solid var(--border);color:var(--navy-700);font-size:0.72rem;">📚 Bridging Capstones: +21.3 pts (High Positive)</span>
          <span class="badge" style="background:#fff;border:1px solid var(--border);color:var(--navy-700);font-size:0.72rem;">🎯 Diagnostic Retests: +14.4 pts (Moderate Positive)</span>
          <span class="badge" style="background:#fff;border:1px solid var(--border);color:var(--navy-700);font-size:0.72rem;">🛡️ DigiLocker ADV: +10.3 pts (Verified Trust Seal)</span>
          <span class="badge" style="background:#fff;border:1px solid var(--border);color:var(--navy-700);font-size:0.72rem;">🔥 12-Day Streak: +4.8 pts (Behavioral Multiplier)</span>
        </div>
      </div>
    </div>

    <!-- VISUAL SEPARATION DIVIDER -->
    <div class="dashboard-section-divider"></div>

    <!-- MAIN FEATURE: CANDIDATE POINT SCORING & IMPROVEMENT ENGINE -->
    <section class="card" aria-labelledby="point-scoring-title" style="border:1px solid rgba(59,130,246,0.3);background:radial-gradient(ellipse at top left, rgba(37,99,235,0.06), transparent 70%);">
      
      <!-- Engine Header -->
      <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem;margin-bottom:1.75rem;border-bottom:1px solid var(--border);padding-bottom:1.25rem;">
        <div>
          <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <span style="font-size:1.4rem;">🎯</span>
            <h2 id="point-scoring-title" style="font-size:1.4rem;font-weight:800;color:var(--navy-900);margin:0;">
              Activity Point Scoring &amp; Continuous Improvement Engine
            </h2>
          </div>
          <p style="font-size:0.875rem;color:var(--navy-600);margin:0;max-width:700px;">
            Every quiz attempted, coding problem solved, module completed, and diagnostic assessment taken awards 
            <strong>TVET Experience Points (XP)</strong>. These points directly fuel your <strong>Job Readiness Score</strong> and boost your visibility to recruiters on MahaSwayam.
          </p>
        </div>

        <div style="display:flex;align-items:center;gap:0.75rem;">
          <div style="text-align:right;">
            <div style="font-size:0.75rem;color:var(--navy-500);text-transform:uppercase;font-weight:700;">Current Tier</div>
            <div style="font-size:1.1rem;font-weight:800;color:#F59E0B;" id="tierStatusText">💎 Gold Tier</div>
          </div>
          <div style="width:44px;height:44px;border-radius:10px;background:rgba(245,158,11,0.15);display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
            🏆
          </div>
        </div>
      </div>

      <!-- Level & Progress Bar to Next Tier -->
      <div style="background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);padding:1.5rem;margin-bottom:2rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.75rem;margin-bottom:0.75rem;">
          <div>
            <span style="font-size:1.15rem;font-weight:800;color:var(--navy-900);" id="levelTitleText">
              Level 4: Advanced TVET Practitioner
            </span>
            <span style="font-size:0.8rem;color:var(--navy-500);margin-left:0.5rem;">
              (<span id="levelXpProgressText">1,340 / 1,500 XP</span>)
            </span>
          </div>
          <div style="display:flex;align-items:center;gap:0.5rem;">
            <span class="badge" style="background:rgba(37,99,235,0.15);color:var(--primary-700);font-weight:700;" id="ptsNeededText">
              160 XP to Level 5 (Industry Master)
            </span>
          </div>
        </div>

        <!-- Animated Progress Bar -->
        <div class="progress-track" style="height:14px;border-radius:8px;background:#E2E8F0;overflow:hidden;position:relative;" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" id="progressBarContainer">
          <div class="progress-fill" id="xpProgressBar" style="width:89%;height:100%;background:linear-gradient(90deg, var(--primary-600), var(--cyan-500));border-radius:8px;transition:width 0.6s cubic-bezier(0.4, 0, 0.2, 1);"></div>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:0.6rem;font-size:0.75rem;color:var(--navy-500);">
          <span>Level 4 Milestone (1,000 XP)</span>
          <span style="font-weight:600;color:var(--primary-600);">89% Completed</span>
          <span>Level 5 Milestone (1,500 XP)</span>
        </div>
      </div>

      <!-- 4 Improvement Pillars Grid -->
      <div style="margin-bottom:2rem;">
        <h3 style="font-size:1.05rem;font-weight:700;color:var(--navy-900);margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem;">
          <span>📊</span> Improvement Dimensions Breakdown
        </h3>

        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:1rem;">
          <!-- Pillar 1 -->
          <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius-md);padding:1.1rem;box-shadow:var(--shadow-sm);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span style="font-size:1.2rem;">⚡</span>
              <span class="badge badge-primary" style="font-weight:700;" id="xpDimPractice">420 XP</span>
            </div>
            <div style="font-size:0.9rem;font-weight:700;color:var(--navy-900);margin-bottom:0.25rem;">Technical Practice</div>
            <div style="font-size:0.75rem;color:var(--navy-500);" id="itemsDimPractice">18 challenges &amp; code tests</div>
          </div>

          <!-- Pillar 2 -->
          <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius-md);padding:1.1rem;box-shadow:var(--shadow-sm);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span style="font-size:1.2rem;">📚</span>
              <span class="badge badge-cyan" style="font-weight:700;" id="xpDimCourses">380 XP</span>
            </div>
            <div style="font-size:0.9rem;font-weight:700;color:var(--navy-900);margin-bottom:0.25rem;">Bridging Courses &amp; Labs</div>
            <div style="font-size:0.75rem;color:var(--navy-500);" id="itemsDimCourses">8 capstones &amp; modules</div>
          </div>

          <!-- Pillar 3 -->
          <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius-md);padding:1.1rem;box-shadow:var(--shadow-sm);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span style="font-size:1.2rem;">🎯</span>
              <span class="badge" style="background:rgba(245,158,11,0.15);color:#D97706;font-weight:700;" id="xpDimDiagnostics">320 XP</span>
            </div>
            <div style="font-size:0.9rem;font-weight:700;color:var(--navy-900);margin-bottom:0.25rem;">Diagnostic Retests</div>
            <div style="font-size:0.75rem;color:var(--navy-500);" id="itemsDimDiagnostics">5 alignment gap scans</div>
          </div>

          <!-- Pillar 4 -->
          <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius-md);padding:1.1rem;box-shadow:var(--shadow-sm);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span style="font-size:1.2rem;">🛡️</span>
              <span class="badge badge-success" style="font-weight:700;" id="xpDimVerification">220 XP</span>
            </div>
            <div style="font-size:0.9rem;font-weight:700;color:var(--navy-900);margin-bottom:0.25rem;">Govt Verification &amp; ADV</div>
            <div style="font-size:0.75rem;color:var(--navy-500);" id="itemsDimVerification">DigiLocker MSBTE Sync</div>
          </div>
        </div>
      </div>

      <!-- Weekly Improvement Velocity Visualization -->
      <div style="margin-bottom:2rem;background:#fff;border:1px solid var(--border);border-radius:var(--radius-md);padding:1.5rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.5rem;">
          <div>
            <h3 style="font-size:1.05rem;font-weight:700;color:var(--navy-900);margin:0 0 0.2rem 0;">
              📈 Weekly Readiness Score Trajectory
            </h3>
            <p style="font-size:0.8rem;color:var(--navy-500);margin:0;">
              Correlation between cumulative XP earned and industry job readiness growth over time.
            </p>
          </div>
          <span class="badge badge-success" style="font-size:0.8rem;">+16% Overall Improvement</span>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(140px, 1fr));gap:1rem;text-align:center;">
          <div style="background:var(--navy-50);padding:1rem;border-radius:8px;border:1px solid var(--border);">
            <div style="font-size:0.75rem;color:var(--navy-500);font-weight:600;margin-bottom:0.35rem;">Week 1</div>
            <div style="font-size:1.35rem;font-weight:800;color:var(--navy-700);">62%</div>
            <div style="font-size:0.75rem;color:var(--primary-600);font-weight:600;margin-top:0.25rem;">+180 XP</div>
            <div style="font-size:0.7rem;color:var(--navy-400);margin-top:0.2rem;">Initial Baseline</div>
          </div>

          <div style="background:var(--navy-50);padding:1rem;border-radius:8px;border:1px solid var(--border);">
            <div style="font-size:0.75rem;color:var(--navy-500);font-weight:600;margin-bottom:0.35rem;">Week 2</div>
            <div style="font-size:1.35rem;font-weight:800;color:var(--navy-700);">68%</div>
            <div style="font-size:0.75rem;color:var(--primary-600);font-weight:600;margin-top:0.25rem;">+290 XP</div>
            <div style="font-size:0.7rem;color:var(--navy-400);margin-top:0.2rem;">Practice Sprint</div>
          </div>

          <div style="background:var(--navy-50);padding:1rem;border-radius:8px;border:1px solid var(--border);">
            <div style="font-size:0.75rem;color:var(--navy-500);font-weight:600;margin-bottom:0.35rem;">Week 3</div>
            <div style="font-size:1.35rem;font-weight:800;color:var(--navy-700);">74%</div>
            <div style="font-size:0.75rem;color:var(--primary-600);font-weight:600;margin-top:0.25rem;">+380 XP</div>
            <div style="font-size:0.7rem;color:var(--navy-400);margin-top:0.2rem;">DAX Capstone</div>
          </div>

          <div style="background:rgba(37,99,235,0.06);padding:1rem;border-radius:8px;border:1.5px solid var(--primary-500);">
            <div style="font-size:0.75rem;color:var(--primary-700);font-weight:700;margin-bottom:0.35rem;">Current Week</div>
            <div style="font-size:1.45rem;font-weight:800;color:var(--primary-700);" id="weeklyScoreCurrent">78%</div>
            <div style="font-size:0.75rem;color:var(--primary-700);font-weight:700;margin-top:0.25rem;" id="weeklyXpCurrent">+490 XP</div>
            <div style="font-size:0.7rem;color:var(--success);font-weight:600;margin-top:0.2rem;">🚀 Peak Velocity</div>
          </div>
        </div>
      </div>

      <!-- Live Action Deck: Earn Points Now -->
      <div style="background:linear-gradient(135deg, rgba(37,99,235,0.04), rgba(6,182,212,0.04));border:1px dashed var(--primary-500);border-radius:var(--radius-md);padding:1.5rem;margin-bottom:2rem;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;flex-wrap:wrap;gap:0.5rem;">
          <div>
            <h3 style="font-size:1.05rem;font-weight:700;color:var(--navy-900);margin:0 0 0.2rem 0;">
              ⚡ Log Real-Time Activity &amp; Earn Improvement Points
            </h3>
            <p style="font-size:0.8rem;color:var(--navy-600);margin:0;">
              Click any verified learning action below to simulate active completion and see your score update instantly:
            </p>
          </div>
          <div id="actionFeedbackToast" style="display:none;font-size:0.85rem;font-weight:700;color:var(--success);background:var(--success-bg);padding:0.35rem 0.8rem;border-radius:6px;border:1px solid #86EFAC;"></div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:0.75rem;">
          <button type="button" class="btn btn-secondary" onclick="awardUserXp('practice_challenge')" style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;font-size:0.85rem;background:#fff;border-color:var(--border);">
            <span>⚡ Solve Practice Problem</span>
            <span class="badge badge-primary">+30 XP</span>
          </button>

          <button type="button" class="btn btn-secondary" onclick="awardUserXp('course_module')" style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;font-size:0.85rem;background:#fff;border-color:var(--border);">
            <span>📚 Complete Course Module</span>
            <span class="badge badge-cyan">+45 XP</span>
          </button>

          <button type="button" class="btn btn-secondary" onclick="awardUserXp('diagnostic_retest')" style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;font-size:0.85rem;background:#fff;border-color:var(--border);">
            <span>🎯 Run Gap Diagnostic</span>
            <span class="badge" style="background:rgba(245,158,11,0.2);color:#D97706;">+35 XP</span>
          </button>

          <button type="button" class="btn btn-secondary" onclick="awardUserXp('digilocker_sync')" style="display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;font-size:0.85rem;background:#fff;border-color:var(--border);">
            <span>🛡️ Sync DigiLocker ADV</span>
            <span class="badge badge-success">+50 XP</span>
          </button>
        </div>
      </div>

      <!-- Real-Time Activity & Points Audit Ledger -->
      <div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
          <h3 style="font-size:1.05rem;font-weight:700;color:var(--navy-900);margin:0;display:flex;align-items:center;gap:0.5rem;">
            <span>📜</span> Points &amp; Improvement Activity Ledger
          </h3>
          <span style="font-size:0.75rem;color:var(--navy-500);">Live Timestamped Audit Trail</span>
        </div>

        <div style="display:flex;flex-direction:column;gap:0.6rem;" id="activityLedgerContainer">
          <!-- Rows injected dynamically via JS -->
        </div>
      </div>

    </section>

    <!-- RECOMMENDED NEXT STEPS MODULE (CONTENT-BASED) -->
    <section class="card" aria-labelledby="recommended-steps-title">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.5rem;">
        <div>
          <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <span style="font-size:1.25rem;">🎯</span>
            <h2 id="recommended-steps-title" style="font-size:1.25rem;font-weight:800;color:var(--navy-900);margin:0;">
              Recommended Next Steps
            </h2>
          </div>
          <p style="font-size:0.8rem;color:var(--navy-500);margin:0;">
            Targeted interventions computed from your active skill-gap profile to cross the 80% placement threshold:
          </p>
        </div>
        <span class="badge badge-primary">3 Priority Actions</span>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:1rem;">
        <!-- Step 1 -->
        <div style="background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);padding:1.25rem;display:flex;flex-direction:column;justify-content:space-between;">
          <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span class="badge badge-primary" style="font-size:0.72rem;">High Market Demand</span>
              <span style="font-weight:800;color:var(--success);font-size:0.8rem;">+3.5% Readiness</span>
            </div>
            <h3 style="font-size:0.95rem;font-weight:800;color:var(--navy-900);margin:0 0 0.4rem 0;">
              Enterprise SQL: Indexing &amp; Window Functions
            </h3>
            <p style="font-size:0.78rem;color:var(--navy-600);line-height:1.5;margin:0 0 1rem 0;">
              Identified as a critical requirement in 4,200+ Pune &amp; Mumbai data requisitions. Resume Module 4 to close this priority gap.
            </p>
          </div>
          <a href="courses.php" class="btn btn-primary btn-sm" style="width:100%;justify-content:center;">
            Resume Course (+45 XP)
          </a>
        </div>

        <!-- Step 2 -->
        <div style="background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);padding:1.25rem;display:flex;flex-direction:column;justify-content:space-between;">
          <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span class="badge badge-cyan" style="font-size:0.72rem;">Corporate Screening</span>
              <span style="font-weight:800;color:var(--success);font-size:0.8rem;">+2.5% Readiness</span>
            </div>
            <h3 style="font-size:0.95rem;font-weight:800;color:var(--navy-900);margin:0 0 0.4rem 0;">
              Power BI DAX Aggregations Capstone
            </h3>
            <p style="font-size:0.78rem;color:var(--navy-600);line-height:1.5;margin:0 0 1rem 0;">
              Commands a 28% hiring premium on MahaSwayam. Complete the laboratory practical challenge on executive KPI design.
            </p>
          </div>
          <a href="practice.php" class="btn btn-secondary btn-sm" style="width:100%;justify-content:center;background:#fff;">
            Start Practice (+30 XP)
          </a>
        </div>

        <!-- Step 3 -->
        <div style="background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);padding:1.25rem;display:flex;flex-direction:column;justify-content:space-between;">
          <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;">
              <span class="badge badge-warning" style="font-size:0.72rem;">Diagnostic Gap</span>
              <span style="font-weight:800;color:var(--success);font-size:0.8rem;">+2.0% Readiness</span>
            </div>
            <h3 style="font-size:0.95rem;font-weight:800;color:var(--navy-900);margin:0 0 0.4rem 0;">
              Statistical Inference &amp; Hypothesis Retest
            </h3>
            <p style="font-size:0.78rem;color:var(--navy-600);line-height:1.5;margin:0 0 1rem 0;">
              Retest this competency in the Skill Gap Analyzer to elevate your cohort placement tier from Gold to Diamond.
            </p>
          </div>
          <a href="skill-gap-analyzer.php" class="btn btn-secondary btn-sm" style="width:100%;justify-content:center;background:#fff;">
            Run Gap Retest (+35 XP)
          </a>
        </div>
      </div>
    </section>

    <!-- Enrolled Courses Tracking -->
    <div class="card">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.5rem;">
        <h2 style="font-size:1.25rem;font-weight:800;color:var(--navy-900);margin:0;">Active Bridging Programs</h2>
        <a href="courses.php" class="btn btn-primary btn-sm">Explore More Courses</a>
      </div>
      
      <div style="display:flex;flex-direction:column;gap:1rem;">
        <div style="padding:1.25rem;background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;flex-wrap:wrap;gap:0.5rem;">
            <span style="font-weight:700;color:var(--navy-900);">Enterprise SQL &amp; High-Performance Relational Design</span>
            <span style="font-size:0.875rem;font-weight:700;color:var(--primary-600);" id="courseProgressText">75% Complete</span>
          </div>
          <div class="progress-track" style="margin-bottom:0.75rem;"><div class="progress-fill" style="width:75%;" id="courseProgressBar"></div></div>
          <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.8125rem;color:var(--navy-500);">
            <span>Next: Module 4 - Indexing Strategies &amp; Window Functions</span>
            <a href="courses.php" class="btn btn-primary btn-sm" style="padding:0.25rem 0.6rem;font-size:0.75rem;">Resume Course</a>
          </div>
        </div>

        <div style="padding:1.25rem;background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.5rem;flex-wrap:wrap;gap:0.5rem;">
            <span style="font-weight:700;color:var(--navy-900);">Modern Power BI &amp; Executive Storytelling</span>
            <span style="font-size:0.875rem;font-weight:700;color:var(--primary-600);">40% Complete</span>
          </div>
          <div class="progress-track" style="margin-bottom:0.75rem;"><div class="progress-fill" style="width:40%;"></div></div>
          <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.8125rem;color:var(--navy-500);">
            <span>Next: Module 2 - Calculating DAX Measures &amp; KPIs</span>
            <a href="courses.php" class="btn btn-primary btn-sm" style="padding:0.25rem 0.6rem;font-size:0.75rem;">Resume Course</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<script>
// State Management for Point Scoring Engine
let pointsState = null;

async function loadPointsState() {
  try {
    const res = await fetch('api/points.php');
    const data = await res.json();
    if (data.success && data.data) {
      pointsState = data.data;
      renderPointsUI();
    }
  } catch (err) {
    console.warn('Could not load points from API, using fallback data:', err);
  }
}

function renderPointsUI() {
  if (!pointsState) return;

  // Header & Stats
  const statReadinessVal = document.getElementById('statReadinessVal');
  const heroReadinessText = document.getElementById('heroReadinessText');
  const statTotalXpVal = document.getElementById('statTotalXpVal');
  const levelTitleText = document.getElementById('levelTitleText');
  const statLevelBadge = document.getElementById('statLevelBadge');
  const levelXpProgressText = document.getElementById('levelXpProgressText');
  const ptsNeededText = document.getElementById('ptsNeededText');
  const statNextLevelSub = document.getElementById('statNextLevelSub');
  const tierStatusText = document.getElementById('tierStatusText');
  const badgeCurrentTier = document.getElementById('badgeCurrentTier');
  const xpProgressBar = document.getElementById('xpProgressBar');
  const weeklyScoreCurrent = document.getElementById('weeklyScoreCurrent');
  const weeklyXpCurrent = document.getElementById('weeklyXpCurrent');

  if (statReadinessVal) statReadinessVal.textContent = pointsState.readinessScore + '%';
  if (heroReadinessText) heroReadinessText.textContent = pointsState.readinessScore + '%';
  if (statTotalXpVal) statTotalXpVal.textContent = pointsState.totalXp.toLocaleString() + ' XP';
  if (levelTitleText) levelTitleText.textContent = `Level ${pointsState.currentLevel}: ${pointsState.levelTitle}`;
  if (statLevelBadge) statLevelBadge.textContent = `Level ${pointsState.currentLevel}: ${pointsState.tier}`;
  if (levelXpProgressText) levelXpProgressText.textContent = `${pointsState.totalXp.toLocaleString()} / ${pointsState.nextLevelXp.toLocaleString()} XP`;
  
  const needed = Math.max(0, pointsState.nextLevelXp - pointsState.totalXp);
  if (ptsNeededText) ptsNeededText.textContent = `${needed} XP to Level ${pointsState.currentLevel + 1}`;
  if (statNextLevelSub) statNextLevelSub.textContent = `${needed} XP to Level ${pointsState.currentLevel + 1}`;
  if (tierStatusText) tierStatusText.textContent = `💎 ${pointsState.tier} Tier`;
  if (badgeCurrentTier) badgeCurrentTier.textContent = `${pointsState.tier} Tier (Fast-Track)`;

  // Calculate Progress bar %
  const baseLevelXp = (pointsState.currentLevel - 1) * 500;
  const xpInLevel = pointsState.totalXp - baseLevelXp;
  const levelSpan = pointsState.nextLevelXp - baseLevelXp;
  const pct = Math.min(100, Math.max(5, Math.round((xpInLevel / levelSpan) * 100)));
  if (xpProgressBar) {
    xpProgressBar.style.width = pct + '%';
    document.getElementById('progressBarContainer').setAttribute('aria-valuenow', pct);
  }

  // Dimensions
  if (document.getElementById('xpDimPractice')) document.getElementById('xpDimPractice').textContent = pointsState.dimensions.practice.xp + ' XP';
  if (document.getElementById('itemsDimPractice')) document.getElementById('itemsDimPractice').textContent = pointsState.dimensions.practice.items + ' challenges completed';

  if (document.getElementById('xpDimCourses')) document.getElementById('xpDimCourses').textContent = pointsState.dimensions.courses.xp + ' XP';
  if (document.getElementById('itemsDimCourses')) document.getElementById('itemsDimCourses').textContent = pointsState.dimensions.courses.items + ' modules completed';

  if (document.getElementById('xpDimDiagnostics')) document.getElementById('xpDimDiagnostics').textContent = pointsState.dimensions.diagnostics.xp + ' XP';
  if (document.getElementById('itemsDimDiagnostics')) document.getElementById('itemsDimDiagnostics').textContent = pointsState.dimensions.diagnostics.items + ' gap scans';

  if (document.getElementById('xpDimVerification')) document.getElementById('xpDimVerification').textContent = pointsState.dimensions.verification.xp + ' XP';

  // Weekly
  if (weeklyScoreCurrent) weeklyScoreCurrent.textContent = pointsState.readinessScore + '%';
  if (weeklyXpCurrent && pointsState.weeklyImprovement[3]) weeklyXpCurrent.textContent = '+' + pointsState.weeklyImprovement[3].xp + ' XP';

  // Synchronize Welcome Back Banner
  const welcomeBannerEl = document.getElementById('userWelcomeBanner');
  if (welcomeBannerEl && pointsState.readinessScore !== undefined) {
    welcomeBannerEl.readiness = pointsState.readinessScore;
  }

  // Render Ledger
  const ledgerContainer = document.getElementById('activityLedgerContainer');
  if (ledgerContainer && pointsState.activityLedger) {
    ledgerContainer.innerHTML = pointsState.activityLedger.map(item => `
      <div style="display:flex;justify-content:space-between;align-items:center;background:#fff;border:1px solid var(--border);border-radius:8px;padding:0.75rem 1rem;font-size:0.85rem;box-shadow:var(--shadow-sm);">
        <div style="display:flex;align-items:center;gap:0.75rem;">
          <span style="font-weight:700;color:var(--primary-600);background:rgba(37,99,235,0.1);padding:2px 8px;border-radius:4px;font-size:0.8rem;">
            +${item.xp} XP
          </span>
          <div>
            <div style="font-weight:600;color:var(--navy-900);">${item.title}</div>
            <div style="font-size:0.72rem;color:var(--navy-500);">${item.category} • ${item.time}</div>
          </div>
        </div>
        <span class="badge badge-success" style="font-size:0.75rem;">${item.impact}</span>
      </div>
    `).join('');
  }
}

async function awardUserXp(actionType) {
  const toast = document.getElementById('actionFeedbackToast');
  try {
    const res = await fetch('api/points.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ actionType })
    });
    const result = await res.json();
    if (result.success && result.data) {
      pointsState = result.data;
      renderPointsUI();

      if (toast) {
        toast.style.display = 'inline-block';
        toast.textContent = `✓ ${result.message} (${result.newActivity.impact})`;
        setTimeout(() => { toast.style.display = 'none'; }, 3500);
      }
    }
  } catch (err) {
    console.error('Error awarding XP:', err);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Check if candidate name is stored in localStorage from signin/register
  const savedUser = localStorage.getItem('skillpulse_user');
  if (savedUser) {
    try {
      const u = JSON.parse(savedUser);
      if (u.name) {
        const nameEl = document.getElementById('candidateDisplayName');
        if (nameEl) nameEl.textContent = u.name.split(' ')[0];
        const welcomeBannerEl = document.getElementById('userWelcomeBanner');
        if (welcomeBannerEl) welcomeBannerEl.name = u.name.split(' ')[0];
      }
    } catch(e) {}
  }

  // Why this score AI explainability modal toggle
  const btnToggleWhyScore = document.getElementById('btnToggleWhyScore');
  const aiWhyScorePanel = document.getElementById('aiWhyScorePanel');
  if (btnToggleWhyScore && aiWhyScorePanel) {
    btnToggleWhyScore.addEventListener('click', async () => {
      const isClosed = aiWhyScorePanel.style.display === 'none';
      aiWhyScorePanel.style.display = isClosed ? 'block' : 'none';
      btnToggleWhyScore.setAttribute('aria-expanded', isClosed ? 'true' : 'false');

      if (isClosed) {
        try {
          const res = await fetch('api/ai.php?action=predict_readiness', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              activity_xp: pointsState ? pointsState.totalXp : 1340,
              readiness_score: pointsState ? pointsState.readinessScore : 78,
              streak_days: pointsState ? pointsState.streakDays : 12,
              dimensions: pointsState ? pointsState.dimensions : null
            })
          });
          const result = await res.json();
          if (result.success && result.data) {
            const d = result.data;
            const probEl = document.getElementById('aiModelPlacementProb');
            const badgeEl = document.getElementById('aiModelBadge');
            const tagsEl = document.getElementById('aiFeatureTagsContainer');

            if (probEl) probEl.textContent = `Estimated Placement Likelihood: ${d.predicted_placement_probability}% (${d.placement_tier})`;
            if (badgeEl) badgeEl.textContent = `${d.model_type} (${result.source})`;
            if (tagsEl && d.feature_importances) {
              tagsEl.innerHTML = d.feature_importances.map(f => 
                `<span class="badge" style="background:#fff;border:1px solid var(--border);color:var(--navy-700);font-size:0.72rem;">` +
                `${f.feature}: +${f.contribution_pts} pts (${f.impact})</span>`
              ).join(' ');
            }
          }
        } catch(err) {
          console.warn('AI explainability fetch:', err);
        }
      }
    });
  }

  loadPointsState();
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
