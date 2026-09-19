<?php
$pageTitle = 'Industry Mentors | SkillPulse 1-on-1 Advisory';
$pageDesc = 'Connect with verified engineers, data leads, and recruiters for 1-on-1 resume reviews, mock interviews, and career guidance.';
$activeNav = 'experts';
require_once __DIR__ . '/includes/header.php';

$mentors = [
  [
    'id' => 'm1',
    'name' => 'Priyanka Sen',
    'role' => 'Staff ML Engineer @ Amazon AWS',
    'domain' => 'AI & Data Science',
    'experience' => '9+ Years',
    'rating' => '4.95 ★ (140+ sessions)',
    'bio' => 'Specializes in LLM deployment, NLP pipelines, and transitioning academic students into enterprise AI roles.',
    'skills' => ['Python', 'LLMOps', 'PyTorch', 'System Design']
  ],
  [
    'id' => 'm2',
    'name' => 'Rohit Kulkarni',
    'role' => 'Principal Software Architect @ Microsoft',
    'domain' => 'Backend & Cloud',
    'experience' => '12+ Years',
    'rating' => '4.98 ★ (220+ sessions)',
    'bio' => 'Ex-startup CTO. Deep experience in high-throughput distributed architectures and mentoring junior developers.',
    'skills' => ['Node.js', 'PostgreSQL', 'Docker', 'Kubernetes']
  ],
  [
    'id' => 'm3',
    'name' => 'Sneha Deshmukh',
    'role' => 'Lead Frontend Engineer @ Swiggy',
    'domain' => 'Web & UI Systems',
    'experience' => '7+ Years',
    'rating' => '4.90 ★ (95+ sessions)',
    'bio' => 'Passionate about component design systems, React performance, and modern CSS layout architectures.',
    'skills' => ['React.js', 'Next.js', 'Tailwind CSS', 'JavaScript']
  ]
];
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <div>
      <span class="badge badge-primary" style="margin-bottom:0.5rem;">1-on-1 Career Advisory</span>
      <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Verified Industry Mentors</h1>
      <p style="color:var(--navy-600);font-size:0.95rem;margin-top:0.25rem;">
        Get direct personalized feedback on your portfolio, mock technical rounds, and insights on overcoming specific skill gaps.
      </p>
    </div>

    <!-- Mentors Grid (PHP Rendered) -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:1.5rem;">
      <?php foreach ($mentors as $m): ?>
        <div class="card" style="display:flex;flex-direction:column;justify-content:space-between;padding:1.75rem;">
          <div>
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.75rem;">
              <div>
                <h3 style="font-size:1.2rem;font-weight:800;color:var(--navy-900);"><?php echo htmlspecialchars($m['name']); ?></h3>
                <p style="font-size:0.875rem;font-weight:600;color:var(--primary-600);"><?php echo htmlspecialchars($m['role']); ?></p>
              </div>
              <span class="badge badge-success">Verified Mentor</span>
            </div>

            <p style="font-size:0.875rem;color:var(--navy-600);margin:0.75rem 0 1rem 0;line-height:1.5;"><?php echo htmlspecialchars($m['bio']); ?></p>

            <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
              <?php foreach ($m['skills'] as $sk): ?>
                <span class="badge badge-navy"><?php echo htmlspecialchars($sk); ?></span>
              <?php endforeach; ?>
            </div>
          </div>

          <div style="padding-top:1rem;border-top:1px solid var(--border-light);display:flex;align-items:center;justify-content:space-between;">
            <div style="font-size:0.8125rem;color:var(--navy-500);">
              <div style="font-weight:700;color:var(--warning);"><?php echo htmlspecialchars($m['rating']); ?></div>
              <div><?php echo htmlspecialchars($m['experience']); ?> Experience</div>
            </div>
            <button class="btn btn-primary btn-sm" onclick="openMentorModal('<?php echo htmlspecialchars($m['name']); ?>')">Book Free Slot</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</main>

<!-- Booking Modal -->
<div class="modal-backdrop" id="mentorModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3 id="modalMentorName" style="font-size:1.2rem;font-weight:800;color:var(--navy-900);">Schedule Mentorship</h3>
      <button style="background:none;border:none;cursor:pointer;" data-close-modal>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div style="display:flex;flex-direction:column;gap:1rem;">
        <div>
          <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.35rem;">Session Objective:</label>
          <select id="sessionType" style="width:100%;padding:0.625rem;border:1px solid var(--border);border-radius:var(--radius-md);font-size:0.875rem;">
            <option>Skill Gap Review &amp; Learning Plan (30 Min)</option>
            <option>Mock Technical Interview &amp; Live Coding (45 Min)</option>
            <option>Resume &amp; Project Portfolio Audit (30 Min)</option>
          </select>
        </div>
        <div>
          <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.35rem;">Preferred Date &amp; Slot:</label>
          <input type="datetime-local" style="width:100%;padding:0.625rem;border:1px solid var(--border);border-radius:var(--radius-md);font-size:0.875rem;" />
        </div>
        <div>
          <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.35rem;">Your Question or Context:</label>
          <textarea placeholder="e.g. Preparing for Data Analyst roles, need advice on bridging SQL gaps..." rows="3" style="width:100%;padding:0.625rem;border:1px solid var(--border);border-radius:var(--radius-md);font-size:0.875rem;"></textarea>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary btn-sm" data-close-modal>Cancel</button>
      <button class="btn btn-primary btn-sm" id="btnConfirmBooking">Confirm Mentorship Session</button>
    </div>
  </div>
</div>

<script>
  function openMentorModal(name) {
    document.getElementById('modalMentorName').textContent = `Book Session with ${name}`;
    SkillPulse.openModal('mentorModal');
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnConfirmBooking').addEventListener('click', () => {
      SkillPulse.closeModal('mentorModal');
      SkillPulse.toast('Mentorship session confirmed! Google Meet link sent to your email.', 'success');
    });
  });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
