import React from 'react';

/**
 * WelcomeBackBanner Component
 * 
 * @param {Object} props
 * @param {string} [props.name="Aditya"] - User's display name
 * @param {string} [props.targetRole="Data Analyst"] - Target career role
 * @param {number} [props.readiness=78] - Readiness percentage (0 - 100)
 * @param {Function} [props.onPracticeClick] - Callback for Practice arena button
 * @param {Function} [props.onRetestClick] - Callback for Retest alignment button
 * @param {string} [props.practiceUrl="practice.html"] - Link for Practice arena
 * @param {string} [props.retestUrl="skill-gap-analyzer.html"] - Link for Retest alignment
 */
export default function WelcomeBackBanner({
  name = 'Aditya',
  targetRole = 'Data Analyst',
  readiness = 78,
  onPracticeClick,
  onRetestClick,
  practiceUrl = 'practice.html',
  retestUrl = 'skill-gap-analyzer.html',
}) {
  // Clamp readiness between 0 and 100
  const normalizedReadiness = Math.min(100, Math.max(0, Number(readiness) || 0));

  // SVG Ring calculation: r = 27, circumference = 2 * PI * 27 ≈ 169.646
  const radius = 27;
  const circumference = 2 * Math.PI * radius; // ≈ 169.646
  const strokeDashoffset = circumference * (1 - normalizedReadiness / 100);

  return (
    <div
      className="welcome-back-banner"
      style={{
        backgroundColor: '#4a1116',
        borderRadius: '12px',
        padding: '22px 24px',
        display: 'flex',
        flexWrap: 'wrap',
        alignItems: 'center',
        justifyContent: 'space-between',
        gap: '20px',
        boxSizing: 'border-box',
        width: '100%',
        boxShadow: '0 4px 20px rgba(0, 0, 0, 0.25)',
      }}
    >
      {/* LEFT SIDE: Text Content */}
      <div
        style={{
          display: 'flex',
          flexDirection: 'column',
          gap: '10px',
          flex: '1 1 300px',
          minWidth: '240px',
        }}
      >
        {/* 1. Status row */}
        <div
          style={{
            display: 'flex',
            alignItems: 'center',
            gap: '8px',
          }}
        >
          {/* Three small 6px colored dots */}
          <div style={{ display: 'flex', alignItems: 'center', gap: '5px' }}>
            <span
              style={{
                width: '6px',
                height: '6px',
                borderRadius: '50%',
                backgroundColor: '#5dcaa5',
                display: 'inline-block',
              }}
              title="Verified"
            />
            <span
              style={{
                width: '6px',
                height: '6px',
                borderRadius: '50%',
                backgroundColor: '#85b7eb',
                display: 'inline-block',
              }}
              title="Gov polytechnic"
            />
            <span
              style={{
                width: '6px',
                height: '6px',
                borderRadius: '50%',
                backgroundColor: '#f2c14e',
                display: 'inline-block',
              }}
              title="Gold Tier"
            />
          </div>

          <span
            style={{
              fontSize: '12px',
              color: '#e7c3c0',
              fontWeight: 400,
              lineHeight: 1,
            }}
          >
            Verified · Gov polytechnic · Gold
          </span>
        </div>

        {/* 2. Heading */}
        <h2
          style={{
            margin: 0,
            fontSize: '22px',
            fontWeight: 500,
            color: '#fdf3f0',
            lineHeight: 1.25,
            letterSpacing: '-0.01em',
          }}
        >
          Welcome back, {name}
        </h2>

        {/* 3. Subtext */}
        <p
          style={{
            margin: 0,
            fontSize: '13px',
            color: '#e7c3c0',
            lineHeight: 1.4,
          }}
        >
          Target:{' '}
          <span style={{ color: '#fdf3f0', fontWeight: 500 }}>
            {targetRole}
          </span>{' '}
          — readiness at{' '}
          <strong style={{ color: '#f2c14e', fontWeight: 700 }}>
            {normalizedReadiness}%
          </strong>
        </p>

        {/* 4. Action Buttons */}
        <div
          style={{
            display: 'flex',
            alignItems: 'center',
            gap: '8px',
            marginTop: '4px',
            flexWrap: 'wrap',
          }}
        >
          {/* Secondary Button: Practice arena */}
          <a
            href={practiceUrl}
            onClick={onPracticeClick}
            style={{
              backgroundColor: 'transparent',
              border: '1px solid rgba(255, 255, 255, 0.25)',
              color: '#ffffff',
              borderRadius: '8px',
              padding: '8px 14px',
              fontSize: '12px',
              fontWeight: 400,
              textDecoration: 'none',
              cursor: 'pointer',
              display: 'inline-flex',
              alignItems: 'center',
              justifyContent: 'center',
              transition: 'background-color 0.2s ease, border-color 0.2s ease',
              lineHeight: 1.2,
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.backgroundColor = 'rgba(255, 255, 255, 0.08)';
              e.currentTarget.style.borderColor = 'rgba(255, 255, 255, 0.4)';
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.backgroundColor = 'transparent';
              e.currentTarget.style.borderColor = 'rgba(255, 255, 255, 0.25)';
            }}
          >
            Practice arena
          </a>

          {/* Primary Button: Retest alignment */}
          <a
            href={retestUrl}
            onClick={onRetestClick}
            style={{
              backgroundColor: '#f2c14e',
              border: 'none',
              color: '#4a1116',
              borderRadius: '8px',
              padding: '8px 14px',
              fontSize: '12px',
              fontWeight: 500,
              textDecoration: 'none',
              cursor: 'pointer',
              display: 'inline-flex',
              alignItems: 'center',
              justifyContent: 'center',
              transition: 'transform 0.15s ease, background-color 0.2s ease',
              lineHeight: 1.2,
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.backgroundColor = '#f7ce68';
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.backgroundColor = '#f2c14e';
            }}
          >
            Retest alignment
          </a>
        </div>
      </div>

      {/* RIGHT SIDE: Circular Readiness Gauge */}
      <div
        style={{
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
          justifyContent: 'center',
          gap: '6px',
          flexShrink: 0,
        }}
      >
        <div
          style={{
            position: 'relative',
            width: '64px',
            height: '64px',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
          }}
        >
          <svg
            width="64"
            height="64"
            viewBox="0 0 64 64"
            style={{ display: 'block' }}
            aria-label={`Readiness score: ${normalizedReadiness}%`}
            role="progressbar"
            aria-valuenow={normalizedReadiness}
            aria-valuemin={0}
            aria-valuemax={100}
          >
            {/* Background track: full circle, stroke rgba(255,255,255,0.15), stroke-width 6, no fill */}
            <circle
              cx="32"
              cy="32"
              r={radius}
              fill="none"
              stroke="rgba(255, 255, 255, 0.15)"
              strokeWidth="6"
            />

            {/* Progress arc: stroke #f2c14e, stroke-width 6, stroke-linecap round, rotated -90deg */}
            <circle
              cx="32"
              cy="32"
              r={radius}
              fill="none"
              stroke="#f2c14e"
              strokeWidth="6"
              strokeLinecap="round"
              strokeDasharray={circumference.toFixed(1)}
              strokeDashoffset={strokeDashoffset.toFixed(1)}
              transform="rotate(-90 32 32)"
              style={{
                transition: 'stroke-dashoffset 0.5s ease',
              }}
            />

            {/* Centered percentage text inside the ring */}
            <text
              x="32"
              y="32"
              textAnchor="middle"
              dominantBaseline="central"
              fontSize="14"
              fontWeight="500"
              fill="#fdf3f0"
              style={{
                fontFamily: 'system-ui, -apple-system, sans-serif',
                pointerEvents: 'none',
              }}
            >
              {normalizedReadiness}%
            </text>
          </svg>
        </div>

        {/* Small caption below the ring: "Readiness" */}
        <span
          style={{
            fontSize: '10px',
            color: '#e7c3c0',
            fontWeight: 400,
            letterSpacing: '0.02em',
            lineHeight: 1,
          }}
        >
          Readiness
        </span>
      </div>
    </div>
  );
}
