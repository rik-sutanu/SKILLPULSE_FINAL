<?php
/**
 * SkillPulse Vercel Serverless Function Dispatcher / API Entry Point
 */
header('Content-Type: application/json; charset=utf-8');

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$route = $_GET['route'] ?? basename($uri);

echo json_encode([
    'service' => 'SkillPulse API Service',
    'status' => 'operational',
    'version' => '2.0.0',
    'endpoints' => [
        'auth' => '/api/auth.php',
        'config' => '/api/config.php',
        'skills' => '/api/skills.php',
        'jobs' => '/api/jobs.php',
        'districts' => '/api/districts.php',
        'resume_scanner' => '/api/resume-scanner.php',
        'skill_gap' => '/api/skill-gap.php',
        'curriculum' => '/api/curriculum.php',
        'ai' => '/api/ai.php',
        'practice' => '/api/practice.php',
        'points' => '/api/points.php'
    ],
    'timestamp' => date('c')
], JSON_PRETTY_PRINT);
