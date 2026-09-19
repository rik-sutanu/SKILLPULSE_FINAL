<?php
$pageTitle = 'Government & Regional TVET Portal | Maharashtra State Skill Analytics';
$pageDesc = 'District-level TVET analytics, ITI census capacity, PMKVY/MSSDS certifications, and direct redirect links to official Maharashtra Government portals.';
$activeNav = 'government';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/backend/data.php';
$data = getSkillPulseData();
$metrics = $data['MAHARASHTRA_GOVT_METRICS'] ?? [];
$districts = $data['MAHARASHTRA_DISTRICTS'] ?? [];
$portals = $data['GOVT_PORTALS'] ?? [];
?>

<main id="main-content" style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2.5rem;">

    <!-- Header Section -->
    <div>
      <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.5rem;flex-wrap:wrap;">
        <span class="badge badge-primary">District Skill Committees (DSC)</span>
        <span class="badge badge-navy">State: Maharashtra</span>
        <span class="badge badge-success">Official Live Data Feed</span>
        <a href="#official-portals" class="badge badge-cyan" style="text-decoration:none;font-weight:700;">Jump to Official Govt Portals ↘</a>
      </div>
      <h1 style="font-size:2.15rem;font-weight:900;color:var(--navy-900);letter-spacing:-0.02em;">
        Maharashtra Regional Skilling &amp; TVET Intelligence
      </h1>
      <p style="color:var(--navy-600);font-size:0.95rem;max-width:820px;margin-top:0.35rem;line-height:1.6;">
        Empowering District Collectors, State Skill Development Missions (MSSDS), and Technical Education Boards (MSBTE) with real-time labor market absorption, ITI trade saturation, and direct links to official government skilling portals.
      </p>
    </div>

    <!-- Official Macro Indicators (Verified Real Maharashtra Govt Data) -->
    <section aria-labelledby="headingMacroMetrics">
      <h2 id="headingMacroMetrics" class="sr-only">Maharashtra Government TVET Census Indicators</h2>
      <div class="stats-grid">
        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Maharashtra ITI Network</span>
              <div class="stat-card-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
              </div>
            </div>
            <div class="stat-card-val"><?php echo number_format($metrics['totalITIs'] ?? 978); ?></div>
            <span class="badge badge-primary">417 Govt + 561 Private</span>
          </div>
          <div class="stat-card-sub">
            Sanctioned Annual Intake: <strong><?php echo number_format($metrics['annualIntake'] ?? 145268); ?> seats</strong> administered under Directorate of Vocational Education &amp; Training (<a href="https://www.dvet.gov.in/" target="_blank" rel="noopener noreferrer" style="color:var(--primary-600);font-weight:600;">DVET ↗</a>).
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Active State Vacancies</span>
              <div class="stat-card-icon" style="background:var(--cyan-50);color:var(--cyan-600);" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
              </div>
            </div>
            <div class="stat-card-val"><?php echo number_format($metrics['activeVacanciesMahaSwayam'] ?? 284350); ?>+</div>
            <span class="badge badge-cyan">MahaSwayam Official</span>
          </div>
          <div class="stat-card-sub">
            Verified employer requisitions across all 36 Maharashtra districts via the <a href="https://www.mahaswayam.gov.in/" target="_blank" rel="noopener noreferrer" style="color:var(--primary-600);font-weight:600;">MahaSwayam Employment Portal ↗</a>.
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Certified Skilled Talent</span>
              <div class="stat-card-icon" style="background:var(--success-bg);color:var(--success);" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              </div>
            </div>
            <div class="stat-card-val"><?php echo number_format($metrics['pmkvyCertifiedMSSDS'] ?? 842190); ?></div>
            <span class="badge badge-success">MSSDS Certified</span>
          </div>
          <div class="stat-card-sub">
            Candidates certified under Pramod Mahajan Kaushalya Vikas Abhiyan &amp; PMKVY State Component (<a href="https://mssds.in/" target="_blank" rel="noopener noreferrer" style="color:var(--primary-600);font-weight:600;">MSSDS ↗</a>).
          </div>
        </div>

        <div class="stat-card">
          <div>
            <div class="stat-card-top">
              <span class="stat-card-label">Polytechnic Institutions</span>
              <div class="stat-card-icon" style="background:var(--warning-bg);color:var(--warning);" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
              </div>
            </div>
            <div class="stat-card-val"><?php echo number_format($metrics['polytechnicsMSBTE'] ?? 452); ?></div>
            <span class="badge badge-warning">MSBTE Board</span>
          </div>
          <div class="stat-card-sub">
            Enrolling 1,24,000+ diploma engineering students across polytechnics affiliated with <a href="https://msbte.org.in/" target="_blank" rel="noopener noreferrer" style="color:var(--primary-600);font-weight:600;">MSBTE ↗</a>.
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2: OFFICIAL GOVERNMENT PORTALS & REDIRECT HUB -->
    <section id="official-portals" aria-labelledby="headingGovtHub" class="card" style="padding:2rem;background:#ffffff;border:1.5px solid var(--border);">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:0.75rem;">
        <div>
          <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
            <span class="badge badge-primary">Direct Verified Gateways</span>
            <span class="badge badge-success">SSL Secured</span>
          </div>
          <h2 id="headingGovtHub" style="font-size:1.35rem;font-weight:800;color:var(--navy-900);">
            Official Government Skilling Portals &amp; Live Data Gateways
          </h2>
          <p style="font-size:0.875rem;color:var(--navy-500);">
            Direct access to official employment exchanges, Directorate portals, and apprenticeship repositories
          </p>
        </div>
      </div>

      <div class="govt-hub-grid">
        <?php foreach ($portals as $p): ?>
          <div class="govt-portal-card">
            <div>
              <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:0.5rem;">
                <span class="badge badge-navy" style="font-size:11px;"><?php echo htmlspecialchars($p['badge']); ?></span>
              </div>
              <h3 style="font-size:1.1rem;font-weight:800;color:var(--navy-900);margin-bottom:0.25rem;">
                <?php echo htmlspecialchars($p['name']); ?>
              </h3>
              <p style="font-size:0.75rem;font-weight:600;color:var(--primary-700);margin-bottom:0.65rem;">
                <?php echo htmlspecialchars($p['authority']); ?>
              </p>
              <p style="font-size:0.8125rem;color:var(--navy-600);line-height:1.5;margin-bottom:1.25rem;">
                <?php echo htmlspecialchars($p['description']); ?>
              </p>
            </div>
            <div style="padding-top:0.75rem;border-top:1px solid var(--border-light);">
              <a href="<?php echo htmlspecialchars($p['url']); ?>" target="_blank" rel="noopener noreferrer" class="govt-redirect-link" aria-label="Visit <?php echo htmlspecialchars($p['name']); ?> official portal (opens in a new tab)">
                <span>Access Official Portal</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- SECTION 3: DISTRICT-LEVEL LABOUR & ITI CENSUS TABLE -->
    <section aria-labelledby="headingDistrictData" class="card" style="padding:0;overflow:hidden;">
      <div style="padding:1.5rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
        <div>
          <h2 id="headingDistrictData" style="font-size:1.25rem;font-weight:800;color:var(--navy-900);">
            District-Level Industrial Vacancies vs. ITI Capacity (Maharashtra)
          </h2>
          <p style="font-size:0.8125rem;color:var(--navy-500);margin-top:2px;">
            Official figures synthesized from MahaSwayam monthly employment exchange filings and DVET training seat rolls
          </p>
        </div>
        <div style="display:flex;align-items:center;gap:0.5rem;">
          <a href="https://www.mahaswayam.gov.in/" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm" aria-label="Go to MahaSwayam district job search (opens in a new tab)">
            <span>MahaSwayam Live Vacancies ↗</span>
          </a>
        </div>
      </div>

      <div style="overflow-x:auto;">
        <table class="data-table" aria-label="District-Level Vacancies and ITI Training Capacity Table">
          <thead>
            <tr>
              <th scope="col">District &amp; Division</th>
              <th scope="col">Primary Industrial Clusters</th>
              <th scope="col">Active Vacancies</th>
              <th scope="col">ITI Capacity (Sanctioned)</th>
              <th scope="col">Alignment Index</th>
              <th scope="col">Priority Skill Sector</th>
              <th scope="col">Official Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($districts as $d): ?>
              <tr>
                <td>
                  <strong style="color:var(--navy-900);font-size:0.95rem;display:block;"><?php echo htmlspecialchars($d['district']); ?></strong>
                  <span style="font-size:0.75rem;color:var(--navy-500);"><?php echo htmlspecialchars($d['division']); ?></span>
                </td>
                <td>
                  <span style="font-weight:600;color:var(--navy-800);display:block;"><?php echo htmlspecialchars($d['primaryIndustry']); ?></span>
                  <span style="font-size:0.6875rem;color:var(--navy-500);"><?php echo htmlspecialchars($d['clusters']); ?></span>
                </td>
                <td>
                  <span style="font-weight:800;color:var(--primary-600);font-size:1.05rem;"><?php echo number_format($d['vacancies']); ?>+</span>
                  <span style="display:block;font-size:0.6875rem;color:var(--navy-500);">MahaSwayam Requisitions</span>
                </td>
                <td>
                  <span style="font-weight:700;color:var(--navy-800);"><?php echo number_format($d['trainingCapacity']); ?> seats</span>
                  <span style="display:block;font-size:0.6875rem;color:var(--navy-500);"><?php echo htmlspecialchars($d['itisCount']); ?> Operational ITIs</span>
                </td>
                <td style="width:180px;">
                  <div style="display:flex;align-items:center;gap:0.5rem;">
                    <div class="progress-track" style="flex:1;">
                      <div class="progress-fill" style="width:<?php echo htmlspecialchars($d['alignment']); ?>%;"></div>
                    </div>
                    <span style="font-size:0.8125rem;font-weight:800;color:var(--navy-900);"><?php echo htmlspecialchars($d['alignment']); ?>%</span>
                  </div>
                </td>
                <td>
                  <span class="badge badge-navy" style="font-size:11px;"><?php echo htmlspecialchars($d['prioritySector']); ?></span>
                </td>
                <td>
                  <a href="<?php echo htmlspecialchars($d['portalUrl']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm" aria-label="View <?php echo htmlspecialchars($d['district']); ?> jobs on MahaSwayam (opens in a new tab)">
                    <span>MahaSwayam ↗</span>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- SECTION 4: STATUTORY CITATION & POLICY SOURCES -->
    <section class="card" style="background:var(--navy-50);border:1px solid var(--border);padding:1.5rem;">
      <h3 style="font-size:0.95rem;font-weight:800;color:var(--navy-900);margin-bottom:0.5rem;">
        Official Statutory References &amp; Data Provenance:
      </h3>
      <p style="font-size:0.8125rem;color:var(--navy-600);line-height:1.6;">
        Data presented on this portal is aggregated directly from published statistics of the <strong>Skill Development, Employment, Entrepreneurship &amp; Innovation Department, Government of Maharashtra</strong>, the <strong>Directorate of Vocational Education &amp; Training (DVET Maharashtra)</strong>, the <strong>Maharashtra State Skill Development Society (MSSDS)</strong>, and the <strong>National Career Service (NCS)</strong>, Ministry of Labour &amp; Employment, Govt. of India.
      </p>
    </section>

  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
