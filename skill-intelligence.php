<?php
$pageTitle = 'Skill Intelligence | Real-Time Labor Market Demand';
$pageDesc = 'Explore live industry demand trends, emerging skill trajectories, and vacancy analytics across major sectors.';
$activeNav = 'intelligence';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/backend/data.php';
$data = getSkillPulseData();
$industries = $data['INDUSTRIES'] ?? [];
$emerging = $data['EMERGING_SKILLS'] ?? [];
$skills = $data['SKILL_DEMAND_DATA'] ?? [];
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <!-- Title Area -->
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem;">
      <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;">
          <span class="badge badge-primary">PHP Server-Rendered</span>
          <span class="badge badge-cyan">REST API Source: /api/skills.php</span>
        </div>
        <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Industry-to-Skill Intelligence Engine</h1>
        <p style="color:var(--navy-600);font-size:0.95rem;margin-top:0.25rem;">
          Real-time skill demand trajectories, sector vacancy indexes, and emerging technology adoption velocity.
        </p>
      </div>
      <div>
        <input type="text" id="skillSearchInput" placeholder="Filter skills or domain..." style="padding:0.625rem 1rem;border:1.5px solid var(--border);border-radius:var(--radius-md);font-size:0.875rem;width:240px;outline:none;" />
      </div>
    </div>

    <!-- Industry Growth Stats (PHP Loop) -->
    <div>
      <h2 style="font-size:1.125rem;font-weight:700;color:var(--navy-900);margin-bottom:1rem;">Sector Hiring Velocity &amp; Vacancy Pools</h2>
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:1rem;">
        <?php foreach ($industries as $ind): ?>
          <div class="card" style="padding:1.25rem;">
            <div style="font-size:0.75rem;font-weight:600;color:var(--navy-500);text-transform:uppercase;"><?php echo htmlspecialchars($ind['name']); ?></div>
            <div style="font-size:1.75rem;font-weight:800;color:var(--navy-900);margin:0.25rem 0;"><?php echo number_format($ind['vacancies']); ?>+</div>
            <div style="display:flex;align-items:center;justify-content:space-between;font-size:0.75rem;">
              <span style="color:var(--navy-500);">Live Openings</span>
              <span style="color:var(--success);font-weight:700;"><?php echo htmlspecialchars($ind['growth']); ?> YoY</span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Emerging Skills Radar (PHP Loop) -->
    <div class="card" style="padding:1.75rem;">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;flex-wrap:wrap;gap:0.5rem;">
        <div>
          <h2 style="font-size:1.25rem;font-weight:800;color:var(--navy-900);">Emerging Skills Accelerators (2026)</h2>
          <p style="font-size:0.8125rem;color:var(--navy-500);">Skills experiencing over +25% quarter-over-quarter requisition growth</p>
        </div>
        <span class="badge badge-success">Live Trend Signals</span>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:1rem;">
        <?php foreach ($emerging as $sk): ?>
          <div style="padding:1rem;background:var(--navy-50);border:1px solid var(--border);border-radius:var(--radius-md);">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.5rem;">
              <span style="font-weight:700;color:var(--navy-900);font-size:0.95rem;"><?php echo htmlspecialchars($sk['name']); ?></span>
              <span class="badge <?php echo $sk['urgency'] === 'Critical' ? 'badge-danger' : 'badge-warning'; ?>"><?php echo htmlspecialchars($sk['urgency']); ?></span>
            </div>
            <div style="font-size:0.75rem;color:var(--navy-500);margin-bottom:0.5rem;"><?php echo htmlspecialchars($sk['category']); ?></div>
            <div style="display:flex;justify-content:space-between;align-items:center;">
              <span style="font-size:0.75rem;font-weight:600;color:var(--navy-600);">Impact: <?php echo htmlspecialchars($sk['impact']); ?></span>
              <span style="font-size:0.875rem;font-weight:800;color:var(--success);"><?php echo htmlspecialchars($sk['growth']); ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Master Skills Demand Table -->
    <div class="card" style="padding:0;overflow:hidden;">
      <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);background:#fff;display:flex;justify-content:space-between;align-items:center;">
        <div>
          <h2 style="font-size:1.125rem;font-weight:700;color:var(--navy-900);">High-Demand Competencies Table</h2>
          <p style="font-size:0.8125rem;color:var(--navy-500);">Ranked by enterprise hiring volume and annualized wage premiums</p>
        </div>
        <span class="badge badge-navy"><?php echo count($skills); ?> Skills Monitored</span>
      </div>

      <div style="overflow-x:auto;">
        <table class="data-table" id="skillsTable">
          <thead>
            <tr>
              <th>Skill / Competency</th>
              <th>Category</th>
              <th>Primary Industry</th>
              <th>Demand Index (0-100)</th>
              <th>YoY Growth</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="skillsTableBody">
            <?php foreach ($skills as $s): ?>
              <tr>
                <td style="font-weight:700;color:var(--navy-900);"><?php echo htmlspecialchars($s['skill']); ?></td>
                <td><span class="badge badge-navy"><?php echo htmlspecialchars($s['category']); ?></span></td>
                <td><?php echo htmlspecialchars($s['industry']); ?></td>
                <td style="width:200px;">
                  <div style="display:flex;align-items:center;gap:0.75rem;">
                    <div class="progress-track" style="flex:1;">
                      <div class="progress-fill" style="width:<?php echo htmlspecialchars($s['demand']); ?>%;"></div>
                    </div>
                    <span style="font-weight:700;font-size:0.8125rem;color:var(--primary-600);"><?php echo htmlspecialchars($s['demand']); ?></span>
                  </div>
                </td>
                <td><span style="color:var(--success);font-weight:700;"><?php echo htmlspecialchars($s['growth']); ?></span></td>
                <td>
                  <a href="skill-gap-analyzer.php" class="btn btn-outline-primary btn-sm">Audit Gap</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('skillSearchInput');
    const tableBody = document.getElementById('skillsTableBody');
    if (!input || !tableBody) return;

    input.addEventListener('input', (e) => {
      const q = e.target.value.toLowerCase();
      const rows = tableBody.querySelectorAll('tr');
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(q) ? '' : 'none';
      });
    });
  });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
