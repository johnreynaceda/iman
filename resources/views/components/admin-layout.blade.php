<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('images/IMAnLogo.png') }}" />

  <title>IMAN - Admin</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

  <!-- Production -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>

  <!-- Scripts -->
  @wireUiScripts
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100">

  {{-- <div class="flex flex-no-wrap h-screen">
    <div style="min-height: 727px"
      class="w-64 absolute sm:relative bg-gradient-to-br from-green-600 to-green-700 shadow md:h-full flex-col justify-between hidden sm:flex">
      <div>
        <div class="h-16 w-full flex space-x-2 items-center px-8">
          <img src="{{ asset('images/IMAnLogo.png') }}" class="h-12" alt="">
          <span class="font-bold text-white text-3xl">IMAN</span>
        </div>
        <div class="flex-1 items-center mt-8  ">
          <div class="flex flex-shrink-0   p-4 ">
            <a href="#" class="group block w-full flex-shrink-0">
              <div class="flex items-center">
                <div>
                  <img class="inline-block h-9 w-9 rounded-full"
                    src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg" alt="">
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-white uppercase">{{ auth()->user()->name }}</p>
                  <p class="text-xs font-medium text-gray-100 ">{{ auth()->user()->email }}</p>
                </div>
              </div>
            </a>
          </div>
          <div class="flex space-x-2 justify-start px-4 items-center relative">
            <livewire:notif-logout />
          </div>
        </div>
        <div class="mt-5  flex flex-grow flex-col">
          <nav class="flex-1 space-y-1  pb-4">
            <a href="{{ route('admin.dashboard') }}"
              class="{{ request()->routeIs('admin.dashboard') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0H24V24H0z" />
                <path
                  d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 1c1.018 0 1.985.217 2.858.608L13.295 7.17C12.882 7.06 12.448 7 12 7c-2.761 0-5 2.239-5 5 0 1.38.56 2.63 1.464 3.536L7.05 16.95l-.156-.161C5.72 15.537 5 13.852 5 12c0-3.866 3.134-7 7-7zm6.392 4.143c.39.872.608 1.84.608 2.857 0 1.933-.784 3.683-2.05 4.95l-1.414-1.414C16.44 14.63 17 13.38 17 12c0-.448-.059-.882-.17-1.295l1.562-1.562zm-2.15-2.8l1.415 1.414-3.724 3.726c.044.165.067.338.067.517 0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2c.179 0 .352.023.517.067l3.726-3.724z" />
              </svg>
              <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.asset') }}"
              class="{{ request()->routeIs('admin.asset') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M11 19V9H4v10h7zm0-12V4a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h8zm2-2v14h7V5h-7zM5 16h5v2H5v-2zm9 0h5v2h-5v-2zm0-3h5v2h-5v-2zm0-3h5v2h-5v-2zm-9 3h5v2H5v-2z" />
              </svg>
              <span class="font-medium">Assets</span>
            </a>
            <a href="{{ route('admin.ledger') }}"
              class="{{ request()->routeIs('admin.ledger') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M21 4H7a2 2 0 1 0 0 4h14v13a1 1 0 0 1-1 1H7a4 4 0 0 1-4-4V6a4 4 0 0 1 4-4h13a1 1 0 0 1 1 1v1zM5 18a2 2 0 0 0 2 2h12V10H7a3.982 3.982 0 0 1-2-.535V18zM20 7H7a1 1 0 1 1 0-2h13v2z" />
              </svg>
              <span class="font-medium">Ledger</span>
            </a>
            <a href="{{ route('admin.requests') }}"
              class="{{ request()->routeIs('admin.requests') || request()->routeIs('admin.open-request') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M20.005 2C21.107 2 22 2.898 22 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H4v-4H2v-2h2v-3H2v-2h2V8H2V6h2V2h16.005zM8 4H6v16h2V4zm12 0H10v16h10V4z" />
              </svg>
              <span class="font-medium">Requested Assets</span>
            </a>
            <a href="{{ route('admin.borrowed') }}"
              class="{{ request()->routeIs('admin.borrowed') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M20.005 2C21.107 2 22 2.898 22 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H4v-4H2v-2h2v-3H2v-2h2V8H2V6h2V2h16.005zM8 4H6v16h2V4zm12 0H10v16h10V4z" />
              </svg>
              <span class="font-medium">Borrowed Assets</span>
            </a>
          </nav>


        </div>
        <div class="mt-5 border-t pt-5 flex flex-grow flex-col">
          <nav class="flex-1 space-y-1  pb-4">
            <a href="{{ route('admin.borrower') }}"
              class="{{ request()->routeIs('admin.borrower') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0h24v24H0z" />
                <path d="M20 22H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2zm-8-9a6 6 0 1 1 0-12 6 6 0 0 1 0 12z" />
              </svg>
              <span class="font-medium">Borrowers</span>
            </a>
            <a href="{{ route('admin.asset') }}"
              class="{{ request()->routeIs('admin.asset') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M11 7h2v10h-2V7zm4 4h2v6h-2v-6zm-8 2h2v4H7v-4zm8-9H5v16h14V8h-4V4zM3 2.992C3 2.444 3.447 2 3.999 2H16l5 5v13.993A1 1 0 0 1 20.007 22H3.993A1 1 0 0 1 3 21.008V2.992z" />
              </svg>
              <span class="font-medium">Reports</span>
            </a>

          </nav>


        </div>

      </div>
      <div class="px-8 bg-green-800">
      </div>
    </div>
    <!--Mobile responsive sidebar-->
    <!-- Sidebar ends -->
    <!-- Remove class [ h-64 ] when adding a card block -->
    <div class="container mx-auto py-10 h-64 md:w-4/5 w-11/12 px-6">
      <!-- Remove class [ border-dashed border-2 border-gray-300 ] to remove dotted border -->
      <div class="w-full ">
        <div>
          <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
              <h2
                class="text-2xl font-bold leading-7 text-gray-700 uppercase sm:truncate sm:text-3xl sm:tracking-tight">
                @yield('title')</h2>
            </div>
            <div class="mt-4 flex flex-shrink-0 md:mt-0 md:ml-4">

            </div>
          </div>
        </div>
        <div class="py-10">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div> --}}

  <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
  <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
  <div class="min-h-full">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
      <!--
      Off-canvas menu backdrop, show/hide based on off-canvas menu state.

      Entering: "transition-opacity ease-linear duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "transition-opacity ease-linear duration-300"
        From: "opacity-100"
        To: "opacity-0"
    -->
      <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

      <div class="fixed inset-0 z-40 flex">
        <!--
        Off-canvas menu, show/hide based on off-canvas menu state.

        Entering: "transition ease-in-out duration-300 transform"
          From: "-translate-x-full"
          To: "translate-x-0"
        Leaving: "transition ease-in-out duration-300 transform"
          From: "translate-x-0"
          To: "-translate-x-full"
      -->
        <div class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4">
          <!--
          Close button, show/hide based on off-canvas menu state.

          Entering: "ease-in-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in-out duration-300"
            From: "opacity-100"
            To: "opacity-0"
        -->
          <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button type="button"
              class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
              <span class="sr-only">Close sidebar</span>
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <div class="flex flex-shrink-0 items-center px-4">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=purple&shade=500"
              alt="Your Company">
          </div>
          <div class="mt-5 h-0 flex-1 overflow-y-auto">
            <nav class="px-2">
              <div class="space-y-1">
                <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:text-gray-900 hover:bg-gray-50" -->
                <a href="#"
                  class="bg-gray-100 text-gray-900 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md"
                  aria-current="page">
                  <!-- Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500" -->
                  <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  Home
                </a>

                <a href="#"
                  class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md">
                  <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                  </svg>
                  My tasks
                </a>

                <a href="#"
                  class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md">
                  <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Recent
                </a>
              </div>
              <div class="mt-8">
                <h3 class="px-3 text-sm font-medium text-gray-500" id="mobile-teams-headline">Teams</h3>
                <div class="mt-1 space-y-1" role="group" aria-labelledby="mobile-teams-headline">
                  <a href="#"
                    class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full" aria-hidden="true"></span>
                    <span class="truncate">Engineering</span>
                  </a>

                  <a href="#"
                    class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span class="w-2.5 h-2.5 mr-4 bg-green-500 rounded-full" aria-hidden="true"></span>
                    <span class="truncate">Human Resources</span>
                  </a>

                  <a href="#"
                    class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span class="w-2.5 h-2.5 mr-4 bg-yellow-500 rounded-full" aria-hidden="true"></span>
                    <span class="truncate">Customer Success</span>
                  </a>
                </div>
              </div>
            </nav>
          </div>
        </div>

        <div class="w-14 flex-shrink-0" aria-hidden="true">
          <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div
      class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col lg:border-r bg-gradient-to-br from-green-600 to-green-700 lg:pt-5 lg:pb-4">
      <div class="flex flex-shrink-0 items-center px-6">
        <div class="  w-full flex justify-start space-x-2 items-center">
          <img src="{{ asset('images/IMAnLogo.png') }}" class="h-12" alt="">
          <span class="font-bold text-white text-3xl">IMAN</span>
        </div>
      </div>
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="mt-5 flex h-0 flex-1 flex-col overflow-y-auto pt-1">
        <!-- User account dropdown -->
        <div class="relative inline-block px-3 text-left">
          <div>
            <div type="button"
              class="group w-full rounded-md px-3.5 py-2 text-left text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-100"
              id="options-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="flex w-full items-center justify-between">
                <span class="flex min-w-0 items-center justify-between space-x-3">
                  <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                    src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg" alt="">
                  <span class="flex min-w-0 flex-1 flex-col">
                    <p class="text-sm font-medium text-white uppercase">{{ auth()->user()->name }}</p>
                    <p class="text-xs font-medium text-gray-100 ">{{ auth()->user()->email }}</p>
                  </span>
                </span>
              </span>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 ">
          <div class="flex flex-grow flex-col">
            <nav class="flex-1 space-y-1  pb-4">
              <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0H24V24H0z" />
                  <path
                    d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 1c1.018 0 1.985.217 2.858.608L13.295 7.17C12.882 7.06 12.448 7 12 7c-2.761 0-5 2.239-5 5 0 1.38.56 2.63 1.464 3.536L7.05 16.95l-.156-.161C5.72 15.537 5 13.852 5 12c0-3.866 3.134-7 7-7zm6.392 4.143c.39.872.608 1.84.608 2.857 0 1.933-.784 3.683-2.05 4.95l-1.414-1.414C16.44 14.63 17 13.38 17 12c0-.448-.059-.882-.17-1.295l1.562-1.562zm-2.15-2.8l1.415 1.414-3.724 3.726c.044.165.067.338.067.517 0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2c.179 0 .352.023.517.067l3.726-3.724z" />
                </svg>
                <span class="font-medium">Dashboard</span>
              </a>
              <a href="{{ route('admin.asset') }}"
                class="{{ request()->routeIs('admin.asset') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M11 19V9H4v10h7zm0-12V4a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h8zm2-2v14h7V5h-7zM5 16h5v2H5v-2zm9 0h5v2h-5v-2zm0-3h5v2h-5v-2zm0-3h5v2h-5v-2zm-9 3h5v2H5v-2z" />
                </svg>
                <span class="font-medium">Assets</span>
              </a>
              <a href="{{ route('admin.ledger') }}"
                class="{{ request()->routeIs('admin.ledger') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M21 4H7a2 2 0 1 0 0 4h14v13a1 1 0 0 1-1 1H7a4 4 0 0 1-4-4V6a4 4 0 0 1 4-4h13a1 1 0 0 1 1 1v1zM5 18a2 2 0 0 0 2 2h12V10H7a3.982 3.982 0 0 1-2-.535V18zM20 7H7a1 1 0 1 1 0-2h13v2z" />
                </svg>
                <span class="font-medium">Ledger</span>
              </a>
              <a href="{{ route('admin.requests') }}"
                class="{{ request()->routeIs('admin.requests') || request()->routeIs('admin.open-request') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M20.005 2C21.107 2 22 2.898 22 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H4v-4H2v-2h2v-3H2v-2h2V8H2V6h2V2h16.005zM8 4H6v16h2V4zm12 0H10v16h10V4z" />
                </svg>
                <span class="font-medium">Requested Assets</span>
              </a>
              <a href="{{ route('admin.borrowed') }}"
                class="{{ request()->routeIs('admin.borrowed') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M20.005 2C21.107 2 22 2.898 22 3.99v16.02c0 1.099-.893 1.99-1.995 1.99H4v-4H2v-2h2v-3H2v-2h2V8H2V6h2V2h16.005zM8 4H6v16h2V4zm12 0H10v16h10V4z" />
                </svg>
                <span class="font-medium">Borrowed Assets</span>
              </a>
            </nav>


          </div>
          <div class="mt-5 border-t pt-5 flex flex-grow flex-col">
            <nav class="flex-1 space-y-1  pb-4">
              <a href="{{ route('admin.borrower') }}"
                class="{{ request()->routeIs('admin.borrower') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path d="M20 22H4v-2a5 5 0 0 1 5-5h6a5 5 0 0 1 5 5v2zm-8-9a6 6 0 1 1 0-12 6 6 0 0 1 0 12z" />
                </svg>
                <span class="font-medium">Borrowers</span>
              </a>
              <a href="{{ route('admin.reports') }}"
                class=" {{ request()->routeIs('admin.reports') ? 'bg-white text-gray-700 fill-gray-700' : 'text-white fill-white' }}  hover:bg-white hover:text-gray-700  hover:fill-gray-700  group flex items-center px-6 py-2 text-sm font-medium ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="text-gray-400 group-hover:text-gray-500 mr-2 flex-shrink-0 h-6 w-6">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M11 7h2v10h-2V7zm4 4h2v6h-2v-6zm-8 2h2v4H7v-4zm8-9H5v16h14V8h-4V4zM3 2.992C3 2.444 3.447 2 3.999 2H16l5 5v13.993A1 1 0 0 1 20.007 22H3.993A1 1 0 0 1 3 21.008V2.992z" />
                </svg>
                <span class="font-medium">Reports</span>
              </a>

            </nav>


          </div>
          {{-- <div class="space-y-1">
            <!-- Current: "bg-gray-200 text-gray-900", Default: "text-gray-700 hover:text-gray-900 hover:bg-gray-50" -->
            <a href="#"
              class="bg-gray-200 text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md"
              aria-current="page">
              <!-- Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500" -->
              <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
              </svg>
              Home
            </a>

            <a href="#"
              class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
              </svg>
              My tasks
            </a>

            <a href="#"
              class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Recent
            </a>
          </div>
          <div class="mt-8">
            <!-- Secondary navigation -->
            <h3 class="px-3 text-sm font-medium text-gray-500" id="desktop-teams-headline">Teams</h3>
            <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-teams-headline">
              <a href="#"
                class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Engineering</span>
              </a>

              <a href="#"
                class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <span class="w-2.5 h-2.5 mr-4 bg-green-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Human Resources</span>
              </a>

              <a href="#"
                class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <span class="w-2.5 h-2.5 mr-4 bg-yellow-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Customer Success</span>
              </a>
            </div>
          </div> --}}
        </nav>
      </div>
    </div>
    <!-- Main column -->
    <div class="flex flex-col lg:pl-64">
      <main class="flex-1">
        <div class="py-10">
          <div class="xl:px-14 flex justify-between items-center">
            <h1 class="text-3xl font-bold uppercase text-gray-700">@yield('title')</h1>
            <div class="flex mt-2 ml-3 space-x-2 justify-start px-4 items-center ">
              <livewire:notif-logout />
            </div>
          </div>
          <div class="xl:px-14">
            <!-- Replace with your content -->
            <div class="py-5">
              {{ $slot }}
            </div>
            <!-- /End replace -->
          </div>
        </div>
      </main>
    </div>
  </div>

  <x-dialog z-index="z-50" align="center" />
  <x-notifications z-index="z-50" />

  @livewireScripts
</body>

</html>
