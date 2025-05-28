<nav
  x-data="{
    open: false,
    darkMode: localStorage.getItem('dark') === 'true'
  }"
  x-init="
    document.documentElement.classList.toggle('dark', darkMode);
    $watch('darkMode', val => {
      document.documentElement.classList.toggle('dark', val);
      localStorage.setItem('dark', val);
    });
  "
  class="bg-white dark:bg-gray-800 shadow"
>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      {{-- Brand & Links --}}
      <div class="flex items-center space-x-6">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
          <x-application-logo class="h-8 w-auto text-sky-600 dark:text-sky-400"/>
          <span class="text-xl font-bold text-gray-900 dark:text-white">ExpenseTracker</span>
        </a>
        <div class="hidden md:flex md:space-x-4">
          <x-nav-link
            :href="route('dashboard')"
            :active="request()->routeIs('dashboard')"
            class="px-3 py-2 rounded-md"
            active-class="bg-sky-100 text-sky-700 dark:bg-sky-900 dark:text-sky-300"
          >
            Dashboard
          </x-nav-link>
          <x-nav-link
            :href="route('expenses.index')"
            :active="request()->routeIs('expenses.*')"
            class="px-3 py-2 rounded-md"
            active-class="bg-sky-100 text-sky-700 dark:bg-sky-900 dark:text-sky-300"
          >
            Expenses
          </x-nav-link>
          <x-nav-link
            :href="route('budgets.index')"
            :active="request()->routeIs('budgets.*')"
            class="px-3 py-2 rounded-md"
            active-class="bg-sky-100 text-sky-700 dark:bg-sky-900 dark:text-sky-300"
          >
            Budgets
          </x-nav-link>
          <x-nav-link
            :href="route('categories.index')"
            :active="request()->routeIs('categories.*')"
            class="px-3 py-2 rounded-md"
            active-class="bg-sky-100 text-sky-700 dark:bg-sky-900 dark:text-sky-300"
          >
            Categories
          </x-nav-link>
          <x-nav-link
            :href="route('reports.index')"
            :active="request()->routeIs('reports.*')"
            class="px-3 py-2 rounded-md"
            active-class="bg-sky-100 text-sky-700 dark:bg-sky-900 dark:text-sky-300"
          >
            Reports
          </x-nav-link>
        </div>
      </div>

      {{-- Toggles & User --}}
      <div class="flex items-center space-x-4">
        {{-- Dark/Light Mode --}}
        <button
          @click="darkMode = !darkMode"
          class="p-2 rounded-md bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition"
          title="Toggle Dark Mode"
        >
          <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8 8 0 0010.586 10.586z" />
          </svg>
          <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M10 5a1 1 0 011-1V3a1 1 0 10-2 0v1a1 1 0 011 1zm0 8a3 3 0 100-6 3 3 0 000 6zm5-3a1 1 0 011 1h1a1 1 0 110 2h-1a1 1 0 01-1-1zM4 10a1 1 0 011-1H6a1 1 0 110 2H5a1 1 0 01-1-1zm9.657 5.657a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm-7.314 0a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zm7.314-10.314l.707-.707a1 1 0 10-1.414-1.414l-.707.707a1 1 0 101.414 1.414zm-7.314 0a1 1 0 10-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707z"
            />
          </svg>
        </button>

        {{-- User Dropdown --}}
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="flex items-center px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition">
              <span class="text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
              <svg class="ml-2 h-4 w-4 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293..." />
              </svg>
            </button>
          </x-slot>
          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')" class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
              Profile
            </x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">@csrf
              <x-dropdown-link
                :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
              >
                Log Out
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>

        {{-- Mobile Hamburger --}}
        <button @click="open = !open" class="sm:hidden p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div x-show="open" class="sm:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="py-2 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-4 py-2">Dashboard</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')" class="px-4 py-2">Expenses</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('budgets.index')" :active="request()->routeIs('budgets.*')" class="px-4 py-2">Budgets</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="px-4 py-2">Categories</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')" class="px-4 py-2">Reports</x-responsive-nav-link>
    </div>
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700 px-4">
      <p class="font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
      <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
    </div>
    <div class="space-y-1 px-4 pb-4">
      <x-responsive-nav-link :href="route('profile.edit')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</x-responsive-nav-link>
      <form method="POST" action="{{ route('logout') }}">@csrf
        <x-responsive-nav-link
          :href="route('logout')"
          onclick="event.preventDefault(); this.closest('form').submit();"
          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
        >Log Out</x-responsive-nav-link>
      </form>
    </div>
  </div>
</nav>
