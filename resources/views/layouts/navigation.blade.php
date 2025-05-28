<nav
  x-data="{ open: false }"
  class="bg-white shadow"
>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      {{-- Brand & Links --}}
      <div class="flex items-center space-x-6">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
          <x-application-logo class="h-8 w-auto text-sky-600"/>
          <span class="text-xl font-bold text-black">ExpenseTracker</span>
        </a>
        <div class="hidden md:flex md:space-x-4">
          <x-nav-link
            :href="route('dashboard')"
            :active="request()->routeIs('dashboard')"
            class="px-3 py-2 rounded-md text-black"
            active-class="bg-sky-100 text-sky-700"
          >
            Dashboard
          </x-nav-link>
          <x-nav-link
            :href="route('expenses.index')"
            :active="request()->routeIs('expenses.*')"
            class="px-3 py-2 rounded-md text-black"
            active-class="bg-sky-100 text-sky-700"
          >
            Expenses
          </x-nav-link>
          <x-nav-link
            :href="route('budgets.index')"
            :active="request()->routeIs('budgets.*')"
            class="px-3 py-2 rounded-md text-black"
            active-class="bg-sky-100 text-sky-700"
          >
            Budgets
          </x-nav-link>
          <x-nav-link
            :href="route('categories.index')"
            :active="request()->routeIs('categories.*')"
            class="px-3 py-2 rounded-md text-black"
            active-class="bg-sky-100 text-sky-700"
          >
            Categories
          </x-nav-link>
          <x-nav-link
            :href="route('reports.index')"
            :active="request()->routeIs('reports.*')"
            class="px-3 py-2 rounded-md text-black"
            active-class="bg-sky-100 text-sky-700"
          >
            Reports
          </x-nav-link>
        </div>
      </div>

      {{-- User & Mobile Toggle --}}
      <div class="flex items-center space-x-4">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="flex items-center px-3 py-2 bg-gray-100 rounded-md hover:bg-gray-200 transition">
              <span class="text-black">{{ Auth::user()->name }}</span>
              <svg class="ml-2 h-4 w-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293..." />
              </svg>
            </button>
          </x-slot>
          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')" class="px-4 py-2 hover:bg-gray-100 text-black">
              Profile
            </x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">@csrf
              <x-dropdown-link
                :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="px-4 py-2 hover:bg-gray-100 text-black"
              >
                Log Out
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>

        {{-- Mobile Hamburger --}}
        <button @click="open = !open" class="sm:hidden p-2 rounded-md text-black hover:bg-gray-100 transition">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div x-show="open" class="sm:hidden bg-white border-t border-gray-200">
    <div class="py-2 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')"    :active="request()->routeIs('dashboard')"    class="px-4 py-2 text-black">Dashboard</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')" class="px-4 py-2 text-black">Expenses</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('budgets.index')"  :active="request()->routeIs('budgets.*')"  class="px-4 py-2 text-black">Budgets</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="px-4 py-2 text-black">Categories</x-responsive-nav-link>
      <x-responsive-nav-link :href="route('reports.index')"    :active="request()->routeIs('reports.*')"    class="px-4 py-2 text-black">Reports</x-responsive-nav-link>
    </div>
    <div class="pt-4 pb-1 border-t border-gray-200 px-4">
      <p class="font-medium text-black">{{ Auth::user()->name }}</p>
      <p class="text-sm text-black">{{ Auth::user()->email }}</p>
    </div>
    <div class="space-y-1 px-4 pb-4">
      <x-responsive-nav-link :href="route('profile.edit')" class="block px-4 py-2 hover:bg-gray-100 text-black">Profile</x-responsive-nav-link>
      <form method="POST" action="{{ route('logout') }}">@csrf
        <x-responsive-nav-link
          :href="route('logout')"
          onclick="event.preventDefault(); this.closest('form').submit();"
          class="block px-4 py-2 hover:bg-gray-100 text-black"
        >Log Out</x-responsive-nav-link>
      </form>
    </div>
  </div>
</nav>
