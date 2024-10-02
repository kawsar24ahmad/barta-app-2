<header>
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
          <div class="flex">
            <a href="/" class="flex items-center text-gray-900 font-bold text-2xl">
              Barta
            </a>
            <!-- Main Navigation Links -->
            <div class="hidden md:flex ml-10 space-x-8">
              <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
              <a href="{{route('posts.index')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">Posts</a>
              
            </div>
          </div>
          <!-- Right side: Profile Menu and Create Post Button -->
          <div class="hidden md:flex items-center space-x-4">
            <a href="{{route('posts.create') }}" class="text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 px-4 py-2 rounded-lg">Create Post</a>
            <div x-data="{ open: false }" class="relative">
              <button @click="open = !open" class="flex items-center text-sm focus:outline-none">
                <img class="h-8 w-8 rounded-full" src="https://avatars.githubusercontent.com/u/831997" alt="Profile" />
              </button>
              <!-- Dropdown -->
              <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-2">
                <a href="{{route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                <a href="{{route('edit-profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                <form action="{{route('logout')}}" method="POST">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign Out</button>
                </form>
              </div>
            </div>
          </div>
          <!-- Mobile Menu Button -->
          <div class="-mr-2 flex items-center md:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
              <svg class="h-6 w-6" x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
              </svg>
              <svg class="h-6 w-6" x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile Navigation Menu -->
      <div x-show="mobileMenuOpen" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
          <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Dashboard</a>
          <a href="{{route('posts.index')}}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Posts</a>
        
          <a href="{{ route('posts.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Create Post</a>
        </div>
        <div class="border-t border-gray-200 pt-4 pb-3">
          <div class="px-5">
            <a href="{{ route('profile') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Your Profile</a>
            <a href="{{ route('edit-profile') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Edit Profile</a>
            <form action="{{route('logout')}}" method="POST">
           @csrf
              <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Sign Out</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
  </header>