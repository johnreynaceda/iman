<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>IMAN - Employee</title>

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

<body class="font-sans antialiased bg-gray-100" x-data="{ sidebar: false, logout: false }">


  <div>
    <!-- Mobile -->
    <div id="mobile-nav" x-show="sidebar" x-on:click="sidebar = false" x-cloak
      class="w-full xl:hidden h-full absolute z-40">
      <div class="bg-gray-800 opacity-50 inset-0 fixed w-full h-full" onclick="sidebarHandler(false)"></div>
      <div
        class="w-64 z-20 absolute left-0 z-40 top-0 bg-white shadow flex-col justify-between transition duration-150 ease-in-out h-full">
        <div class="flex flex-col justify-between h-full">
          <div class="px-6 pt-4 overflow-y-auto">
            <div class="flex items-center  justify-between">
              <div aria-label="Home" role="img" class="mr-10 flex space-x-2 items-center">
                <img src="{{ asset('images/IMAnLogo.png') }}" class="h-10" alt="logo">
                <h1 class="text-2xl font-bold text-gray-700">IMAN</h1>
              </div>
              <button id="cross"
                class="hidden text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 rounded"
                onclick="sidebarHandler(false)">
                <img
                  src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_dark_page_title_and_white_box-svg1.svg"
                  alt="cross">
              </button>
            </div>
            <ul class="f-m-m">
              <li class="text-white pt-8">
                <div class="flex items-center">
                  <div class="md:w-6 md:h-6 w-5 h-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                      class="fill-gray-700">
                      <path fill="none" d="M0 0H24V24H0z" />
                      <path
                        d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 1c1.018 0 1.985.217 2.858.608L13.295 7.17C12.882 7.06 12.448 7 12 7c-2.761 0-5 2.239-5 5 0 1.38.56 2.63 1.464 3.536L7.05 16.95l-.156-.161C5.72 15.537 5 13.852 5 12c0-3.866 3.134-7 7-7zm6.392 4.143c.39.872.608 1.84.608 2.857 0 1.933-.784 3.683-2.05 4.95l-1.414-1.414C16.44 14.63 17 13.38 17 12c0-.448-.059-.882-.17-1.295l1.562-1.562zm-2.15-2.8l1.415 1.414-3.724 3.726c.044.165.067.338.067.517 0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2c.179 0 .352.023.517.067l3.726-3.724z" />
                    </svg>
                  </div>
                  <a href="{{ route('employee.dashboard') }}"
                    class="text-gray-700 ml-3 font-medium text-lg">Dashboard</a>
                </div>
              </li>
              <li class="text-white pt-8">
                <div class="flex items-center">
                  <div class="md:w-6 md:h-6 w-5 h-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                      class="fill-gray-700">
                      <path fill="none" d="M0 0h24v24H0z" />
                      <path
                        d="M4 8h16V5H4v3zm10 11v-9h-4v9h4zm2 0h4v-9h-4v9zm-8 0v-9H4v9h4zM3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
                    </svg>
                  </div>
                  <a href="{{ route('employee.requested') }}" class="text-gray-700 ml-3 font-medium text-lg">Requested
                    Asset</a>
                </div>
              </li>
              <li class="text-white pt-8">
                <div class="flex items-center">
                  <div class="md:w-6 md:h-6 w-5 h-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                      class="fill-gray-700">
                      <path fill="none" d="M0 0h24v24H0z" />
                      <path
                        d="M4 8h16V5H4v3zm10 11v-9h-4v9h4zm2 0h4v-9h-4v9zm-8 0v-9H4v9h4zM3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" />
                    </svg>
                  </div>
                  <a href="{{ route('employee.history') }}" class="text-gray-700 ml-3 font-medium text-lg">Transaction
                    History</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <nav class="w-full mx-auto bg-white shadow  z-10">
      <div class="justify-between container px-6 h-16 flex items-center lg:items-stretch mx-auto">
        <div class="flex items-center">
          <div aria-label="Home" role="img" class="mr-10 flex items-center">
            <img src="{{ asset('images/IMAnLogo.png') }}" class="h-10" alt="logo">
            <h3 class="text-base text-gray-700 font-bold tracking-normal leading-tight ml-3 hidden lg:block">IMAN
            </h3>
          </div>
          <ul class="pr-32 xl:flex hidden items-center space-x-4 h-full">
            <li class=" cursor-pointer font-medium h-full flex items-center text-md text-gray-700 tracking-normal">
              <a href="{{ route('employee.dashboard') }}"> Dashboard</a>
            </li>
            <li class=" cursor-pointer font-medium h-full flex items-center text-md text-gray-700 tracking-normal">
              <a href="{{ route('employee.requested') }}"> Requested Assets</a>
            </li>
            <li class=" cursor-pointer font-medium h-full flex items-center text-md text-gray-700 tracking-normal">
              <a href="{{ route('employee.history') }}">Transaction History</a>
            </li>
          </ul>
        </div>
        <div class=" flex justify-center items-center space-x-3 relative">
          <livewire:employee-notif />
          <x-dropdown>
            <x-slot name="trigger">
              <x-avatar md src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg" />
            </x-slot>

            <x-dropdown.item separator label="Profile" href="{{ route('employee.profile') }}" icon="user-circle" />
            <x-dropdown.item separator label="Logout" icon="logout" x-on:click="logout=true" />
          </x-dropdown>
          <div class="visible xl:hidden flex items-center">
            <button id="menu"
              class="text-green-700 rounded focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-green-800"
              x-on:click="sidebar = true">
              <img
                src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_dark_page_title_and_white_box-svg7.svg"
                alt="toggler">
            </button>
          </div>
        </div>
        {{-- 
        <div class="visible xl:hidden flex items-center">
          <div>
            <button id="menu"
              class="text-gray-800 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
              onclick="sidebarHandler(true) ">
              <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_dark_page_title_and_white_box-svg7.svg"
                alt="toggler">
            </button>
          </div>
        </div> --}}
      </div>
    </nav>
    <!-- Navigation ends -->
    <!-- Page title starts -->
    <div class="bg-gradient-to-r from-green-700 to-green-800 pt-8 pb-16 relative z-10 overflow-hidden">
      <div class="absolute -top-5 -left-5 ">
        <img src="{{ asset('images/IMAnLogo.png') }}" class="opacity-20 h-96">
      </div>
      <div
        class="container relative px-6 mx-auto flex flex-col lg:flex-row items-start lg:items-center justify-between">
        <div class="flex-col flex lg:flex-row items-start lg:items-center">
          <div class="flex items-center">
            <img role="img" class="border-2 shadow border-gray-600 rounded-full mr-3"
              src="https://cdn.tuk.dev/assets/webapp/master_layouts/boxed_layout/boxed_layout2.jpg"
              alt="Display Avatar of Andres Berlin" />
            <div>
              <p class="text-sm text-white leading-4 mb-1 uppercase">{{ auth()->user()->name }}</p>
              <p class="text-xs text-gray-200 leading-4">
                {{ auth()->user()->is_admin ? 'Administrator' : 'Employee' }}
              </p>
            </div>
          </div>
          <div class="ml-0 lg:ml-20 my-6 lg:my-0">
            <h4 class="text-2xl font-bold leading-tight text-white mb-2">INTEGRATED MINDANAONS ASSOCIATION FOR NATIVES
            </h4>
            <p class="flex items-center text-gray-300 ">
              <span class="cursor-pointer">
                @yield('title')
              </span>
            </p>
          </div>
        </div>
        <div class="flex space-x-2 relative">

          {{-- <form method="POST" action="{{ route('logout') }}" role="none">
            @csrf
            <x-button icon="logout" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                          this.closest('form').submit();"
              label="Logout" negative />

          </form> --}}
        </div>
      </div>
    </div>
    <!-- Page title ends -->
    <div class="xl:px-40 mx-auto">
      <!-- Remove class [ h-64 ] when adding a card block -->
      <div class="rounded-xl shadow relative bg-white z-10 -mt-10  w-full xl:p-4 ">
        {{ $slot }}
      </div>
    </div>
  </div>

  <div x-show="logout" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div x-show="logout" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
      class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

        <div x-show="logout" x-cloak x-transition:enter="ease-out duration-300"
          x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
          x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
          x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div
                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: outline/exclamation-triangle -->
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Logout Account</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">Are you sure you want to logout your account? </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse  sm:px-6">
            <form method="POST" action="{{ route('logout') }}" class="flex justify-between space-x-2">
              @csrf
              <x-button @click="logout=false" label="Cancel" sm icon="x" />
              <x-button href="{{ route('logout') }}"
                onclick="event.preventDefault();
              this.closest('form').submit();" label="Logout"
                icon="logout" sm negative />
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <x-notifications z-index="z-50" />
  <x-dialog z-index="z-50" blur="md" align="center" />
  @livewireScripts
</body>

</html>
