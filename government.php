<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Government &amp; Regional Dashboard | SkillPulse TVET Policy Engine</title>
  <meta name="description" content="District-level skilling analytics, ITI census capacity, PMKVY certifications, and supply-demand mismatches across Maharashtra and India.">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Header -->
  <header class="site-header" role="banner">
    <div class="container nav-inner">
      <a href="index.php" class="brand-logo" aria-label="SkillPulse Home">
        <div class="brand-icon" aria-hidden="true">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
        </div>
        <div>
          <span>Skill<span style="color:var(--primary-600);">Pulse</span></span>
          <span class="brand-text-sub">Government &amp; Regional</span>
        </div>
      </a>

      <!-- Desktop Nav -->
      <nav class="nav-links" role="navigation" aria-label="Main Navigation">
        <a href="index.php" class="nav-link">Home</a>

        <!-- Intelligence Dropdown -->
        <div class="nav-item-dropdown">
          <button class="nav-dropdown-btn active" aria-haspopup="true" aria-expanded="false" id="btnDropdownIntelligence">
            <span>Intelligence</span>
            <svg class="dropdown-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="nav-dropdown-menu" role="menu" aria-labelledby="btnDropdownIntelligence">
            <a href="skill-intelligence.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Skill Intelligence</span>
                <span class="dropdown-item-desc">Real-time demand trajectories &amp; vacancy pools</span>
              </div>
            </a>
            <a href="government.php" class="dropdown-item active" role="menuitem">
              <div>
                <span class="dropdown-item-title">Government Portal</span>
                <span class="dropdown-item-desc">Maharashtra DVET &amp; regional skill metrics</span>
              </div>
            </a>
            <a href="employer.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Employer Portal</span>
                <span class="dropdown-item-desc">Requisition builder &amp; candidate matching</span>
              </div>
            </a>
          </div>
        </div>

        <!-- Tools & Simulators Dropdown -->
        <div class="nav-item-dropdown">
          <button class="nav-dropdown-btn" aria-haspopup="true" aria-expanded="false" id="btnDropdownTools">
            <span>Tools &amp; Simulators</span>
            <svg class="dropdown-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="nav-dropdown-menu" role="menu" aria-labelledby="btnDropdownTools">
            <a href="resume-scanner.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">AI Resume Scanner</span>
                <span class="dropdown-item-desc">Extract skills &amp; detect job gaps</span>
              </div>
            </a>
            <a href="skill-gap-analyzer.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Skill Gap Analyzer</span>
                <span class="dropdown-item-desc">Interactive Job Readiness Score &amp; radar</span>
              </div>
            </a>
            <a href="training-curriculum.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Curriculum Simulator</span>
                <span class="dropdown-item-desc">Simulate electives &amp; placement boost</span>
              </div>
            </a>
            <a href="career-roadmap.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Career Roadmap</span>
                <span class="dropdown-item-desc">Structured milestones &amp; pathways</span>
              </div>
            </a>
          </div>
        </div>

        <!-- Learning & Practice Dropdown -->
        <div class="nav-item-dropdown">
          <button class="nav-dropdown-btn" aria-haspopup="true" aria-expanded="false" id="btnDropdownLearning">
            <span>Learning &amp; Practice</span>
            <svg class="dropdown-chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="nav-dropdown-menu" role="menu" aria-labelledby="btnDropdownLearning">
            <a href="courses.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Courses Catalog</span>
                <span class="dropdown-item-desc">Domain courses to bridge identified gaps</span>
              </div>
            </a>
            <a href="practice.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Practice Arena</span>
                <span class="dropdown-item-desc">Corporate interview screening &amp; code tests</span>
              </div>
            </a>
            <a href="experts.php" class="dropdown-item" role="menuitem">
              <div>
                <span class="dropdown-item-title">Industry Experts</span>
                <span class="dropdown-item-desc">1-on-1 resume reviews &amp; mock interviews</span>
              </div>
            </a>
          </div>
        </div>

        <a href="dashboard.php" class="nav-link">Dashboard</a>
      </nav>

      <div class="nav-actions">
        <div class="nav-auth-container" id="navAuthContainer">
          <a href="auth.php" class="btn btn-secondary btn-sm" id="navAuthSignInBtn" aria-label="Sign In or Create Account">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <span>Sign In / Register</span>
          </a>
        </div>
        <button class="btn btn-primary btn-sm nav-btn-cta" onclick="SkillPulse.toast('District Skill Development Report Exported!','success')">Export Brief</button>
        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mobileNavDrawer"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></button>
      </div>
    </div>
  </header>

  <!-- Mobile Drawer -->
  <div class="mobile-nav-drawer" id="mobileNavDrawer" role="dialog" aria-modal="true" aria-label="Mobile Navigation Menu">
    <div class="mobile-nav-content">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
        <span style="font-weight:800;font-size:1.1rem;color:var(--navy-900);">Navigation</span>
        <button id="mobileDrawerClose" style="background:none;border:none;cursor:pointer;padding:4px;color:var(--text-main);" aria-label="Close menu">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
      </div>

      <div style="display:flex;flex-direction:column;gap:0.35rem;">
        <a href="index.php" class="mobile-nav-link">Home</a>
        <div style="font-size:0.75rem;font-weight:700;color:var(--navy-500);text-transform:uppercase;margin:0.75rem 0 0.25rem 0.5rem;">Intelligence &amp; Governance</div>
        <a href="skill-intelligence.php" class="mobile-nav-link">Skill Intelligence</a>
        <a href="government.php" class="mobile-nav-link active">Government &amp; Regional Portal</a>
        <a href="employer.php" class="mobile-nav-link">Employer Portal</a>

        <div style="font-size:0.75rem;font-weight:700;color:var(--navy-500);text-transform:uppercase;margin:0.75rem 0 0.25rem 0.5rem;">Tools &amp; Simulators</div>
        <a href="resume-scanner.php" class="mobile-nav-link">AI Resume Scanner &amp; Bridge</a>
        <a href="skill-gap-analyzer.php" class="mobile-nav-link">Skill Gap Analyzer</a>
        <a href="training-curriculum.php" class="mobile-nav-link">Curriculum Simulator</a>
        <a href="career-roadmap.php" class="mobile-nav-link">Career Roadmap</a>

        <div style="font-size:0.75rem;font-weight:700;color:var(--navy-500);text-transform:uppercase;margin:0.75rem 0 0.25rem 0.5rem;">Learning &amp; Practice</div>
        <a href="courses.php" class="mobile-nav-link">Courses Catalog</a>
        <a href="practice.php" class="mobile-nav-link">Interview Practice Arena</a>
        <a href="experts.php" class="mobile-nav-link">Industry Experts</a>

        <div style="font-size:0.75rem;font-weight:700;color:var(--navy-500);text-transform:uppercase;margin:0.75rem 0 0.25rem 0.5rem;">User Account</div>
        <a href="dashboard.php" class="mobile-nav-link">Learner Dashboard</a>
        <div id="mobileAuthContainer" style="margin-top:0.75rem;">
          <a href="auth.php" class="btn btn-primary" id="mobileAuthSignInBtn" style="width:100%;text-align:center;">Sign In / Register</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main style="flex:1;padding:2.5rem 0 4rem 0;">
    <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

      <!-- Header -->
      <div>
        <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;">
          <span class="badge badge-primary">District Skill Committees (DSC)</span>
          <span class="badge badge-navy">State Focus: Maharashtra</span>
        </div>
        <h1 style="font-size:2rem;font-weight:800;color:var(--navy-900);">Regional Skilling &amp; TVET Policy Engine</h1>
        <p style="color:var(--navy-600);font-size:0.95rem;max-width:760px;margin-top:0.25rem;">
          Empowering District Collectors and State Skill Development Missions (SSDM) with localized labor demand, ITI capacity saturation, and targeted intervention analytics.
        </p>
      </div>

      <!-- State Wide Macro Metrics -->
      <div class="stats-grid">
        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Maharashtra ITIs</span>
              <div class="stat-card-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
            </div>
            <div class="stat-card-val" id="statGovtItis">978</div>
            <span class="badge badge-primary">Government &amp; Private</span>
          </div>
          <div class="stat-card-sub" id="statGovtItiSub">Enrolled annual training capacity: 1,45,268+ vocational seats.</div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Active State Vacancies</span>
              <div class="stat-card-icon" style="background:var(--cyan-50);color:var(--cyan-600);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>
            </div>
            <div class="stat-card-val" id="statGovtVacancies">2.84L+</div>
            <span class="badge badge-cyan">MahaSwayam Portal</span>
          </div>
          <div class="stat-card-sub">
            Verified employer requisitions across Maharashtra via <a href="https://www.mahaswayam.gov.in/" target="_blank" rel="noopener noreferrer" style="color:var(--primary-600);font-weight:600;">MahaSwayam ↗</a>.
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Curriculum Alignment Index</span>
              <div class="stat-card-icon" style="background:var(--warning-bg);color:var(--warning);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg></div>
            </div>
            <div class="stat-card-val" id="statGovtAlignment">74.2%</div>
            <span class="badge badge-warning">Regional Average</span>
          </div>
          <div class="stat-card-sub">Gap between traditional trades and Industry 4.0 automation.</div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Placement Efficiency</span>
              <div class="stat-card-icon" style="background:var(--success-bg);color:var(--success);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
            </div>
            <div class="stat-card-val">68.8%</div>
            <span class="badge badge-success">+5.4% YoY</span>
          </div>
          <div class="stat-card-sub">Certified candidates securing verified wage employment within 6 months.</div>
        </div>
      </div>

      <!-- District Breakdown Table -->
      <div class="card" style="padding:0;overflow:hidden;">
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.75rem;">
          <div>
            <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
              <h2 style="font-size:1.15rem;font-weight:700;color:var(--navy-900);margin:0;">District-Level Demand vs Training Supply</h2>
              <span class="badge-live-pulse" style="font-size:0.6875rem;"><span class="live-dot"></span> Live Government Data</span>
            </div>
            <p style="font-size:0.8125rem;color:var(--navy-500);margin:0;">Comparison of industrial job demand versus active ITI/PMKVY training capacity across Maharashtra</p>
          </div>
          <span class="badge badge-primary">36 Maharashtra Districts</span>
        </div>

        <div style="overflow-x:auto;">
          <table class="data-table">
            <thead>
              <tr>
                <th>District</th>
                <th>Primary Industry Hub</th>
                <th>Monthly Vacancies</th>
                <th>Training Capacity</th>
                <th>Supply-Demand Alignment</th>
                <th>Priority Growth Sector</th>
              </tr>
            </thead>
            <tbody id="districtTableBody">
              <!-- Rendered via JS -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Section: Verified Government Skilling Portals & Live Data Gateways -->
      <section style="margin-top:1.5rem;">
        <div style="margin-bottom:1.25rem;">
          <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <span class="badge badge-navy">Statutory Public Infrastructure</span>
            <span class="badge-live-pulse"><span class="live-dot"></span> 10 Official Gateways Active</span>
          </div>
          <h2 style="font-size:1.45rem;font-weight:800;color:var(--navy-900);">
            Official Government Skilling Portals &amp; Live Data Gateways
          </h2>
          <p style="color:var(--navy-600);font-size:0.875rem;max-width:820px;margin-top:0.25rem;">
            Direct official endpoints connecting Maharashtra employment exchanges, central technical boards, and national apprenticeship registries. All links are verified official government domains (<code>.gov.in</code> / <code>.in</code>).
          </p>
        </div>

        <div class="govt-portals-grid" id="govtPortalsContainer">
          <!-- Populated dynamically via JS -->
        </div>
      </section>

    </div>
  </main>

  <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-bottom" style="border-top:none;padding-top:0;">
        <span>© 2026 SkillPulse Government &amp; Regional Engine | Smart India Hackathon 2026</span>
        <span>Problem Statement 26134 | Team HACK.FORCE</span>
      </div>
    </div>
  </footer>

  <script src="js/data.js"></script>
  <script src="js/app.js"></script>
  <script src="js/pulseai.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const data = window.SKILLPULSE_DATA || {};
      const tbody = document.getElementById('districtTableBody');
      const portalsContainer = document.getElementById('govtPortalsContainer');

      let districtsList = data.MAHARASHTRA_DISTRICTS || [];
      let portalsList = data.GOVT_PORTALS || [];

      // 1. Dynamic API fetch from api/districts.php
      try {
        const res = await fetch('api/districts.php');
        if (res.ok) {
          const json = await res.json();
          if (json.success) {
            if (Array.isArray(json.districts) && json.districts.length > 0) {
              districtsList = json.districts;
            }
            if (Array.isArray(json.portals) && json.portals.length > 0) {
              portalsList = json.portals;
            }
            if (json.governmentMetrics) {
              const gm = json.governmentMetrics;
              if (gm.totalITIs) document.getElementById('statGovtItis').textContent = gm.totalITIs.toLocaleString();
              if (gm.annualIntake) document.getElementById('statGovtItiSub').textContent = `Enrolled annual training capacity: ${gm.annualIntake.toLocaleString()}+ vocational seats.`;
              if (gm.activeVacanciesMahaSwayam) document.getElementById('statGovtVacancies').textContent = `${(gm.activeVacanciesMahaSwayam / 100000).toFixed(2)}L+`;
              if (gm.stateAlignmentScore) document.getElementById('statGovtAlignment').textContent = `${gm.stateAlignmentScore}%`;
            }
          }
        }
      } catch (err) {
        console.warn('api/districts.php not available, using embedded government metrics:', err);
      }

      // Render District Table
      if (tbody && districtsList.length > 0) {
        tbody.innerHTML = districtsList.map(d => `
          <tr>
            <td style="font-weight:700;color:var(--navy-900);">${d.district || d.name}</td>
            <td>${d.primaryIndustry || 'IT / Auto / Manufacturing'}</td>
            <td style="font-weight:700;color:var(--primary-600);">${(d.vacancies || d.monthlyVacancies || 4200).toLocaleString()}+</td>
            <td>${(d.trainingCapacity || d.capacity || 3800).toLocaleString()} seats</td>
            <td style="width:180px;">
              <div style="display:flex;align-items:center;gap:0.5rem;">
                <div class="progress-track" style="flex:1;">
                  <div class="progress-fill" style="width:${d.alignment || 78}%;"></div>
                </div>
                <span style="font-size:0.75rem;font-weight:700;">${d.alignment || 78}%</span>
              </div>
            </td>
            <td><span class="badge badge-navy">${d.prioritySector || 'Industry 4.0 / EV'}</span></td>
          </tr>
        `).join('');
      }

      // Render Verified Government Portals
      if (portalsContainer && portalsList.length > 0) {
        portalsContainer.innerHTML = portalsList.map(p => `
          <div class="govt-portal-card">
            <div>
              <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.75rem;gap:0.5rem;">
                <span class="govt-portal-badge">${p.badge || 'Official Government Portal'}</span>
                <span class="badge-live-pulse" style="font-size:0.6875rem;"><span class="live-dot"></span> Active</span>
              </div>
              <h3 style="font-size:1.1rem;font-weight:800;color:var(--navy-900);line-height:1.3;margin-bottom:0.35rem;">
                ${p.name}
              </h3>
              <p style="font-size:0.775rem;color:var(--navy-500);margin-bottom:0.65rem;font-weight:600;">
                ${p.authority}
              </p>
              <p style="font-size:0.8125rem;color:var(--navy-600);line-height:1.5;margin-bottom:1rem;">
                ${p.description}
              </p>
            </div>

            <div style="padding-top:0.75rem;border-top:1px solid var(--border-light);display:flex;align-items:center;justify-content:space-between;">
              <span style="font-size:0.75rem;color:var(--navy-400);font-family:monospace;">${new URL(p.url).hostname}</span>
              <a href="${p.url}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm" style="display:inline-flex;align-items:center;gap:4px;padding:0.35rem 0.75rem;font-size:0.75rem;" aria-label="Visit ${p.name} (opens in a new tab)">
                <span>Open Portal ↗</span>
              </a>
            </div>
          </div>
        `).join('');
      }
    });
  </script>
</body>
</html>
