<!DOCTYPE html>
<html lang="en" class="bg-[#f7fafd]">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Expense Tracker</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;700;900&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Red Hat Display', sans-serif; }
=


  @keyframes gradientmove {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
  }
  .ripple { position: relative; overflow: hidden; }
  .ripple:after {
    content: ""; display: block; position: absolute; border-radius: 50%;
    width: 100px; height: 100px; left: 50%; top: 50%;
    pointer-events: none; background: rgba(255,255,255,.2);
    transform: scale(0) translate(-50%, -50%);
    opacity: 0; transition: transform .4s, opacity .8s;
  }
  .ripple:active:after {
    transform: scale(2.2) translate(-50%, -50%);
    opacity: 1; transition: 0s;
  }
  .card-hover { transition: transform 0.2s, box-shadow 0.3s; }
  .card-hover:hover { transform: translateY(-7px) scale(1.02); box-shadow: 0 12px 32px -8px #5ac9ee22; }
  .floating-icon {
    animation: float 2.4s ease-in-out infinite alternate;
  }
  @keyframes float {
    from { transform: translateY(0);}
    to { transform: translateY(-16px);}
  }
  .donut {
    background:
      radial-gradient(closest-side, #fff 79%, transparent 80% 100%),
      conic-gradient(#09A6F3 0 67%, #e6e9fd 0 100%);
  }
  .donut2 {
    background:
      radial-gradient(closest-side, #fff 79%, transparent 80% 100%),
      conic-gradient(#15B77B 0 33%, #e6e9fd 0 100%);
  }
  .fade-section {
    opacity: 0;
    transform: translateY(32px);
    transition: opacity 0.8s cubic-bezier(.4,0,.2,1), transform 0.8s cubic-bezier(.4,0,.2,1);
  }
  .fade-section.visible {
    opacity: 1;
    transform: translateY(0);
  }
  .nav-anim-link {
    position: relative;
    overflow: hidden;
    transition: color 0.22s;
  }
  .nav-anim-link::after {
    content: '';
    position: absolute;
    left: 0; bottom: 0;
    width: 100%; height: 2.5px;
    background: #09A6F3;
    transform: translateX(-101%);
    transition: transform 0.38s cubic-bezier(.4,0,.2,1);
  }
  .nav-anim-link:hover::after,
  .nav-anim-link:focus::after,
  .nav-anim-link.active::after {
    transform: translateX(0);
  }
  .nav-anim-link.active,
  .nav-anim-link:focus,
  .nav-anim-link:active {
    color: #09A6F3 !important;
    background: #e3f7fd;
  }
  .slide-fade {
    transition: opacity 0.35s cubic-bezier(.4,0,.2,1), transform 0.38s cubic-bezier(.4,0,.2,1);
    opacity: 0; transform: translateY(-18px) scale(.96);
    pointer-events: none;
  }
  .slide-fade.open {
    opacity: 1; transform: translateY(0) scale(1);
    pointer-events: auto;
  }
</style>

</head>
<body class="bg-[#f7fafd] min-h-screen font-sans relative">
  <!-- Animated Gradient Background -->
  <div class="gradient-bg"></div>

  <!-- Navbar -->
<!-- Navbar -->
  <nav class="bg-white/70 backdrop-blur shadow-sm sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center relative">
      <!-- Logo -->
      <div class="flex items-center gap-2 text-2xl font-bold text-[#09A6F3] tracking-wide">
        <svg class="w-7 h-7 text-[#09A6F3]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"/>
          <path d="M8 12h8M12 8v8"/>
        </svg>
        Expense Tracker
      </div>
      <!-- Desktop Links -->
      <div class="hidden md:flex gap-6 items-center">
        <a href="#dashboard" class="nav-anim-link text-gray-700 hover:text-[#09A6F3] font-medium transition focus:outline-none px-2 py-1 rounded" data-link="dashboard">
          Dashboard
        </a>
        <a href="#expenses" class="nav-anim-link text-gray-700 hover:text-[#09A6F3] font-medium transition focus:outline-none px-2 py-1 rounded" data-link="expenses">
          Expenses
        </a>
        <a href="#analytics" class="nav-anim-link text-gray-700 hover:text-[#09A6F3] font-medium transition focus:outline-none px-2 py-1 rounded" data-link="analytics">
          Analytics
        </a>
        <a href="#goals" class="nav-anim-link text-gray-700 hover:text-[#09A6F3] font-medium transition focus:outline-none px-2 py-1 rounded" data-link="goals">
          Goals
        </a>
        <a href="#faq" class="nav-anim-link text-gray-700 hover:text-[#09A6F3] font-medium transition focus:outline-none px-2 py-1 rounded" data-link="faq">
          FAQ
        </a>
        <!-- Auth Buttons -->
        <div class="flex gap-2 ml-3">
          <a href="/login">
            <button class="bg-[#15B77B] hover:bg-[#09A6F3] focus:bg-[#09A6F3] text-white px-5 py-2 rounded-2xl shadow font-semibold transition-all duration-200 ripple focus:outline-none">
              Login
            </button>
          </a>
          <a href="/register">
            <button class="bg-white border-2 border-[#09A6F3] text-[#09A6F3] hover:bg-[#09A6F3] hover:text-white focus:bg-[#09A6F3] focus:text-white px-5 py-2 rounded-2xl shadow font-semibold transition-all duration-200 ripple focus:outline-none">
              Sign Up
            </button>
          </a>
        </div>
      </div>
      <!-- Hamburger menu (Mobile) -->
      <button id="navbar-toggle" class="md:hidden flex items-center px-3 py-2 border rounded text-[#09A6F3] border-[#09A6F3] hover:bg-[#e3f7fd] transition focus:outline-none" aria-label="Toggle menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/>
        </svg>
      </button>
    </div>
    <!-- Mobile Menu -->
<div id="mobile-menu"
   class="md:hidden fixed top-4 left-1/2 -translate-x-1/2 w-[95vw] max-w-sm bg-white/95 rounded-2xl z-50 flex flex-col p-6
  shadow-xl transition-all duration-300 ease-in-out opacity-0 pointer-events-none scale-95 space-y-2">
  
      <a href="#dashboard" class="nav-anim-link block text-gray-700 hover:text-[#09A6F3] font-medium py-2 rounded" data-link="dashboard">Dashboard</a>
      <a href="#expenses" class="nav-anim-link block text-gray-700 hover:text-[#09A6F3] font-medium py-2 rounded" data-link="expenses">Expenses</a>
      <a href="#analytics" class="nav-anim-link block text-gray-700 hover:text-[#09A6F3] font-medium py-2 rounded" data-link="analytics">Analytics</a>
      <a href="#goals" class="nav-anim-link block text-gray-700 hover:text-[#09A6F3] font-medium py-2 rounded" data-link="goals">Goals</a>
      <a href="#faq" class="nav-anim-link block text-gray-700 hover:text-[#09A6F3] font-medium py-2 rounded" data-link="faq">FAQ</a>
      <div class="flex flex-col gap-2 mt-2">
        <a href="/login">
          <button class="w-full bg-[#15B77B] hover:bg-[#09A6F3] focus:bg-[#09A6F3] text-white px-5 py-2 rounded-2xl shadow font-semibold transition-all duration-200 ripple focus:outline-none">
            Login
          </button>
        </a>
        <a href="/register">
          <button class="w-full bg-white border-2 border-[#09A6F3] text-[#09A6F3] hover:bg-[#09A6F3] hover:text-white focus:bg-[#09A6F3] focus:text-white px-5 py-2 rounded-2xl shadow font-semibold transition-all duration-200 ripple focus:outline-none">
            Sign Up
          </button>
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Dashboard -->
 <!-- HERO SECTION (IMPROVED) -->
<section id="dashboard" class="relative max-w-6xl mx-auto mt-10 px-4 py-12 flex flex-col md:flex-row gap-10 items-center justify-between bg-white rounded-3xl shadow-xl fade-section overflow-hidden z-10">
  <!-- Animated gradient background shape -->
  <div class="absolute left-[-100px] top-[-100px] w-[340px] h-[340px] bg-gradient-to-tr from-[#15B77B]/30 via-[#09A6F3]/40 to-[#F73D59]/20 rounded-full blur-3xl z-0 animate-pulse-slow"></div>
  <!-- Content -->
  <div class="flex-1 relative z-10">
    <span class="inline-flex items-center gap-2 mb-4 px-4 py-1 rounded-full text-xs font-bold bg-[#e6f9f3] text-[#15B77B] animate-fade-in-up">
      <svg class="w-5 h-5" fill="none" stroke="#15B77B" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"/></svg>
      Smarter Spending Starts Today!
    </span>
    <h1 class="text-4xl md:text-5xl font-extrabold text-[#172642] mb-4 tracking-tight leading-tight animate-fade-in-up" style="animation-delay:0.15s">
      Take Control of Your <span class="text-[#09A6F3]">Finances</span>
    </h1>
    <p class="text-lg text-gray-600 mb-8 animate-fade-in-up" style="animation-delay:0.3s">
      Track expenses, set budgets, and reach your goals easily.<br class="hidden md:block"> All with real-time analytics and smart visual reports.
    </p>
    <div class="flex flex-col md:flex-row gap-4 animate-fade-in-up" style="animation-delay:0.45s">
      <button class="bg-[#15B77B] hover:bg-[#09A6F3] text-white font-bold px-8 py-3 rounded-2xl shadow-md text-lg transition ripple">Get Started</button>
      <button class="bg-[#F73D59] hover:bg-[#172642] text-white font-bold px-8 py-3 rounded-2xl shadow-md text-lg transition ripple">Demo</button>
      <a href="/register">
        <button class="bg-[#09A6F3] hover:bg-[#15B77B] text-white font-bold px-8 py-3 rounded-2xl shadow-md text-lg transition ripple">Sign Up</button>
      </a>
    </div>
  </div>
  <!-- Dashboard Preview & Animated Icons -->
  <div class="flex-1 flex justify-center relative z-10 animate-fade-in-up" style="animation-delay:0.7s">
    <div class="relative">
      <img src="https://cloudfileconverter.site/images/Screenshot%202025-05-29%20034233.png"
           alt="Expense Tracker Dashboard"
           class="w-[370px] h-[270px] rounded-2xl shadow-lg border-4 border-[#f7fafd]"/>
      <!-- Floating SVG Money Icon -->
      <svg class="absolute -top-8 left-[-38px] w-16 h-16 floating-icon" fill="none" viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="24" fill="#09A6F3" opacity="0.13"/>
        <path d="M18 30s1.5-4 6-4 6 4 6 4" stroke="#15B77B" stroke-width="2" fill="none"/>
        <circle cx="24" cy="20" r="4" fill="#F73D59"/>
      </svg>
      <!-- Floating SVG Chart Icon -->
      <svg class="absolute bottom-[-24px] right-[-30px] w-12 h-12 floating-icon" fill="none" viewBox="0 0 48 48">
        <rect x="8" y="8" width="32" height="32" rx="8" fill="#15B77B" opacity="0.12"/>
        <path d="M16 32l8-12 8 6" stroke="#09A6F3" stroke-width="2"/>
        <circle cx="16" cy="32" r="2" fill="#F73D59"/>
        <circle cx="24" cy="20" r="2" fill="#15B77B"/>
        <circle cx="32" cy="26" r="2" fill="#09A6F3"/>
      </svg>
      <!-- Shiny stat badge -->
      <div class="absolute top-3 right-[-30px] bg-white border-2 border-[#09A6F3] rounded-xl shadow-md px-4 py-2 flex items-center gap-2 animate-fade-in-up" style="animation-delay:0.8s">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="11" fill="#15B77B" opacity="0.12"/><path d="M9 12l2 2 4-4" stroke="#15B77B" stroke-width="2" stroke-linecap="round"/></svg>
        <span class="font-bold text-[#15B77B] text-base">97% Satisfaction</span>
      </div>
    </div>
  </div>
</section>

<!-- Hero Animations -->
<style>
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(32px);}
    to   { opacity: 1; transform: translateY(0);}
  }
  .animate-fade-in-up { opacity: 0; animation: fadeInUp 1s cubic-bezier(.4,0,.2,1) forwards; }
  .animate-fade-in-up[style*="animation-delay"] { animation-fill-mode: both; }
  @keyframes pulseSlow { 0%,100% {opacity:.65;} 50%{opacity:1;} }
  .animate-pulse-slow { animation: pulseSlow 4s infinite; }
  .floating-icon { animation: floatIcon 2.8s ease-in-out infinite alternate; }
  @keyframes floatIcon { from { transform: translateY(0);} to { transform: translateY(-14px);} }
  .nav-anim-link {
    position: relative;
    overflow: hidden;
  }
  .nav-anim-link::after {
    content: '';
    position: absolute;
    left: 0; bottom: 0;
    width: 100%; height: 2px;
    background: #09A6F3;
    transform: translateX(-100%);
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
  }
  .nav-anim-link:hover::after, .nav-anim-link:focus::after, .nav-anim-link.active::after {
    transform: translateX(0);
  }
</style>


  <!-- Section Divider -->
  <div class="max-w-6xl mx-auto h-8 flex items-center justify-center">
    <div class="w-48 h-1 rounded-full bg-gradient-to-r from-[#09A6F3] via-[#15B77B] to-[#F73D59] opacity-60"></div>
  </div>

  <!-- Stats Summary Cards -->
  <section class="max-w-6xl mx-auto mt-10 px-4 grid md:grid-cols-3 gap-8 fade-section">
    <div class="bg-[#f7fafd] rounded-2xl shadow-md p-8 flex flex-col items-center card-hover">
      <div class="text-4xl font-bold text-[#09A6F3] mb-2">$4,350</div>
      <div class="text-gray-600 font-medium">Total Spent</div>
    </div>
    <div class="bg-[#f7fafd] rounded-2xl shadow-md p-8 flex flex-col items-center card-hover">
      <div class="text-4xl font-bold text-[#15B77B] mb-2">$900</div>
      <div class="text-gray-600 font-medium">This Month</div>
    </div>
    <div class="bg-[#f7fafd] rounded-2xl shadow-md p-8 flex flex-col items-center card-hover">
      <div class="text-4xl font-bold text-[#F73D59] mb-2">$250</div>
      <div class="text-gray-600 font-medium">Saved</div>
    </div>
  </section>

  <!-- Section Divider -->
  <div class="max-w-6xl mx-auto h-8 flex items-center justify-center">
    <div class="w-36 h-1 rounded-full bg-gradient-to-r from-[#F73D59] via-[#09A6F3] to-[#15B77B] opacity-50"></div>
  </div>

  <!-- Expenses List -->
  <section id="expenses" class="max-w-6xl mx-auto mt-10 px-4 py-10 bg-white rounded-3xl shadow-xl fade-section">
    <div class="flex justify-between items-center mb-8">
      <h2 class="text-2xl font-bold text-[#172642]">Recent Expenses</h2>
      <button class="bg-[#09A6F3] hover:bg-[#15B77B] text-white font-semibold px-5 py-2 rounded-xl shadow ripple transition">Add Expense</button>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full min-w-[600px] bg-[#f7fafd] rounded-xl shadow-md">
        <thead>
          <tr>
            <th class="px-4 py-3 text-left text-[#172642] font-semibold">Date</th>
            <th class="px-4 py-3 text-left text-[#172642] font-semibold">Category</th>
            <th class="px-4 py-3 text-left text-[#172642] font-semibold">Amount</th>
            <th class="px-4 py-3 text-left text-[#172642] font-semibold">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b hover:bg-[#e6e9fd]/50 transition">
            <td class="px-4 py-3 text-gray-600">2025-05-29</td>
            <td class="px-4 py-3 text-[#09A6F3] font-semibold">Groceries</td>
            <td class="px-4 py-3 text-[#F73D59] font-bold">$60</td>
            <td class="px-4 py-3"><span class="bg-[#15B77B] text-white rounded-lg px-3 py-1 text-sm">Paid</span></td>
          </tr>
          <tr class="border-b hover:bg-[#e6e9fd]/50 transition">
            <td class="px-4 py-3 text-gray-600">2025-05-29</td>
            <td class="px-4 py-3 text-[#09A6F3] font-semibold">Transport</td>
            <td class="px-4 py-3 text-[#F73D59] font-bold">$20</td>
            <td class="px-4 py-3"><span class="bg-[#F73D59] text-white rounded-lg px-3 py-1 text-sm">Pending</span></td>
          </tr>
          <tr class="hover:bg-[#e6e9fd]/50 transition">
            <td class="px-4 py-3 text-gray-600">2025-05-29</td>
            <td class="px-4 py-3 text-[#09A6F3] font-semibold">Rent</td>
            <td class="px-4 py-3 text-[#F73D59] font-bold">$500</td>
            <td class="px-4 py-3"><span class="bg-[#09A6F3] text-white rounded-lg px-3 py-1 text-sm">Paid</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Goals Section -->
  <section id="goals" class="max-w-6xl mx-auto mt-12 px-4 py-10 bg-[#f7fafd] rounded-3xl shadow-xl fade-section">
    <div class="flex justify-between items-center mb-8">
      <h2 class="text-2xl font-bold text-[#172642]">Your Financial Goals</h2>
      <button class="bg-[#15B77B] hover:bg-[#09A6F3] text-white font-semibold px-5 py-2 rounded-xl shadow ripple transition">Set Goal</button>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center card-hover">
        <div class="text-[#09A6F3] text-3xl mb-3 font-bold">🏝️</div>
        <div class="font-bold text-[#172642] mb-1">Vacation Fund</div>
        <div class="text-gray-500 text-sm mb-3">Save for a trip in December.</div>
        <div class="w-full bg-gray-200 rounded-full h-2 mb-2"><div class="bg-[#09A6F3] h-2 rounded-full" style="width: 60%"></div></div>
        <span class="text-[#09A6F3] text-sm">60% Complete</span>
      </div>
      <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center card-hover">
        <div class="text-[#F73D59] text-3xl mb-3 font-bold">🚗</div>
        <div class="font-bold text-[#172642] mb-1">Buy a Car</div>
        <div class="text-gray-500 text-sm mb-3">New family car in 2026.</div>
        <div class="w-full bg-gray-200 rounded-full h-2 mb-2"><div class="bg-[#F73D59] h-2 rounded-full" style="width: 30%"></div></div>
        <span class="text-[#F73D59] text-sm">30% Complete</span>
      </div>
      <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center card-hover">
        <div class="text-[#15B77B] text-3xl mb-3 font-bold">🏡</div>
        <div class="font-bold text-[#172642] mb-1">Home Renovation</div>
        <div class="text-gray-500 text-sm mb-3">Kitchen upgrade this year.</div>
        <div class="w-full bg-gray-200 rounded-full h-2 mb-2"><div class="bg-[#15B77B] h-2 rounded-full" style="width: 85%"></div></div>
        <span class="text-[#15B77B] text-sm">85% Complete</span>
      </div>
    </div>
  </section>

  <!-- Budget Planner Callout -->
  <section class="max-w-6xl mx-auto mt-12 px-4 py-10 bg-white rounded-3xl shadow-xl flex flex-col md:flex-row items-center gap-12 fade-section">
    <div class="flex-1">
      <h3 class="text-2xl font-bold text-[#09A6F3] mb-4">Start Planning Your Budget Today</h3>
      <p class="text-gray-600 mb-6">Use our budget planner to create, track, and adjust your monthly budgets for each category. See where your money goes and how you can save more!</p>
      <button class="bg-[#F73D59] hover:bg-[#15B77B] text-white font-semibold px-6 py-2 rounded-xl shadow ripple transition">Try Budget Planner</button>
    </div>
    <div class="flex-1 flex justify-center">
      <img src="https://th.bing.com/th/id/OIP.9dumkZGHsI53w7w1uDCgoQHaFj?rs=1&pid=ImgDetMain" class="w-[240px] h-[200px] object-contain rounded-xl shadow-md border-2 border-[#f7fafd]" alt="Budget planner">
    </div>
  </section>

  <!-- Analytics Section -->
  <section id="analytics" class="max-w-6xl mx-auto mt-12 px-4 py-10 bg-[#f7fafd] rounded-3xl shadow-xl fade-section">
    <h2 class="text-2xl font-bold text-[#172642] mb-8">Expense Analytics</h2>
    <div class="grid md:grid-cols-2 gap-8">
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center card-hover">
        <div class="w-32 h-32 donut rounded-full flex items-center justify-center mb-4 relative">
          <span class="text-[#09A6F3] font-bold text-3xl">67%</span>
        </div>
        <div class="text-gray-700 text-center font-semibold">Budget Used</div>
      </div>
      <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center card-hover">
        <div class="w-32 h-32 donut2 rounded-full flex items-center justify-center mb-4 relative">
          <span class="text-[#15B77B] font-bold text-3xl">33%</span>
        </div>
        <div class="text-gray-700 text-center font-semibold">Remaining</div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="max-w-6xl mx-auto mt-12 px-4 py-12 bg-white rounded-3xl shadow-xl fade-section">
    <h2 class="text-2xl font-bold text-[#172642] text-center mb-10">What Our Users Say</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-[#f7fafd] rounded-2xl shadow p-6 card-hover">
        <div class="mb-3 flex items-center gap-2">
          <div class="w-10 h-10 rounded-full bg-[#09A6F3] flex items-center justify-center text-white font-bold">AR</div>
          <span class="font-semibold text-[#09A6F3]">Ayesha R.</span>
        </div>
        <p class="text-gray-600 mb-2 italic">"This tracker is so easy to use! I never miss a bill and love seeing my goals progress."</p>
        <div class="text-yellow-400">★★★★★</div>
      </div>
      <div class="bg-[#f7fafd] rounded-2xl shadow p-6 card-hover">
        <div class="mb-3 flex items-center gap-2">
          <div class="w-10 h-10 rounded-full bg-[#15B77B] flex items-center justify-center text-white font-bold">JM</div>
          <span class="font-semibold text-[#15B77B]">Junaid M.</span>
        </div>
        <p class="text-gray-600 mb-2 italic">"Helped me save more and spend wisely. Analytics are super clear and beautiful."</p>
        <div class="text-yellow-400">★★★★★</div>
      </div>
      <div class="bg-[#f7fafd] rounded-2xl shadow p-6 card-hover">
        <div class="mb-3 flex items-center gap-2">
          <div class="w-10 h-10 rounded-full bg-[#F73D59] flex items-center justify-center text-white font-bold">ZS</div>
          <span class="font-semibold text-[#F73D59]">Zara S.</span>
        </div>
        <p class="text-gray-600 mb-2 italic">"Love the goals and budget planner. Clean interface and great support!"</p>
        <div class="text-yellow-400">★★★★★</div>
      </div>
    </div>
  </section>

  <!-- FAQ Accordion -->
<!-- FAQ Accordion -->
<section id="faq" class="max-w-6xl mx-auto mt-12 px-4 py-10 bg-white rounded-3xl shadow-xl fade-section">
  <h2 class="text-2xl font-bold text-[#172642] mb-8 text-center">Frequently Asked Questions</h2>
  <div x-data="{ open: 0 }" class="space-y-4">
    <template x-for="(faq, idx) in [
      { q: 'Is my data secure?', a: 'Absolutely. Your data is encrypted and never shared.', color: 'text-[#09A6F3]', icon: 'stroke-[#09A6F3]' },
      { q: 'Can I track multiple goals?', a: 'Yes! Set as many financial goals as you like and monitor each separately.', color: 'text-[#F73D59]', icon: 'stroke-[#F73D59]' },
      { q: 'Is there a mobile app?', a: 'Mobile app is coming soon! For now, our site is fully mobile-responsive.', color: 'text-[#15B77B]', icon: 'stroke-[#15B77B]' },
      { q: 'How do I add a new expense?', a: 'Just click the “Add Expense” button on your dashboard and fill in the details.', color: 'text-[#172642]', icon: 'stroke-[#172642]' },
      { q: 'Can I export my data?', a: 'Yes, you can export your expense reports in CSV or PDF format from your account settings.', color: 'text-[#B667F1]', icon: 'stroke-[#B667F1]' },
      { q: 'What happens if I forget my password?', a: 'Use the “Forgot Password” link on the login page to reset it securely.', color: 'text-[#F79E3D]', icon: 'stroke-[#F79E3D]' },
      { q: 'Does it work on mobile and tablet?', a: 'Yes! The website is fully responsive and looks great on all devices.', color: 'text-[#5BB9F7]', icon: 'stroke-[#5BB9F7]' },
      { q: 'Is there customer support?', a: 'Of course! Reach out any time through the Contact page for prompt assistance.', color: 'text-[#09A6F3]', icon: 'stroke-[#09A6F3]' }
    ]" :key="idx">
      <div 
        class="border rounded-xl overflow-hidden bg-white transition-shadow duration-300"
        :class="open === idx ? 'shadow-2xl shadow-[#09A6F344] scale-[1.025]' : 'shadow'"
      >
        <button 
          @click="open = open === idx ? 0 : idx"
          class="w-full flex justify-between items-center px-6 py-4 font-semibold focus:outline-none group transition-colors"
          :class="faq.color"
        >
          <span x-text="faq.q"></span>
          <span class="flex items-center">
            <svg 
              class="w-7 h-7 ml-3 transition-all duration-300 ease-in-out"
              :class="[
                open === idx ? 'rotate-45 scale-110 drop-shadow-lg' : 'rotate-0 scale-100',
                faq.icon
              ]"
              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <line x1="12" y1="5" x2="12" y2="19" stroke-linecap="round"/>
              <line x1="5" y1="12" x2="19" y2="12" stroke-linecap="round"/>
            </svg>
          </span>
        </button>
        <div 
          x-show="open === idx"
          x-transition:enter="transition-all duration-500 ease-out"
          x-transition:enter-start="opacity-0 max-h-0 translate-y-4"
          x-transition:enter-end="opacity-100 max-h-40 translate-y-0"
          x-transition:leave="transition-all duration-300 ease-in"
          x-transition:leave-start="opacity-100 max-h-40 translate-y-0"
          x-transition:leave-end="opacity-0 max-h-0 -translate-y-4"
          class="px-6 pb-4 text-gray-600 overflow-hidden relative"
          style="will-change: max-height, opacity, transform;"
        >
          <div class="animate-fade-in">
            <span x-text="faq.a"></span>
          </div>
        </div>
      </div>
    </template>
  </div>
</section>

  <!-- Footer -->
  <footer class="mt-24 py-12 bg-white shadow-inner text-center text-gray-500 text-sm rounded-t-3xl">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center px-4 gap-4">
      <div>Expense Tracker &copy; 2025 | Built with <span class="text-[#09A6F3]">TailwindCSS</span></div>
      <div class="flex gap-4">
        <a href="#" class="hover:text-[#09A6F3]">Privacy Policy</a>
        <a href="#" class="hover:text-[#F73D59]">Terms</a>
        <a href="#" class="hover:text-[#15B77B]">Contact</a>
      </div>
    </div>
  </footer>

  <!-- Animations on scroll -->
<script>
// Intersection Observer for fade-in sections
document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.22 });
  document.querySelectorAll('.fade-section').forEach(el => observer.observe(el));

  // Navbar logic:
  const navToggle = document.getElementById('navbar-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  // Set default classes for hidden (closed) state
  mobileMenu.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
  mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');

  function setActive(link) {
    document.querySelectorAll('.nav-anim-link').forEach(el => el.classList.remove('active'));
    if (link) link.classList.add('active');
  }

  function handleNavClick(e) {
    if (e.target.classList.contains('nav-anim-link')) {
      const href = e.target.getAttribute('href');
      if (href && href.startsWith('#')) {
        e.preventDefault();
        const targetSection = document.querySelector(href);
        if (targetSection) {
          targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
      setActive(e.target);
      // Close mobile menu when an item is clicked (on mobile)
      if (window.innerWidth < 768) {
        mobileMenu.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
        mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
      }
    }
  }

  // Animate mobile menu open/close with new class
  navToggle.addEventListener('click', () => {
    if (mobileMenu.classList.contains('opacity-100')) {
      // Hide
      mobileMenu.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
      mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
    } else {
      // Show
      mobileMenu.classList.remove('opacity-0', 'pointer-events-none', 'scale-95');
      mobileMenu.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');
    }
  });

  // Attach to all nav links
  document.querySelectorAll('.nav-anim-link').forEach(link => {
    link.addEventListener('click', handleNavClick);
  });

  // Highlight active nav item on scroll
  function onScrollActiveNav() {
    const sections = ['dashboard', 'expenses', 'analytics', 'goals', 'faq'];
    let found = false;
    for (let id of sections) {
      const sec = document.getElementById(id);
      if (sec && window.scrollY + 72 >= sec.offsetTop) {
        const navs = document.querySelectorAll('.nav-anim-link[data-link="'+id+'"]');
        navs.forEach(setActive);
        found = true;
      }
    }
    if (!found) setActive(null);
  }
  window.addEventListener('scroll', onScrollActiveNav, { passive: true });
  // Highlight Dashboard by default on load
  setActive(document.querySelector('.nav-anim-link[data-link="dashboard"]'));
});

  </script>
</body>
</html>
