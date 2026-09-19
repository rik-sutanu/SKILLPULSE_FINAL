<?php
$pageTitle = 'Career Roadmap | SkillPulse Milestone Pathways';
$pageDesc = 'Step-by-step career milestone pathways designed by industry practitioners to guide you from foundational to production readiness.';
$activeNav = 'roadmap';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/backend/data.php';
$data = getSkillPulseData();
$roles = $data['JOB_ROLES'] ?? [];
$firstRole = $roles[0] ?? null;
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <!-- Header -->
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1.5rem;">
      <div>
        <span class="badge badge-primary" style="margin-bottom:0.5rem;">Structured Milestones</span>
        <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Industry Career Roadmaps</h1>
        <p style="color:var(--navy-600);font-size:0.95rem;margin-top:0.25rem;">
          Step-by-step milestones built to transition students and career switchers directly into hiring pipeline readiness.
        </p>
      </div>

      <div style="display:flex;align-items:center;gap:0.75rem;">
        <label style="font-size:0.875rem;font-weight:700;color:var(--navy-800);">Select Track:</label>
        <select id="roadmapTrackSelect" style="padding:0.625rem 1rem;border:1.5px solid var(--border);border-radius:var(--radius-md);font-weight:600;color:var(--navy-900);background:#fff;outline:none;cursor:pointer;">
          <?php foreach ($roles as $r): ?>
            <option value="<?php echo htmlspecialchars($r['id']); ?>"><?php echo htmlspecialchars($r['title']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- Roadmap Header Card -->
    <div class="card" id="trackHeaderCard" style="background:linear-gradient(135deg, var(--navy-900), var(--navy-800));color:#fff;">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem;">
        <div>
          <span class="badge badge-cyan" style="margin-bottom:0.5rem;">Target Specialization</span>
          <h2 style="font-size:1.6rem;font-weight:800;color:#fff;"><?php echo htmlspecialchars($firstRole['title'] ?? 'Role Track'); ?></h2>
          <p style="color:#CBD5E1;max-width:640px;font-size:0.95rem;margin-top:0.35rem;"><?php echo htmlspecialchars($firstRole['description'] ?? ''); ?></p>
        </div>
        <div style="text-align:right;">
          <span style="font-size:0.75rem;color:#94A3B8;display:block;">Median Compensation</span>
          <span style="font-size:1.25rem;font-weight:800;color:var(--cyan-400);"><?php echo htmlspecialchars($firstRole['salaryRange'] ?? ''); ?></span>
        </div>
      </div>
    </div>

    <!-- Steps Timeline -->
    <div id="roadmapStepsContainer" style="display:flex;flex-direction:column;gap:1.25rem;">
      <?php if ($firstRole && isset($firstRole['recommendedPath'])): ?>
        <?php foreach ($firstRole['recommendedPath'] as $step): ?>
          <div class="card" style="display:flex;align-items:flex-start;gap:1.25rem;padding:1.5rem;">
            <div style="width:40px;height:40px;border-radius:12px;background:var(--primary-50);color:var(--primary-600);font-weight:800;font-size:1.1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <?php echo $step['step']; ?>
            </div>
            <div style="flex:1;">
              <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:0.5rem;">
                <h3 style="font-size:1.1rem;font-weight:700;color:var(--navy-900);"><?php echo htmlspecialchars($step['title']); ?></h3>
                <div style="display:flex;gap:0.5rem;align-items:center;">
                  <span class="badge badge-navy">⏱ <?php echo htmlspecialchars($step['time']); ?></span>
                  <span class="badge <?php echo strpos($step['difficulty'], 'Advanced') !== false ? 'badge-danger' : (strpos($step['difficulty'], 'Intermediate') !== false ? 'badge-warning' : 'badge-success'); ?>"><?php echo htmlspecialchars($step['difficulty']); ?></span>
                </div>
              </div>
              <p style="font-size:0.875rem;color:var(--navy-600);margin-top:0.5rem;">
                Key milestones include hands-on labs, peer-reviewed mini-projects, and standard industry assessment verification.
              </p>
              <div style="display:flex;gap:1rem;margin-top:1rem;align-items:center;">
                <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.8125rem;font-weight:600;color:var(--navy-700);cursor:pointer;">
                  <input type="checkbox" onchange="SkillPulse.toast('Milestone marked complete!','success')" style="width:16px;height:16px;accent-color:var(--primary-600);">
                  <span>Mark Completed</span>
                </label>
                <a href="courses.php" class="btn btn-secondary btn-sm" style="font-size:0.75rem;padding:0.25rem 0.65rem;">Recommended Course →</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const trackSelect = document.getElementById('roadmapTrackSelect');
    const trackHeaderCard = document.getElementById('trackHeaderCard');
    const stepsContainer = document.getElementById('roadmapStepsContainer');
    const data = window.SKILLPULSE_DATA || {};

    if (!trackSelect || !data.JOB_ROLES) return;

    trackSelect.addEventListener('change', () => {
      const role = data.JOB_ROLES.find(r => r.id === trackSelect.value);
      if (!role) return;

      trackHeaderCard.innerHTML = `
        <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:1rem;">
          <div>
            <span class="badge badge-cyan" style="margin-bottom:0.5rem;">Target Specialization</span>
            <h2 style="font-size:1.6rem;font-weight:800;color:#fff;">${role.title}</h2>
            <p style="color:#CBD5E1;max-width:640px;font-size:0.95rem;margin-top:0.35rem;">${role.description}</p>
          </div>
          <div style="text-align:right;">
            <span style="font-size:0.75rem;color:#94A3B8;display:block;">Median Compensation</span>
            <span style="font-size:1.25rem;font-weight:800;color:var(--cyan-400);">${role.salaryRange}</span>
          </div>
        </div>
      `;

      stepsContainer.innerHTML = role.recommendedPath.map(step => `
        <div class="card" style="display:flex;align-items:flex-start;gap:1.25rem;padding:1.5rem;">
          <div style="width:40px;height:40px;border-radius:12px;background:var(--primary-50);color:var(--primary-600);font-weight:800;font-size:1.1rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            ${step.step}
          </div>
          <div style="flex:1;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:0.5rem;">
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--navy-900);">${step.title}</h3>
              <div style="display:flex;gap:0.5rem;align-items:center;">
                <span class="badge badge-navy">⏱ ${step.time}</span>
                <span class="badge ${step.difficulty.includes('Advanced') ? 'badge-danger' : step.difficulty.includes('Intermediate') ? 'badge-warning' : 'badge-success'}">${step.difficulty}</span>
              </div>
            </div>
            <p style="font-size:0.875rem;color:var(--navy-600);margin-top:0.5rem;">
              Key milestones include hands-on labs, peer-reviewed mini-projects, and standard industry assessment verification.
            </p>
            <div style="display:flex;gap:1rem;margin-top:1rem;align-items:center;">
              <label style="display:flex;align-items:center;gap:0.5rem;font-size:0.8125rem;font-weight:600;color:var(--navy-700);cursor:pointer;">
                <input type="checkbox" onchange="SkillPulse.toast('Milestone marked complete!','success')" style="width:16px;height:16px;accent-color:var(--primary-600);">
                <span>Mark Completed</span>
              </label>
              <a href="courses.php" class="btn btn-secondary btn-sm" style="font-size:0.75rem;padding:0.25rem 0.65rem;">Recommended Course →</a>
            </div>
          </div>
        </div>
      `).join('');
    });
  });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
