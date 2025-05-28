<!DOCTYPE html>
<html lang="en" class="bg-[#f7fafd]">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Expense Tracker</title>
        <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
      [x-show] { transition: all 0.4s cubic-bezier(.4,0,.2,1); }
      .animate-spin-slow { animation: spin 3s linear infinite; }
      @keyframes spin { 0% { transform: rotate(0deg);} 100% { transform: rotate(360deg);} }
    </style>
  </head>
  <body class="bg-[#f7fafd] min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
      <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="text-2xl font-bold text-[#09A6F3] tracking-wide flex items-center gap-2">
          <svg class="w-7 h-7 text-[#09A6F3]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
          Expense Tracker
        </div>
        <div class="flex gap-6 items-center">
          <a href="#dashboard" class="text-[#172642] font-medium px-2 py-1 border-b-2 border-[#09A6F3]">Dashboard</a>
          <a href="#expenses" class="text-gray-700 hover:text-[#09A6F3] transition">Expenses</a>
          <a href="#analytics" class="text-gray-700 hover:text-[#09A6F3] transition">Analytics</a>
          <a href="#goals" class="text-gray-700 hover:text-[#09A6F3] transition">Goals</a>
          <a href="#faq" class="text-gray-700 hover:text-[#09A6F3] transition">FAQ</a>
<a href="/register">
  <button class="ml-3 bg-[#15B77B] hover:bg-[#09A6F3] text-white px-5 py-2 rounded-2xl shadow transition font-semibold">
    Login
  </button>
</a>
        </div>
      </div>
    </nav>


    <!-- Hero Dashboard -->
    <section id="dashboard" class="max-w-6xl mx-auto mt-8 px-4 py-12 flex flex-col md:flex-row gap-10 items-center justify-between bg-white rounded-3xl shadow-xl animate-fade-in-up">
      <div class="flex-1">
        <h1 class="text-4xl md:text-5xl font-bold text-[#172642] mb-4 tracking-tight">Take Control of Your <span class="text-[#09A6F3]">Finances</span></h1>
        <p class="text-lg text-gray-600 mb-8">Track expenses, set budgets, and achieve your goals effortlessly. Stay on top of your spending with real-time analytics and colorful reports.</p>
        <div class="flex gap-4">
          <button class="bg-[#15B77B] hover:bg-[#09A6F3] text-white font-bold px-8 py-3 rounded-2xl shadow-md text-lg transition">Get Started</button>
          <button class="bg-[#F73D59] hover:bg-[#172642] text-white font-bold px-8 py-3 rounded-2xl shadow-md text-lg transition">Demo</button>
        </div>
      </div>
      <div class="flex-1 flex justify-center">
        <img src="https://cloudfileconverter.site/images/Screenshot%202025-05-29%20034233.png" alt="Expense Tracker Dashboard" class="w-[370px] h-[270px] rounded-2xl shadow-lg border-4 border-[#f7fafd]" />
      </div>
    </section>

    <!-- Stats Summary Cards -->
    <section class="max-w-6xl mx-auto mt-16 px-4 grid md:grid-cols-3 gap-8">
      <div class="bg-[#f7fafd] rounded-2xl shadow-md p-8 flex flex-col items-center animate-fade-in">
        <div class="text-4xl font-bold text-[#09A6F3] mb-2">$4,350</div>
        <div class="text-gray-600 font-medium">Total Spent</div>
      </div>
      <div class="bg-[#f7fafd] rounded-2xl shadow-md p-8 flex flex-col items-center animate-fade-in" style="animation-delay: 0.2s;">
        <div class="text-4xl font-bold text-[#15B77B] mb-2">$900</div>
        <div class="text-gray-600 font-medium">This Month</div>
      </div>
      <div class="bg-[#f7fafd] rounded-2xl shadow-md p-8 flex flex-col items-center animate-fade-in" style="animation-delay: 0.4s;">
        <div class="text-4xl font-bold text-[#F73D59] mb-2">$250</div>
        <div class="text-gray-600 font-medium">Saved</div>
      </div>
    </section>

    <!-- Expenses List -->
    <section id="expenses" class="max-w-6xl mx-auto mt-16 px-4 py-10 bg-white rounded-3xl shadow-xl animate-fade-in-up">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-[#172642]">Recent Expenses</h2>
        <button class="bg-[#09A6F3] hover:bg-[#15B77B] text-white font-semibold px-5 py-2 rounded-xl shadow transition">Add Expense</button>
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
            <tr class="border-b">
              <td class="px-4 py-3 text-gray-600">2025-05-29</td>
              <td class="px-4 py-3 text-[#09A6F3] font-semibold">Groceries</td>
              <td class="px-4 py-3 text-[#F73D59] font-bold">$60</td>
              <td class="px-4 py-3"><span class="bg-[#15B77B] text-white rounded-lg px-3 py-1 text-sm">Paid</span></td>
            </tr>
            <tr class="border-b">
              <td class="px-4 py-3 text-gray-600">2025-05-29</td>
              <td class="px-4 py-3 text-[#09A6F3] font-semibold">Transport</td>
              <td class="px-4 py-3 text-[#F73D59] font-bold">$20</td>
              <td class="px-4 py-3"><span class="bg-[#F73D59] text-white rounded-lg px-3 py-1 text-sm">Pending</span></td>
            </tr>
            <tr>
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
    <section id="goals" class="max-w-6xl mx-auto mt-16 px-4 py-10 bg-[#f7fafd] rounded-3xl shadow-xl animate-fade-in-up">
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-[#172642]">Your Financial Goals</h2>
        <button class="bg-[#15B77B] hover:bg-[#09A6F3] text-white font-semibold px-5 py-2 rounded-xl shadow transition">Set Goal</button>
      </div>
      <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
          <div class="text-[#09A6F3] text-3xl mb-3 font-bold">🏝️</div>
          <div class="font-bold text-[#172642] mb-1">Vacation Fund</div>
          <div class="text-gray-500 text-sm mb-3">Save for a trip in December.</div>
          <div class="w-full bg-gray-200 rounded-full h-2 mb-2"><div class="bg-[#09A6F3] h-2 rounded-full" style="width: 60%"></div></div>
          <span class="text-[#09A6F3] text-sm">60% Complete</span>
        </div>
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
          <div class="text-[#F73D59] text-3xl mb-3 font-bold">🚗</div>
          <div class="font-bold text-[#172642] mb-1">Buy a Car</div>
          <div class="text-gray-500 text-sm mb-3">New family car in 2026.</div>
          <div class="w-full bg-gray-200 rounded-full h-2 mb-2"><div class="bg-[#F73D59] h-2 rounded-full" style="width: 30%"></div></div>
          <span class="text-[#F73D59] text-sm">30% Complete</span>
        </div>
        <div class="bg-white rounded-2xl shadow p-6 flex flex-col items-center">
          <div class="text-[#15B77B] text-3xl mb-3 font-bold">🏡</div>
          <div class="font-bold text-[#172642] mb-1">Home Renovation</div>
          <div class="text-gray-500 text-sm mb-3">Kitchen upgrade this year.</div>
          <div class="w-full bg-gray-200 rounded-full h-2 mb-2"><div class="bg-[#15B77B] h-2 rounded-full" style="width: 85%"></div></div>
          <span class="text-[#15B77B] text-sm">85% Complete</span>
        </div>
      </div>
    </section>

    <!-- Budget Planner Callout -->
    <section class="max-w-6xl mx-auto mt-16 px-4 py-10 bg-white rounded-3xl shadow-xl flex flex-col md:flex-row items-center gap-12 animate-fade-in-up">
      <div class="flex-1">
        <h3 class="text-2xl font-bold text-[#09A6F3] mb-4">Start Planning Your Budget Today</h3>
        <p class="text-gray-600 mb-6">Use our budget planner to create, track, and adjust your monthly budgets for each category. See where your money goes and how you can save more!</p>
        <button class="bg-[#F73D59] hover:bg-[#15B77B] text-white font-semibold px-6 py-2 rounded-xl shadow transition">Try Budget Planner</button>
      </div>
      <div class="flex-1 flex justify-center">
        <img src="https://th.bing.com/th/id/OIP.9dumkZGHsI53w7w1uDCgoQHaFj?rs=1&pid=ImgDetMain" class="w-[240px] h-[200px] object-contain rounded-xl shadow-md border-2 border-[#f7fafd]" alt="Budget planner">
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="max-w-6xl mx-auto mt-16 px-4 py-12 bg-[#f7fafd] rounded-3xl shadow-xl animate-fade-in-up">
      <h2 class="text-2xl font-bold text-[#172642] text-center mb-10">What Our Users Say</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow p-6">
          <div class="mb-3 flex items-center gap-2">
            <div class="w-10 h-10 rounded-full bg-[#09A6F3] flex items-center justify-center text-white font-bold">AR</div>
            <span class="font-semibold text-[#09A6F3]">Ayesha R.</span>
          </div>
          <p class="text-gray-600 mb-2 italic">"This tracker is so easy to use! I never miss a bill and love seeing my goals progress."</p>
          <div class="text-yellow-400">★★★★★</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
          <div class="mb-3 flex items-center gap-2">
            <div class="w-10 h-10 rounded-full bg-[#15B77B] flex items-center justify-center text-white font-bold">JM</div>
            <span class="font-semibold text-[#15B77B]">Junaid M.</span>
          </div>
          <p class="text-gray-600 mb-2 italic">"Helped me save more and spend wisely. Analytics are super clear and beautiful."</p>
          <div class="text-yellow-400">★★★★★</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
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
    <section id="faq" class="max-w-6xl mx-auto mt-16 px-4 py-10 bg-white rounded-3xl shadow-xl animate-fade-in-up">
      <h2 class="text-2xl font-bold text-[#172642] mb-8 text-center">Frequently Asked Questions</h2>
      <div x-data="{ open: 0 }" class="space-y-4">
        <div class="border rounded-xl overflow-hidden">
          <button @click="open = open === 1 ? 0 : 1" class="w-full flex justify-between items-center px-6 py-4 text-[#09A6F3] font-semibold focus:outline-none">
            Is my data secure?
            <span x-show="open !== 1">+</span>
            <span x-show="open === 1">-</span>
          </button>
          <div x-show="open === 1" class="px-6 pb-4 text-gray-600">Absolutely. Your data is encrypted and never shared.</div>
        </div>
        <div class="border rounded-xl overflow-hidden">
          <button @click="open = open === 2 ? 0 : 2" class="w-full flex justify-between items-center px-6 py-4 text-[#F73D59] font-semibold focus:outline-none">
            Can I track multiple goals?
            <span x-show="open !== 2">+</span>
            <span x-show="open === 2">-</span>
          </button>
          <div x-show="open === 2" class="px-6 pb-4 text-gray-600">Yes! Set as many financial goals as you like and monitor each separately.</div>
        </div>
        <div class="border rounded-xl overflow-hidden">
          <button @click="open = open === 3 ? 0 : 3" class="w-full flex justify-between items-center px-6 py-4 text-[#15B77B] font-semibold focus:outline-none">
            Is there a mobile app?
            <span x-show="open !== 3">+</span>
            <span x-show="open === 3">-</span>
          </button>
          <div x-show="open === 3" class="px-6 pb-4 text-gray-600">Mobile app is coming soon! For now, our site is fully mobile-responsive.</div>
        </div>
      </div>
    </section>

    <!-- Analytics Section (Example) -->
    <section id="analytics" class="max-w-6xl mx-auto mt-16 px-4 py-10 bg-[#f7fafd] rounded-3xl shadow-xl animate-fade-in-up">
      <h2 class="text-2xl font-bold text-[#172642] mb-8">Expense Analytics</h2>
      <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center">
          <div class="w-32 h-32 rounded-full flex items-center justify-center border-8 border-[#09A6F3] text-[#09A6F3] font-bold text-3xl mb-4 animate-spin-slow">67%</div>
          <div class="text-gray-700 text-center font-semibold">Budget Used</div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center">
          <div class="w-32 h-32 rounded-full flex items-center justify-center border-8 border-[#15B77B] text-[#15B77B] font-bold text-3xl mb-4 animate-pulse">33%</div>
          <div class="text-gray-700 text-center font-semibold">Remaining</div>
        </div>
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

    <!-- Animations -->
    <script>
      document.querySelectorAll('.animate-fade-in-up').forEach((el, i) => {
        el.style.opacity = 0;
        el.style.transform = 'translateY(32px)';
        setTimeout(() => {
          el.style.transition = 'opacity 0.6s cubic-bezier(.4,0,.2,1), transform 0.6s cubic-bezier(.4,0,.2,1)';
          el.style.opacity = 1;
          el.style.transform = 'translateY(0)';
        }, 150 + 250 * i);
      });
      document.querySelectorAll('.animate-fade-in').forEach((el, i) => {
        el.style.opacity = 0;
        setTimeout(() => {
          el.style.transition = 'opacity 0.7s cubic-bezier(.4,0,.2,1)';
          el.style.opacity = 1;
        }, 600 + 250 * i);
      });
    </script>
  </body>
</html>
