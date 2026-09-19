<?php
$pageTitle = 'Courses | SkillPulse Bridging Academy';
$pageDesc = 'Curated industry bridging courses designed specifically to close identified skill gaps and raise readiness scores.';
$activeNav = 'courses';
require_once __DIR__ . '/includes/header.php';

$sampleCourses = [
  [
    'id' => 'c1',
    'title' => 'Applied Generative AI & Vector Search Engineering',
    'category' => 'AI & Data',
    'instructor' => 'Dr. Vikram Rao (Lead AI Scientist, Ex-Google)',
    'duration' => '6 Weeks (Self-paced)',
    'difficulty' => 'Intermediate',
    'rating' => 4.9,
    'enrolled' => 3420,
    'description' => 'Master RAG pipelines, fine-tuning LLMs with LoRA, LangChain agents, and vector databases for enterprise workloads.',
    'skills' => ['Python', 'LangChain', 'Pinecone', 'PyTorch']
  ],
  [
    'id' => 'c2',
    'title' => 'Enterprise SQL & High-Performance Relational Design',
    'category' => 'AI & Data',
    'instructor' => 'Anjali Sharma (Principal Data Architect)',
    'duration' => '4 Weeks',
    'difficulty' => 'Beginner-Intermediate',
    'rating' => 4.8,
    'enrolled' => 5120,
    'description' => 'Deep dive into complex window queries, indexing strategies, PostgreSQL execution plan optimization, and dimensional modeling.',
    'skills' => ['SQL', 'PostgreSQL', 'Query Tuning', 'Schema Design']
  ],
  [
    'id' => 'c3',
    'title' => 'Production React 19 & Next.js Full Stack Systems',
    'category' => 'Web Development',
    'instructor' => 'Karan Mehta (Staff Frontend Architect)',
    'duration' => '8 Weeks',
    'difficulty' => 'Intermediate',
    'rating' => 4.9,
    'enrolled' => 4280,
    'description' => 'Build enterprise-grade SaaS platforms utilizing React Server Components, state architectures, and Tailwind design systems.',
    'skills' => ['React.js', 'Next.js', 'Tailwind CSS', 'REST APIs']
  ],
  [
    'id' => 'c4',
    'title' => 'Cloud Infrastructure & Kubernetes DevOps Accelerator',
    'category' => 'Cloud & DevOps',
    'instructor' => 'Pooja Iyer (Certified AWS Solutions Architect)',
    'duration' => '7 Weeks',
    'difficulty' => 'Advanced',
    'rating' => 4.8,
    'enrolled' => 2890,
    'description' => 'Automate zero-downtime microservice deployments with Docker, Kubernetes, Helm, Terraform, and GitHub Actions.',
    'skills' => ['AWS', 'Docker', 'Kubernetes', 'CI/CD']
  ],
  [
    'id' => 'c5',
    'title' => 'Zero-Trust Cybersecurity & Cloud Defensive Operations',
    'category' => 'Cybersecurity',
    'instructor' => 'Col. Rajesh Verma (Retd. Defense Cyber Consultant)',
    'duration' => '6 Weeks',
    'difficulty' => 'Intermediate-Advanced',
    'rating' => 4.9,
    'enrolled' => 1980,
    'description' => 'Defend distributed systems against OWASP top threats, implement token verification, and configure network isolation.',
    'skills' => ['Network Security', 'OWASP Top 10', 'JWT Auth']
  ],
  [
    'id' => 'c6',
    'title' => 'Modern Power BI & Executive Business Storytelling',
    'category' => 'AI & Data',
    'instructor' => 'Sneha Patel (BI Lead, Deloitte)',
    'duration' => '4 Weeks',
    'difficulty' => 'Beginner',
    'rating' => 4.7,
    'enrolled' => 6200,
    'description' => 'Transform raw data into impactful executive dashboards using DAX calculations, interactive drill-downs, and storytelling best practices.',
    'skills' => ['Power BI', 'DAX', 'Data Modeling']
  ]
];
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <!-- Header & Filter Chips -->
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1.5rem;">
      <div>
        <span class="badge badge-primary" style="margin-bottom:0.5rem;">Targeted Upskilling</span>
        <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Industry-Aligned Bridging Courses</h1>
        <p style="color:var(--navy-600);font-size:0.95rem;margin-top:0.25rem;">
          Directly mapped to missing competencies identified in your Skill Gap assessment.
        </p>
      </div>

      <div style="display:flex;gap:0.5rem;flex-wrap:wrap;" id="courseFilterChips">
        <button class="chip active" data-cat="all">All Domains</button>
        <button class="chip" data-cat="AI & Data">AI &amp; Data</button>
        <button class="chip" data-cat="Web Development">Web Development</button>
        <button class="chip" data-cat="Cloud & DevOps">Cloud &amp; DevOps</button>
        <button class="chip" data-cat="Cybersecurity">Cybersecurity</button>
      </div>
    </div>

    <!-- Courses Grid (PHP Rendered with Client Filter) -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:1.5rem;" id="coursesGrid">
      <?php foreach ($sampleCourses as $c): ?>
        <div class="card course-card-item" data-category="<?php echo htmlspecialchars($c['category']); ?>" style="display:flex;flex-direction:column;justify-content:space-between;padding:1.5rem;">
          <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem;">
              <span class="badge badge-primary"><?php echo htmlspecialchars($c['category']); ?></span>
              <span style="font-size:0.8125rem;font-weight:700;color:var(--warning);">★ <?php echo htmlspecialchars($c['rating']); ?> (<?php echo number_format($c['enrolled']); ?>)</span>
            </div>
            <h3 style="font-size:1.15rem;font-weight:800;color:var(--navy-900);line-height:1.35;margin-bottom:0.5rem;"><?php echo htmlspecialchars($c['title']); ?></h3>
            <p style="font-size:0.8125rem;color:var(--navy-500);margin-bottom:0.75rem;">By <?php echo htmlspecialchars($c['instructor']); ?></p>
            <p style="font-size:0.875rem;color:var(--navy-600);line-height:1.5;margin-bottom:1rem;"><?php echo htmlspecialchars($c['description']); ?></p>
            <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-bottom:1.25rem;">
              <?php foreach ($c['skills'] as $sk): ?>
                <span class="badge badge-navy"><?php echo htmlspecialchars($sk); ?></span>
              <?php endforeach; ?>
            </div>
          </div>

          <div style="padding-top:1rem;border-top:1px solid var(--border-light);display:flex;align-items:center;justify-content:space-between;">
            <span style="font-size:0.8125rem;font-weight:600;color:var(--navy-500);">⏱ <?php echo htmlspecialchars($c['duration']); ?></span>
            <button class="btn btn-primary btn-sm" onclick="openEnrollModal('<?php echo htmlspecialchars($c['title']); ?>', '<?php echo htmlspecialchars($c['instructor']); ?>')">Enroll Now</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</main>

<!-- Course Modal -->
<div class="modal-backdrop" id="courseModal">
  <div class="modal-box">
    <div class="modal-header">
      <h3 id="modalCourseTitle" style="font-size:1.2rem;font-weight:800;color:var(--navy-900);">Enroll in Course</h3>
      <button style="background:none;border:none;cursor:pointer;" data-close-modal>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
      </button>
    </div>
    <div class="modal-body" id="modalCourseBody">
      <!-- Injected -->
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary btn-sm" data-close-modal>Close</button>
      <button class="btn btn-primary btn-sm" id="btnConfirmEnroll">Confirm Free Enrollment</button>
    </div>
  </div>
</div>

<script>
  function openEnrollModal(title, instructor) {
    document.getElementById('modalCourseTitle').textContent = title;
    document.getElementById('modalCourseBody').innerHTML = `
      <div style="font-size:0.875rem;color:var(--navy-600);line-height:1.6;margin-bottom:1rem;">
        <strong>Lead Instructor:</strong> ${instructor}<br>
        <strong>Curriculum Innovation:</strong> Directly credits towards the National TVET Placement Passport &amp; MahaSwayam Candidate Registry.
      </div>
      <div style="background:var(--navy-50);padding:1rem;border-radius:var(--radius-md);margin-bottom:1rem;">
        <div style="font-weight:700;font-size:0.875rem;color:var(--navy-900);margin-bottom:0.5rem;">Syllabus Modules:</div>
        <ul style="padding-left:1.25rem;font-size:0.8125rem;color:var(--navy-700);display:flex;flex-direction:column;gap:0.25rem;">
          <li>Hands-on Industry Pipeline Case Study</li>
          <li>Production Deployment and Performance Tuning</li>
          <li>Capstone Project Evaluation with Peer Review</li>
        </ul>
      </div>
      <p style="font-size:0.8125rem;color:var(--success);font-weight:600;">✓ Fully Sponsored for registered students &amp; TVET candidates.</p>
    `;
    SkillPulse.openModal('courseModal');
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('btnConfirmEnroll').addEventListener('click', () => {
      SkillPulse.closeModal('courseModal');
      SkillPulse.toast('Enrolled successfully! Added to your Dashboard.', 'success');
    });

    const chips = document.getElementById('courseFilterChips');
    const cards = document.querySelectorAll('.course-card-item');

    chips.addEventListener('click', (e) => {
      const btn = e.target.closest('.chip');
      if (!btn) return;

      chips.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
      btn.classList.add('active');
      const cat = btn.dataset.cat;

      cards.forEach(card => {
        if (cat === 'all' || card.dataset.category === cat) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
