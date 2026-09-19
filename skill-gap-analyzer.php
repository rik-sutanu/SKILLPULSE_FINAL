<?php
$pageTitle = 'Skill Gap Analyzer | React & PHP Diagnostic Engine';
$pageDesc = 'Calculate your Job Readiness Score in real-time using our React 18 frontend connected to PHP 8.3 REST calculation endpoints.';
$activeNav = 'analyzer';
require_once __DIR__ . '/includes/header.php';
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2rem;">

    <!-- Header Section -->
    <div>
      <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;">
        <span class="badge badge-primary">React 18 Micro-Frontend</span>
        <span class="badge badge-navy">Powered by PHP 8.3 /api/skill-gap.php</span>
      </div>
      <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Job Readiness &amp; Skill Gap Calculator</h1>
      <p style="color:var(--navy-600);font-size:0.95rem;max-width:720px;margin-top:0.25rem;">
        Select your target career track and toggle your competencies. The React state engine communicates with the PHP backend to dynamically calculate your employer alignment score and priority gaps.
      </p>
    </div>

    <!-- React Mount Root -->
    <div id="reactSkillGapRoot">
      <div class="card" style="padding:3rem;text-align:center;">
        <div class="live-pulse-dot" style="margin-bottom:1rem;"></div>
        <p style="color:var(--navy-600);font-weight:600;">Initializing React 18 Skill Gap Diagnostic Engine...</p>
      </div>
    </div>

  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
