<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../backend/data.php';
$data = getSkillPulseData();

$questions = $data['PRACTICE_QUESTIONS'] ?? [];
$roleFilter = $_GET['role'] ?? 'all';

if ($roleFilter !== 'all' && !empty($roleFilter)) {
    $questions = array_values(array_filter($questions, function($q) use ($roleFilter) {
        return strcasecmp($q['role'] ?? '', $roleFilter) === 0;
    }));
}

echo json_encode([
    'success' => true,
    'total' => count($questions),
    'filter' => $roleFilter,
    'questions' => $questions,
    'timestamp' => date('c')
], JSON_PRETTY_PRINT);
