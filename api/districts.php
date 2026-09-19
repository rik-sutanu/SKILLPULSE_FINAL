<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../backend/data.php';
$data = getSkillPulseData();

echo json_encode([
    'success' => true,
    'state' => 'Maharashtra',
    'governmentMetrics' => $data['MAHARASHTRA_GOVT_METRICS'] ?? [],
    'districts' => $data['MAHARASHTRA_DISTRICTS'] ?? [],
    'portals' => $data['GOVT_PORTALS'] ?? [],
    'timestamp' => date('c')
], JSON_PRETTY_PRINT);
