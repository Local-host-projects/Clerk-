<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — Cash Meets E-Commerce</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">

  <style>
    /* ── TOKENS ──────────────────────────────────────── */
    :root {
      --bg:           #0A0A0A;
      --bg-off:       #0F0F0F;
      --bg-card:      #111111;
      --border:       #1E1E1E;
      --border-mid:   #2A2A2A;
      --text:         #F0EFE8;
      --text-muted:   #4A4A4A;
      --text-dim:     #222222;
      --accent:       #00E676;
      --accent-dim:   #003D1F;
      --accent-hover: #00FF85;
      --btn-text:     #0A0A0A;
      --grain:        0.03;
    }

    /* ── RESET ───────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Syne', sans-serif;
      overflow-x: hidden;
      cursor: none;
    }

    /* ── GRAIN ───────────────────────────────────────── */
    body::after {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
      opacity: var(--grain);
      pointer-events: none;
      z-index: 9998;
    }

    /* ── CUSTOM CURSOR ───────────────────────────────── */
    .cursor {
      position: fixed;
      width: 8px; height: 8px;
      background: var(--accent);
      border-radius: 50%;
      pointer-events: none;
      z-index: 9999;
      transform: translate(-50%, -50%);
      transition: width 0.15s, height 0.15s, opacity 0.15s;
      mix-blend-mode: difference;
    }

    .cursor.hover { width: 32px; height: 32px; opacity: 0.5; }

    /* ── NAV ─────────────────────────────────────────── */
    nav {
      position: fixed; top: 0; left: 0; right: 0;
      z-index: 100;
      border-bottom: 1px solid var(--border);
      background: rgba(10,10,10,0.88);
      backdrop-filter: blur(12px);
      padding: 0 48px;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .nav-logo {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 20px;
      letter-spacing: 0.14em;
      color: var(--text);
      text-decoration: none;
    }

    .nav-logo span { color: var(--accent); }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 32px;
      list-style: none;
    }

    .nav-links a {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-muted);
      text-decoration: none;
      transition: color 0.15s;
    }

    .nav-links a:hover { color: var(--text); }

    .nav-cta {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--btn-text) !important;
      background: var(--accent);
      padding: 9px 20px;
      text-decoration: none;
      transition: background 0.15s !important;
    }

    .nav-cta:hover { background: var(--accent-hover) !important; color: var(--btn-text) !important; }

    /* ── HERO ─────────────────────────────────────────── */
    .hero {
      min-height: 100vh;
      padding: 120px 48px 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    /* Background grid lines */
    .hero-grid {
      position: absolute; inset: 0;
      background-image:
        linear-gradient(var(--border) 1px, transparent 1px),
        linear-gradient(90deg, var(--border) 1px, transparent 1px);
      background-size: 80px 80px;
      opacity: 0.4;
      pointer-events: none;
    }

    /* Large accent circle — grid breaker */
    .hero-orb {
      position: absolute;
      right: -200px; top: 50%;
      transform: translateY(-50%);
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, var(--accent-dim) 0%, transparent 70%);
      pointer-events: none;
      animation: orb-breathe 6s ease-in-out infinite;
    }

    @keyframes orb-breathe {
      0%, 100% { opacity: 0.6; transform: translateY(-50%) scale(1); }
      50%       { opacity: 1;   transform: translateY(-50%) scale(1.06); }
    }

    /* Ticker bar above headline */
    .hero-ticker-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 32px;
      animation: fade-in-up 0.6s 0.1s both;
    }

    .ticker-dot {
      width: 6px; height: 6px;
      background: var(--accent);
      border-radius: 50%;
      animation: blink 1.2s ease-in-out infinite;
    }

    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

    .ticker-text {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--accent);
      letter-spacing: 0.12em;
      text-transform: uppercase;
    }

    /* Hero headline */
    .hero-headline {
      font-size: clamp(56px, 9vw, 128px);
      font-weight: 800;
      line-height: 0.92;
      letter-spacing: -0.03em;
      max-width: 900px;
      position: relative;
      z-index: 1;
    }

    .hero-headline .line {
      display: block;
      overflow: hidden;
    }

    .hero-headline .line span {
      display: block;
      animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .hero-headline .line:nth-child(1) span { animation-delay: 0.2s; }
    .hero-headline .line:nth-child(2) span { animation-delay: 0.32s; }
    .hero-headline .line:nth-child(3) span { animation-delay: 0.44s; }

    @keyframes slide-up {
      from { transform: translateY(110%); opacity: 0; }
      to   { transform: none; opacity: 1; }
    }

    .hero-headline .accent-word { color: var(--accent); }

    /* Hero sub */
    .hero-sub {
      margin-top: 32px;
      max-width: 480px;
      font-family: 'Space Mono', monospace;
      font-size: 13px;
      color: var(--text-muted);
      line-height: 1.8;
      animation: fade-in-up 0.7s 0.6s both;
      position: relative; z-index: 1;
    }

    @keyframes fade-in-up {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: none; }
    }

    /* Hero buttons */
    .hero-actions {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-top: 40px;
      animation: fade-in-up 0.7s 0.75s both;
      position: relative; z-index: 1;
    }

    .btn-primary {
      background: var(--accent);
      color: var(--btn-text);
      padding: 16px 32px;
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 13px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: background 0.15s;
      border: none; cursor: none;
    }

    .btn-primary:hover { background: var(--accent-hover); }

    .btn-ghost {
      background: transparent;
      color: var(--text-muted);
      padding: 16px 32px;
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      text-decoration: none;
      border: 1px solid var(--border);
      transition: border-color 0.15s, color 0.15s;
      cursor: none;
    }

    .btn-ghost:hover { border-color: var(--border-mid); color: var(--text); }

    /* Scroll indicator */
    .scroll-hint {
      position: absolute;
      bottom: 40px; left: 48px;
      display: flex; align-items: center; gap: 10px;
      animation: fade-in-up 0.7s 1.1s both;
    }

    .scroll-line {
      width: 40px; height: 1px;
      background: var(--border);
      position: relative;
      overflow: hidden;
    }

    .scroll-line::after {
      content: '';
      position: absolute; top: 0; left: -100%;
      width: 100%; height: 100%;
      background: var(--accent);
      animation: scroll-scan 2s ease-in-out infinite;
    }

    @keyframes scroll-scan {
      0%   { left: -100%; }
      100% { left: 100%; }
    }

    .scroll-text {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      color: var(--text-muted);
      letter-spacing: 0.14em;
      text-transform: uppercase;
    }

    /* Hero stats strip */
    .hero-stats {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      border-top: 1px solid var(--border);
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      animation: fade-in-up 0.7s 0.9s both;
    }

    .hero-stat {
      padding: 20px 48px;
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .hero-stat:last-child { border-right: none; }

    .stat-num {
      font-size: 28px;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: var(--text);
    }

    .stat-num .accent { color: var(--accent); }

    .stat-label {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-muted);
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    /* ── SECTION BASE ─────────────────────────────────── */
    section {
      padding: 120px 48px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .section-full {
      max-width: none;
      padding-left: 0; padding-right: 0;
    }

    .section-label {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--accent);
      letter-spacing: 0.16em;
      text-transform: uppercase;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .section-label::before {
      content: '';
      display: inline-block;
      width: 20px; height: 1px;
      background: var(--accent);
    }

    .section-title {
      font-size: clamp(36px, 5vw, 64px);
      font-weight: 800;
      line-height: 1.0;
      letter-spacing: -0.025em;
      margin-bottom: 20px;
    }

    .section-body {
      font-family: 'Space Mono', monospace;
      font-size: 12px;
      color: var(--text-muted);
      line-height: 1.9;
      max-width: 500px;
    }

    /* ── FLOW SECTION ─────────────────────────────────── */
    .flow-section {
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
      padding: 0;
    }

    .flow-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 100px 48px;
    }

    .flow-steps {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      margin-top: 72px;
      position: relative;
    }

    /* Connector line behind steps */
    .flow-steps::before {
      content: '';
      position: absolute;
      top: 36px; left: 10%; right: 10%;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--border), var(--border), var(--border), transparent);
    }

    .flow-step {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 0 16px;
      gap: 16px;
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s, transform 0.6s;
    }

    .flow-step.visible { opacity: 1; transform: none; }
    .flow-step:nth-child(1) { transition-delay: 0.0s; }
    .flow-step:nth-child(2) { transition-delay: 0.1s; }
    .flow-step:nth-child(3) { transition-delay: 0.2s; }
    .flow-step:nth-child(4) { transition-delay: 0.3s; }
    .flow-step:nth-child(5) { transition-delay: 0.4s; }

    .flow-icon {
      width: 72px; height: 72px;
      border: 1px solid var(--border);
      background: var(--bg-card);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 1;
      flex-shrink: 0;
      transition: border-color 0.2s;
    }

    .flow-step:hover .flow-icon { border-color: var(--accent); }

    .flow-icon svg { width: 28px; height: 28px; stroke: var(--text-muted); fill: none; transition: stroke 0.2s; }
    .flow-step:hover .flow-icon svg { stroke: var(--accent); }

    .flow-step-num {
      position: absolute;
      top: -8px; right: -8px;
      width: 18px; height: 18px;
      background: var(--accent);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Space Mono', monospace;
      font-size: 8px;
      color: var(--btn-text);
      font-weight: 700;
    }

    .flow-step-title {
      font-size: 14px;
      font-weight: 800;
      letter-spacing: -0.01em;
      color: var(--text);
    }

    .flow-step-desc {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-muted);
      line-height: 1.7;
    }

    /* Arrow between steps */
    .flow-arrow {
      position: absolute;
      top: 28px;
      width: 16px; height: 16px;
      color: var(--text-dim);
      font-size: 16px;
      z-index: 2;
    }

    /* ── TWO-COLUMN PITCH ─────────────────────────────── */
    .pitch-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1px;
      background: var(--border);
      border: 1px solid var(--border);
      margin-top: 0;
    }

    .pitch-card {
      background: var(--bg);
      padding: 64px 56px;
      display: flex;
      flex-direction: column;
      gap: 28px;
      transition: background 0.2s;
    }

    .pitch-card:hover { background: var(--bg-card); }

    .pitch-tag {
      font-family: 'Space Mono', monospace;
      font-size: 9px;
      color: var(--accent);
      letter-spacing: 0.16em;
      text-transform: uppercase;
      border: 1px solid var(--accent-dim);
      padding: 4px 10px;
      width: fit-content;
      background: var(--accent-dim);
    }

    .pitch-title {
      font-size: clamp(28px, 3vw, 42px);
      font-weight: 800;
      letter-spacing: -0.025em;
      line-height: 1.05;
    }

    .pitch-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .pitch-list li {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      color: var(--text-muted);
      line-height: 1.65;
      display: flex;
      gap: 12px;
    }

    .pitch-list li::before {
      content: '→';
      color: var(--accent);
      flex-shrink: 0;
    }

    .pitch-cta {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--accent);
      text-decoration: none;
      border-bottom: 1px solid var(--accent-dim);
      padding-bottom: 4px;
      width: fit-content;
      transition: border-color 0.15s;
      cursor: none;
    }

    .pitch-cta:hover { border-color: var(--accent); }

    /* ── FEATURE GRID ─────────────────────────────────── */
    .feature-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1px;
      background: var(--border);
      border: 1px solid var(--border);
    }

    .feature-card {
      background: var(--bg);
      padding: 40px 36px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      transition: background 0.2s;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.5s, transform 0.5s, background 0.2s;
    }

    .feature-card.visible { opacity: 1; transform: none; }
    .feature-card:hover { background: var(--bg-card); }

    .feature-card:nth-child(1) { transition-delay: 0s; }
    .feature-card:nth-child(2) { transition-delay: 0.08s; }
    .feature-card:nth-child(3) { transition-delay: 0.16s; }
    .feature-card:nth-child(4) { transition-delay: 0.24s; }
    .feature-card:nth-child(5) { transition-delay: 0.32s; }
    .feature-card:nth-child(6) { transition-delay: 0.40s; }

    .feature-icon {
      width: 40px; height: 40px;
      border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
    }

    .feature-icon svg { width: 18px; height: 18px; stroke: var(--accent); fill: none; }

    .feature-title {
      font-size: 16px;
      font-weight: 800;
      letter-spacing: -0.01em;
    }

    .feature-desc {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-muted);
      line-height: 1.75;
    }

    /* ── MARQUEE ──────────────────────────────────────── */
    .marquee-section {
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
      padding: 24px 0;
      overflow: hidden;
    }

    .marquee-track {
      display: flex;
      gap: 0;
      animation: marquee 20s linear infinite;
      width: max-content;
    }

    @keyframes marquee {
      from { transform: translateX(0); }
      to   { transform: translateX(-50%); }
    }

    .marquee-item {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      color: var(--text-muted);
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 0 40px;
      border-right: 1px solid var(--border);
      white-space: nowrap;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .marquee-dot {
      width: 4px; height: 4px;
      background: var(--accent);
      border-radius: 50%;
      flex-shrink: 0;
    }

    /* ── TESTIMONIAL / PROOF ──────────────────────────── */
    .proof-section {
      border-top: 1px solid var(--border);
    }

    .proof-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 48px;
      margin-top: 56px;
    }

    .proof-card {
      border: 1px solid var(--border);
      padding: 36px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s, transform 0.6s;
    }

    .proof-card.visible { opacity: 1; transform: none; }
    .proof-card:nth-child(2) { transition-delay: 0.15s; }

    .proof-quote {
      font-size: 16px;
      font-weight: 700;
      line-height: 1.45;
      letter-spacing: -0.01em;
      color: var(--text);
    }

    .proof-attr {
      display: flex;
      flex-direction: column;
      gap: 4px;
      padding-top: 16px;
      border-top: 1px solid var(--border);
    }

    .proof-name {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      color: var(--text);
      font-weight: 700;
    }

    .proof-role {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-muted);
      letter-spacing: 0.06em;
    }

    /* ── BIG NUMBER SECTION ───────────────────────────── */
    .numbers-section {
      border-top: 1px solid var(--border);
      padding: 0;
    }

    .numbers-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      border-bottom: 1px solid var(--border);
    }

    .number-cell {
      padding: 72px 64px;
      border-right: 1px solid var(--border);
      opacity: 0;
      transform: translateY(16px);
      transition: opacity 0.6s, transform 0.6s;
    }

    .number-cell:last-child { border-right: none; }
    .number-cell.visible { opacity: 1; transform: none; }
    .number-cell:nth-child(2) { transition-delay: 0.1s; }
    .number-cell:nth-child(3) { transition-delay: 0.2s; }

    .big-num {
      font-size: clamp(48px, 6vw, 80px);
      font-weight: 800;
      letter-spacing: -0.03em;
      color: var(--text);
      line-height: 1;
      margin-bottom: 8px;
    }

    .big-num .accent { color: var(--accent); }

    .big-num-label {
      font-family: 'Space Mono', monospace;
      font-size: 11px;
      color: var(--text-muted);
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    /* ── CTA SECTION ──────────────────────────────────── */
    .cta-section {
      padding: 140px 48px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 32px;
      position: relative;
      overflow: hidden;
    }

    .cta-section::before {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(circle at 50% 60%, var(--accent-dim) 0%, transparent 60%);
      opacity: 0.4;
    }

    .cta-headline {
      font-size: clamp(40px, 6vw, 80px);
      font-weight: 800;
      letter-spacing: -0.03em;
      line-height: 1.0;
      position: relative; z-index: 1;
      max-width: 800px;
    }

    .cta-sub {
      font-family: 'Space Mono', monospace;
      font-size: 12px;
      color: var(--text-muted);
      line-height: 1.8;
      max-width: 400px;
      position: relative; z-index: 1;
    }

    .cta-actions {
      display: flex;
      gap: 12px;
      position: relative; z-index: 1;
    }

    /* ── FOOTER ───────────────────────────────────────── */
    footer {
      border-top: 1px solid var(--border);
      padding: 40px 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .footer-logo {
      font-family: 'Syne', sans-serif;
      font-weight: 800;
      font-size: 16px;
      letter-spacing: 0.14em;
      color: var(--text);
    }

    .footer-logo span { color: var(--accent); }

    .footer-copy {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-muted);
      letter-spacing: 0.06em;
    }

    .footer-links {
      display: flex;
      gap: 24px;
      list-style: none;
    }

    .footer-links a {
      font-family: 'Space Mono', monospace;
      font-size: 10px;
      color: var(--text-muted);
      text-decoration: none;
      letter-spacing: 0.08em;
      transition: color 0.15s;
    }

    .footer-links a:hover { color: var(--text); }

    /* ── REVEAL UTILITY ───────────────────────────────── */
    .reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.7s, transform 0.7s;
    }

    .reveal.visible { opacity: 1; transform: none; }

    /* ── RESPONSIVE ───────────────────────────────────── */
    @media (max-width: 900px) {
      nav { padding: 0 24px; }
      .nav-links { display: none; }
      .hero { padding: 100px 24px 80px; }
      section { padding: 80px 24px; }
      .flow-steps { grid-template-columns: 1fr 1fr; gap: 32px; }
      .flow-steps::before { display: none; }
      .pitch-grid { grid-template-columns: 1fr; }
      .feature-grid { grid-template-columns: 1fr 1fr; }
      .proof-grid { grid-template-columns: 1fr; }
      .numbers-grid { grid-template-columns: 1fr 1fr; }
      .hero-stats { grid-template-columns: 1fr 1fr; }
      .hero-stat { padding: 20px 24px; }
      footer { flex-direction: column; gap: 20px; text-align: center; }
      .cta-section { padding: 80px 24px; }
    }

    @media (max-width: 600px) {
      .hero-headline { font-size: clamp(40px, 12vw, 64px); }
      .feature-grid { grid-template-columns: 1fr; }
      .numbers-grid { grid-template-columns: 1fr; }
      .hero-stats { grid-template-columns: 1fr 1fr; }
      .pitch-card { padding: 40px 28px; }
    }
  </style>
</head>
<body>

  <!-- Custom cursor -->
  <div class="cursor" id="cursor"></div>

  <!-- ── NAV ─────────────────────────────────────────── -->
  <nav>
    <a href="#" class="nav-logo">CLR<span>K</span></a>
    <ul class="nav-links">
      <li><a href="#how">How It Works</a></li>
      <li><a href="#merchants">Merchants</a></li>
      <li><a href="#agents">Agents</a></li>
      <li><a href="#features">Features</a></li>
      <li><a href="#" class="nav-cta">Get Started →</a></li>
    </ul>
  </nav>

  <!-- ── HERO ─────────────────────────────────────────── -->
  <section class="hero section-full" style="padding-left:48px;padding-right:48px;max-width:none">
    <div class="hero-grid"></div>
    <div class="hero-orb"></div>

    <div class="hero-ticker-wrap">
      <div class="ticker-dot"></div>
      <span class="ticker-text">Now live — Nigeria's first biometric cash checkout</span>
    </div>

    <h1 class="hero-headline">
      <span class="line"><span>Cash in hand.</span></span>
      <span class="line"><span>Paid <span class="accent-word">online.</span></span></span>
      <span class="line"><span>Instantly.</span></span>
    </h1>

    <p class="hero-sub">
      Clerk connects cash-economy Nigerians to e-commerce through biometric identity and trusted agent networks. No bank account required.
    </p>

    <div class="hero-actions">
      <a href="#" class="btn-primary">Start Accepting Clerk <span>→</span></a>
      <a href="#how" class="btn-ghost">See How It Works</a>
    </div>

    <div class="scroll-hint">
      <div class="scroll-line"></div>
      <span class="scroll-text">Scroll</span>
    </div>

    <div class="hero-stats">
      <div class="hero-stat">
        <span class="stat-num"><span class="accent" id="stat-agents">41</span>K+</span>
        <span class="stat-label">Agent Network Points</span>
      </div>
      <div class="hero-stat">
        <span class="stat-num"><span class="accent">₦</span>0</span>
        <span class="stat-label">Setup Fee for Merchants</span>
      </div>
      <div class="hero-stat">
        <span class="stat-num"><span class="accent">1.5</span>%</span>
        <span class="stat-label">Per-Transaction Fee</span>
      </div>
      <div class="hero-stat">
        <span class="stat-num"><span class="accent">&lt;3</span>s</span>
        <span class="stat-label">Average Scan Time</span>
      </div>
    </div>
  </section>

  <!-- ── MARQUEE ──────────────────────────────────────── -->
  <div class="marquee-section">
    <div class="marquee-track" id="marquee-track"></div>
  </div>

  <!-- ── HOW IT WORKS ─────────────────────────────────── -->
  <div class="flow-section" id="how">
    <div class="flow-inner">
      <span class="section-label reveal">The Flow</span>
      <h2 class="section-title reveal">Five steps.<br>One seamless purchase.</h2>
      <p class="section-body reveal">The informal trust networks that already exist in Nigerian commerce — formalised, secured, and connected to the internet.</p>

      <div class="flow-steps" id="flow-steps">

        <div class="flow-step">
          <div class="flow-icon">
            <div class="flow-step-num">1</div>
            <svg viewBox="0 0 24 24" stroke-width="1.2" stroke-linecap="round">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
              <circle cx="12" cy="9" r="2.5"/>
            </svg>
          </div>
          <span class="flow-step-title">Customer gives cash</span>
          <p class="flow-step-desc">Customer hands cash to their trusted Clerk agent — a local shop, kiosk, or neighbour.</p>
        </div>

        <div class="flow-step">
          <div class="flow-icon">
            <div class="flow-step-num">2</div>
            <svg viewBox="0 0 24 24" stroke-width="1.2" stroke-linecap="round">
              <rect x="2" y="5" width="20" height="14" rx="0"/>
              <line x1="2" y1="10" x2="22" y2="10"/>
            </svg>
          </div>
          <span class="flow-step-title">Agent loads escrow</span>
          <p class="flow-step-desc">Agent credits the customer's biometric escrow account via their registered card.</p>
        </div>

        <div class="flow-step">
          <div class="flow-icon">
            <div class="flow-step-num">3</div>
            <svg viewBox="0 0 24 24" stroke-width="1.2" stroke-linecap="round">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
          </div>
          <span class="flow-step-title">Customer scans face</span>
          <p class="flow-step-desc">At checkout, a live biometric scan identifies the customer and locates their balance.</p>
        </div>

        <div class="flow-step">
          <div class="flow-icon">
            <div class="flow-step-num">4</div>
            <svg viewBox="0 0 24 24" stroke-width="1.2" stroke-linecap="round">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.67A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92"/>
            </svg>
          </div>
          <span class="flow-step-title">Agent approves</span>
          <p class="flow-step-desc">Agent receives a push notification and taps approve in the Clerk app in seconds.</p>
        </div>

        <div class="flow-step">
          <div class="flow-icon">
            <div class="flow-step-num">5</div>
            <svg viewBox="0 0 24 24" stroke-width="1.2" stroke-linecap="round">
              <polyline points="20,6 9,17 4,12"/>
            </svg>
          </div>
          <span class="flow-step-title">Merchant settled</span>
          <p class="flow-step-desc">Clerk releases escrow and settles the merchant via Interswitch Payout. Order confirmed.</p>
        </div>

      </div>
    </div>
  </div>

  <!-- ── FOR MERCHANTS & CUSTOMERS ─────────────────────── -->
  <section id="merchants" style="padding:0;max-width:none">
    <div class="pitch-grid">
      <div class="pitch-card">
        <span class="pitch-tag">For Merchants</span>
        <h3 class="pitch-title">Stop leaving cash customers behind.</h3>
        <ul class="pitch-list">
          <li>Drop a single redirect URL into your checkout — no SDK required</li>
          <li>Clerk handles identity, escrow, settlement, and webhooks for you</li>
          <li>Reach 133 million Nigerians without bank accounts or cards</li>
          <li>Settlement direct to your account via Interswitch Payout API</li>
          <li>Real-time order confirmations — zero chargebacks from cash fraud</li>
        </ul>
        <a href="#" class="pitch-cta">Integrate Clerk → </a>
      </div>
      <div class="pitch-card">
        <span class="pitch-tag">For Agents</span>
        <h3 class="pitch-title">Your trust network is your income.</h3>
        <ul class="pitch-list">
          <li>Earn custody fees on every naira held in customer escrow accounts</li>
          <li>Approve payments with a single tap — no cash handling at point of sale</li>
          <li>Register customers by face in seconds using the Clerk agent app</li>
          <li>Works on any Android phone — no POS hardware required</li>
          <li>Built on OPay and Moniepoint infrastructure you already use</li>
        </ul>
        <a href="#" class="pitch-cta">Become an Agent → </a>
      </div>
    </div>
  </section>

  <!-- ── FEATURE GRID ─────────────────────────────────── -->
  <section id="features">
    <span class="section-label reveal">Built Different</span>
    <h2 class="section-title reveal">Every layer<br>rethought.</h2>

    <div class="feature-grid" style="margin-top:56px">
      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h4 class="feature-title">Biometric liveness check</h4>
        <p class="feature-desc">Three-challenge MediaPipe liveness detection — blink, turn, hold — confirms a real person is present before any payment is released.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
        </div>
        <h4 class="feature-title">Real-time settlement</h4>
        <p class="feature-desc">Escrow is released the moment the agent approves. Merchant receives funds and webhook confirmation in under three seconds via Interswitch.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="11" width="18" height="11"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
        </div>
        <h4 class="feature-title">Escrow-model security</h4>
        <p class="feature-desc">Funds are held in trust — never in a wallet, never in a bank. The escrow framing eliminates CBN deposit-taking classification entirely.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
        </div>
        <h4 class="feature-title">Hosted checkout</h4>
        <p class="feature-desc">Merchants redirect to a Clerk-hosted page. No UI to build. No payment data touches merchant servers. Full PCI compliance by design.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <h4 class="feature-title">Agent network at scale</h4>
        <p class="feature-desc">Built on top of Interswitch Quickteller's 41,000+ agent points. Customer can load escrow at any registered agent near them.</p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"><polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/></svg>
        </div>
        <h4 class="feature-title">Webhook-first API</h4>
        <p class="feature-desc">Merchants receive real-time status webhooks at every stage — pending, approved, settled, failed — with signed payloads and idempotent delivery.</p>
      </div>
    </div>
  </section>

  <!-- ── NUMBERS ───────────────────────────────────────── -->
  <div class="numbers-section">
    <div class="numbers-grid">
      <div class="number-cell">
        <div class="big-num"><span class="accent">133</span>M</div>
        <p class="big-num-label">Nigerians without bank accounts</p>
      </div>
      <div class="number-cell">
        <div class="big-num"><span class="accent">₦</span>97T</div>
        <p class="big-num-label">Annual informal cash economy</p>
      </div>
      <div class="number-cell">
        <div class="big-num"><span class="accent">0</span></div>
        <p class="big-num-label">Existing biometric cash checkout products</p>
      </div>
    </div>
  </div>

  <!-- ── PROOF ─────────────────────────────────────────── -->
  <section class="proof-section">
    <span class="section-label reveal">Early Feedback</span>
    <h2 class="section-title reveal">People already<br>understand it.</h2>

    <div class="proof-grid">
      <div class="proof-card">
        <p class="proof-quote">"I didn't believe you could buy online without a card until I saw this. My customers have been asking for something like this for years."</p>
        <div class="proof-attr">
          <span class="proof-name">Funke Adeyemi</span>
          <span class="proof-role">E-commerce merchant — Yaba, Lagos</span>
        </div>
      </div>
      <div class="proof-card">
        <p class="proof-quote">"The agent model makes perfect sense. People already trust us with their money. Clerk just makes that formal. I want to be one of the first agents."</p>
        <div class="proof-attr">
          <span class="proof-name">Chukwuemeka Obi</span>
          <span class="proof-role">OPay agent — Surulere, Lagos</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ── CTA ───────────────────────────────────────────── -->
  <section class="cta-section section-full" style="max-width:none">
    <h2 class="cta-headline">The cash economy<br>goes <span style="color:var(--accent)">online.</span><br>Starting now.</h2>
    <p class="cta-sub">Be among the first merchants to accept Clerk at checkout. Integration takes under an hour.</p>
    <div class="cta-actions">
      <a href="#" class="btn-primary">Integrate Clerk <span>→</span></a>
      <a href="#" class="btn-ghost">Read the Docs</a>
    </div>
  </section>

  <!-- ── FOOTER ─────────────────────────────────────────── -->
  <footer>
    <div class="footer-logo">CLR<span>K</span></div>
    <ul class="footer-links">
      <li><a href="#">Docs</a></li>
      <li><a href="#">Merchants</a></li>
      <li><a href="#">Agents</a></li>
      <li><a href="#">Privacy</a></li>
      <li><a href="#">Terms</a></li>
    </ul>
    <p class="footer-copy">© 2024 Clerk Technologies Ltd · Lagos, Nigeria</p>
  </footer>

  <script>
    // ── CURSOR ────────────────────────────────────────────
    const cursor = document.getElementById('cursor');
    document.addEventListener('mousemove', e => {
      cursor.style.left = e.clientX + 'px';
      cursor.style.top  = e.clientY + 'px';
    });

    document.querySelectorAll('a, button, .format-opt, .flow-step, .feature-card, .pitch-card').forEach(el => {
      el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
      el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
    });

    // ── MARQUEE ───────────────────────────────────────────
    const MARQUEE_ITEMS = [
      'Cash accepted online', 'Biometric identity', 'No bank account needed',
      'Interswitch settled', 'Agent network', 'Liveness detection',
      'Real-time webhooks', 'Zero setup fee', 'Escrow protected',
      'Built for Nigeria',
    ];

    const track = document.getElementById('marquee-track');
    const repeated = [...MARQUEE_ITEMS, ...MARQUEE_ITEMS];
    track.innerHTML = repeated.map(t =>
      `<span class="marquee-item"><span class="marquee-dot"></span>${t}</span>`
    ).join('');

    // ── SCROLL REVEAL ─────────────────────────────────────
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll(
      '.reveal, .flow-step, .feature-card, .number-cell, .proof-card'
    ).forEach(el => observer.observe(el));

    // ── COUNTER ANIMATION ──────────────────────────────────
    function animateCounter(el, target, suffix = '') {
      let current = 0;
      const step  = target / 60;
      const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = Math.floor(current) + suffix;
        if (current >= target) clearInterval(timer);
      }, 16);
    }

    // Trigger on hero load
    setTimeout(() => {
      animateCounter(document.getElementById('stat-agents'), 41);
    }, 800);
  </script>
</body>
</html>
