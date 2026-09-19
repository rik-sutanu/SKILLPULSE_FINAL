<?php
$pageTitle = 'AI Resume Scanner & Career Bridge Detector | SkillPulse';
$pageDesc = 'Upload or paste your resume to extract competencies, calculate role alignment scores, detect critical skill gaps, and access tailored bridging courses.';
$activeNav = 'resume-scanner';
require_once __DIR__ . '/includes/header.php';
?>

<main style="flex:1;padding:2.5rem 0 4rem 0;">
  <div class="container" style="display:flex;flex-direction:column;gap:2rem;">

    <!-- Scanner Hero Card -->
    <div class="scanner-hero-card">
      <div class="scanner-badge-row">
        <span class="scanner-badge-ai">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          <span>AI Competency Extraction</span>
        </span>
        <span class="badge" style="background:rgba(255,255,255,0.1);color:#FAF6EE;border:1px solid rgba(255,255,255,0.2);">
          ATS Keyword Benchmarking
        </span>
        <span class="badge" style="background:rgba(93,202,165,0.2);color:#5DCAA5;border:1px solid rgba(93,202,165,0.4);">
          +25 Profile XP Reward
        </span>
      </div>

      <h1 style="font-size:2.2rem;font-weight:900;color:#FDF3F0;letter-spacing:-0.03em;margin:0 0 0.5rem 0;">
        AI Resume Scanner &amp; Career Bridge Detector
      </h1>
      <p style="color:#E7C3C0;font-size:0.95rem;max-width:760px;line-height:1.6;margin:0;">
        Scan your resume against Maharashtra's priority industry tracks. Our natural language diagnostic engine identifies your validated competencies, exposes hidden skill gaps, and connects you directly to bridging courses that elevate your job readiness score.
      </p>
    </div>

    <!-- Interactive Scanner Container -->
    <div class="scanner-input-container">
      
      <!-- Input Mode Tabs -->
      <div class="scanner-tabs" role="tablist">
        <button type="button" class="scanner-tab-btn active" id="tabBtnUpload" role="tab" aria-selected="true">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;vertical-align:-2px;margin-right:5px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
          Upload Resume File (PDF / DOCX / TXT)
        </button>
        <button type="button" class="scanner-tab-btn" id="tabBtnPaste" role="tab" aria-selected="false">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline-block;vertical-align:-2px;margin-right:5px;"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
          Paste Resume Text / Profile
        </button>
      </div>

      <!-- Panel A: File Dropzone -->
      <div id="panelUpload">
        <input type="file" id="resumeFileInput" accept=".pdf,.docx,.txt" style="display:none;">
        <div class="resume-dropzone" id="resumeDropzone">
          <div class="dropzone-icon-circle">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
              <line x1="12" y1="18" x2="12" y2="12"></line>
              <line x1="9" y1="15" x2="12" y2="12"></line>
              <line x1="15" y1="15" x2="12" y2="12"></line>
            </svg>
          </div>
          <div>
            <div class="dropzone-title">Drag &amp; drop your resume document here, or click to browse</div>
            <div class="dropzone-subtitle">Supported formats: PDF, Microsoft Word (.docx), Plain Text (.txt) &bull; Max 5MB</div>
          </div>
          <div class="dropzone-file-pill" id="dropzoneFilePill">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2C6E3D" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span id="dropzoneFileName">resume.pdf</span>
            <button type="button" id="dropzoneFileRemove" style="background:none;border:none;cursor:pointer;color:#9B2226;padding:2px 4px;font-weight:800;" title="Remove file">&times;</button>
          </div>
        </div>
      </div>

      <!-- Panel B: Direct Text Paste -->
      <div id="panelPaste" style="display:none;">
        <textarea id="resumePasteText" class="resume-textarea" placeholder="Paste your resume content, technical summary, or LinkedIn profile text here... (minimum 30 characters)"></textarea>
      </div>

      <!-- Quick Sample Profiles Bar -->
      <div class="sample-resumes-bar">
        <div style="font-size:0.75rem;font-weight:800;color:var(--navy-600);text-transform:uppercase;letter-spacing:0.04em;">
          ⚡ Or Test Instantly with a Sample Candidate Profile:
        </div>
        <div class="sample-chips-row" id="sampleChipsContainer">
          <!-- Populated by JS -->
          <button type="button" class="sample-chip-btn">Loading sample profiles...</button>
        </div>
      </div>

      <!-- Target Role Selector & Scan CTA Button -->
      <div class="scanner-controls-row">
        <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
          <label for="targetRoleSelect" style="font-size:0.875rem;font-weight:700;color:var(--navy-800);">
            Benchmark Career Track:
          </label>
          <select id="targetRoleSelect" class="form-select" style="min-width:240px;padding:0.55rem 0.85rem;border:1.5px solid var(--border);border-radius:8px;font-weight:600;background:#fff;color:var(--navy-900);">
            <option value="auto">⚡ Auto-Detect Best Matching Role (AI)</option>
            <option value="data-analyst">Data Analyst</option>
            <option value="frontend-developer">Frontend Developer</option>
            <option value="backend-developer">Backend Developer</option>
            <option value="devops-engineer">DevOps Engineer</option>
          </select>
        </div>

        <button type="button" class="scan-cta-btn" id="btnStartScan">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          <span>Scan Resume &amp; Detect Gaps</span>
        </button>
      </div>

    </div>

    <!-- Live Progress Animation Box -->
    <div class="scan-progress-box" id="scanProgressBox">
      <div class="live-pulse-dot" style="margin:0 auto 1rem auto;width:16px;height:16px;"></div>
      <h3 style="font-size:1.2rem;font-weight:800;color:#FDF3F0;margin-bottom:4px;">
        Analyzing Resume Document &amp; Skills...
      </h3>
      <p style="font-size:0.82rem;color:#E7C3C0;margin:0;">
        Synthesizing entities, cross-referencing Maharashtra job demand data, and matching bridging courses.
      </p>

      <div class="scan-progress-steps">
        <div class="scan-step-pill" id="scanStep1">
          <span class="step-icon">1</span>
          <span>Parsing Document</span>
        </div>
        <div class="scan-step-pill" id="scanStep2">
          <span class="step-icon">2</span>
          <span>Extracting Competencies</span>
        </div>
        <div class="scan-step-pill" id="scanStep3">
          <span class="step-icon">3</span>
          <span>Evaluating Gaps</span>
        </div>
        <div class="scan-step-pill" id="scanStep4">
          <span class="step-icon">4</span>
          <span>Mapping Course Bridges</span>
        </div>
      </div>
    </div>

    <!-- Results Cockpit Box -->
    <div class="scan-results-box" id="scanResultsBox">
      <!-- Injected dynamically via js/resume-scanner.js -->
    </div>

  </div>
</main>

<script src="js/data.js"></script>
<script src="js/resume-scanner.js"></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
