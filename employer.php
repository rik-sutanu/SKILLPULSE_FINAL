<?php
$pageTitle = 'Employer Portal | SkillPulse Enterprise Matching';
$pageDesc = 'Define talent skill weightings, post verified requisitions, and access pre-screened candidates with objective readiness scores.';
$activeNav = 'employer';
require_once __DIR__ . '/includes/header.php';
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <div>
      <span class="badge badge-primary" style="margin-bottom:0.5rem;">Enterprise Talent Mobilization</span>
      <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Industry Requisition &amp; Match Builder</h1>
      <p style="color:var(--navy-600);font-size:0.95rem;max-width:760px;margin-top:0.25rem;">
        Define exact technical requirements and let SkillPulse match verified students scoring above your custom readiness threshold.
      </p>
    </div>

    <div style="display:grid;grid-template-columns:1fr;gap:2rem;">
      <!-- Requisition Form -->
      <div class="card" style="padding:2rem;">
        <h2 style="font-size:1.25rem;font-weight:800;color:var(--navy-900);margin-bottom:1.25rem;">Build Candidate Skill Spec</h2>

        <div style="display:flex;flex-direction:column;gap:1.25rem;">
          <div>
            <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.35rem;">Job Title / Designation:</label>
            <input type="text" value="Junior Data Analyst (Fresher / 0-1 Yr)" style="width:100%;padding:0.75rem 1rem;border:1.5px solid var(--border);border-radius:var(--radius-md);font-size:0.95rem;" />
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            <div>
              <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.35rem;">Sector:</label>
              <select style="width:100%;padding:0.75rem;border:1px solid var(--border);border-radius:var(--radius-md);font-size:0.875rem;">
                <option>Information Technology &amp; Software</option>
                <option>BFSI &amp; Fintech</option>
                <option>Healthcare &amp; Biotech</option>
                <option>Automotive &amp; EV</option>
              </select>
            </div>
            <div>
              <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.35rem;">Target Location:</label>
              <input type="text" value="Pune / Mumbai / Hybrid" style="width:100%;padding:0.75rem;border:1px solid var(--border);border-radius:var(--radius-md);font-size:0.875rem;" />
            </div>
          </div>

          <div>
            <label style="display:block;font-size:0.875rem;font-weight:700;color:var(--navy-900);margin-bottom:0.5rem;">Required Competencies (Weighted Match):</label>
            <div style="display:flex;flex-wrap:wrap;gap:0.5rem;">
              <span class="badge badge-primary" style="padding:0.5rem 0.75rem;font-size:0.8125rem;">SQL (25%) ✕</span>
              <span class="badge badge-primary" style="padding:0.5rem 0.75rem;font-size:0.8125rem;">Python (25%) ✕</span>
              <span class="badge badge-primary" style="padding:0.5rem 0.75rem;font-size:0.8125rem;">Power BI (20%) ✕</span>
              <span class="badge badge-cyan" style="padding:0.5rem 0.75rem;font-size:0.8125rem;">Excel Advanced (15%) ✕</span>
              <span class="badge badge-navy" style="padding:0.5rem 0.75rem;font-size:0.8125rem;">+ Add Required Skill</span>
            </div>
          </div>

          <div style="padding:1.25rem;background:var(--navy-50);border-radius:var(--radius-md);border:1px solid var(--border);">
            <div style="display:flex;justify-content:space-between;align-items:center;">
              <div>
                <div style="font-weight:700;color:var(--navy-900);">Matched Pre-Screened Candidates:</div>
                <p style="font-size:0.8125rem;color:var(--navy-500);">Verified college &amp; TVET students scoring &gt;80% readiness</p>
              </div>
              <div style="font-size:1.85rem;font-weight:800;color:var(--success);">1,420</div>
            </div>
          </div>

          <button class="btn btn-primary btn-lg" onclick="SkillPulse.toast('Requisition dispatched! 1,420 candidates notified.','success')">Mobilize Talent Pool</button>
        </div>
      </div>
    </div>

  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
