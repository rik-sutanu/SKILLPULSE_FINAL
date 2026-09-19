<?php
$pageTitle = 'Curriculum Alignment Simulator | React & PHP Institutional Engine';
$pageDesc = 'Simulate how adding industry-relevant elective modules elevates institutional placement and syllabus alignment.';
$activeNav = 'curriculum';
require_once __DIR__ . '/includes/header.php';
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <!-- Title -->
    <div>
      <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;">
        <span class="badge badge-cyan">Higher Education &amp; TVET Module</span>
        <span class="badge badge-primary">React 18 Interactive State Engine</span>
      </div>
      <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Interactive Curriculum Alignment Simulator</h1>
      <p style="color:var(--navy-600);font-size:0.95rem;max-width:750px;margin-top:0.25rem;">
        Higher education and TVET curricula are updated once every 3-4 years, creating severe graduate mismatches. Use this simulator to audit your syllabus against 2026 industry demand and test the quantifiable impact of introducing new elective modules.
      </p>
    </div>

    <!-- React Mount Root -->
    <div id="reactCurriculumRoot">
      <div class="card" style="padding:3rem;text-align:center;">
        <div class="live-pulse-dot" style="margin-bottom:1rem;"></div>
        <p style="color:var(--navy-600);font-weight:600;">Loading React 18 Curriculum Simulation Sandbox...</p>
      </div>
    </div>

  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
