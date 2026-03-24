<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Clerk — @section('title') login @show</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
@stack('styles')
</head>
<body>
<div class="bg-grid"></div>
<div class="bg-glow"></div>

<header class="topbar">
  <a href="/" class="wordmark">CLR<span>K</span></a>
  <div class="topbar-r">
    @stack('navigateTo')
    <button class="theme-btn" onclick="toggleTheme()">
      <svg id="ti" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></svg>
    </button>
  </div>
</header>

@yield('main')
@stack('scripts')

</body>
</html>