<?php
$pageTitle = 'Practice Arena | React & PHP Technical Interview Prep';
$pageDesc = 'Simulate real corporate technical screening exams with curated questions from TCS, Infosys, Google, and top employers using React 18 & PHP.';
$activeNav = 'practice';
require_once __DIR__ . '/includes/header.php';
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2rem;">

    <!-- Title -->
    <div>
      <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;">
        <span class="badge badge-success">Verified Corporate Question Bank</span>
        <span class="badge badge-primary">React 18 Quiz Engine</span>
      </div>
      <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Interview &amp; Screening Practice Arena</h1>
      <p style="color:var(--navy-600);font-size:0.95rem;margin-top:0.25rem;">
        Test your conceptual knowledge against real screening questions used by Indian IT enterprises and tech startups.
      </p>
    </div>

    <!-- React Mount Root -->
    <div id="reactPracticeRoot">
      <div class="card" style="padding:3rem;text-align:center;">
        <div class="live-pulse-dot" style="margin-bottom:1rem;"></div>
        <p style="color:var(--navy-600);font-weight:600;">Loading React 18 Practice Arena &amp; Question Engine...</p>
      </div>
    </div>

  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
