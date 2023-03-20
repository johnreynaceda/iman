<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>IMAN - Login</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
  <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

  <!-- Production -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <style>
    .custom-shape-divider-bottom-1679296373 {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      overflow: hidden;
      line-height: 0;
      transform: rotate(180deg);
    }

    .custom-shape-divider-bottom-1679296373 svg {
      position: relative;
      display: block;
      width: calc(250% + 1.3px);
      height: 124px;
      transform: rotateY(180deg);
    }

    .custom-shape-divider-bottom-1679296373 .shape-fill {
      fill: #F1F1F1;
    }
  </style>
  <!-- Scripts -->
  @wireUiScripts
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles
</head>

<body class="font-sans antialiased bg-gradient-to-br from-green-600 to-green-700 overflow-hidden">
  <div class="absolute -left-32 -bottom-32">
    <img src="{{ asset('images/IMAnLogo.png') }}" class="opacity-25" alt="">
  </div>

  <div class="flex min-h-full h-screen flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-20 w-auto" src="{{ asset('images/IMAnLogo.png') }}" alt="Your Company">
      <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-white">INTEGRATED MINDANAONS ASSOCIATION FOR
        NATIVES (IMAN)</h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white relative py-8 px-4 mx-2 shadow sm:rounded-lg sm:px-10">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form class="space-y-6" form method="POST" action="{{ route('login') }}">
          @csrf
          <div>

            <div class="mt-1">
              <x-input label="Email Address" id="email" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            </div>
            {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
          </div>

          <div>

            <div class="mt-1">
              {{-- <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"> --}}
              <x-inputs.password label="Password" id="password" type="password" name="password" required
                autocomplete="current-password" />
            </div>
            {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
          </div>

          <div class="flex items-center justify-between">
            <div class="block mt-4">
              <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                  class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                  name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
              </label>
            </div>

            @if (Route::has('password.request'))
              <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
              </a>
            @endif
          </div>

          <div>
            <x-button label="Sign In" type="submit" class="w-full" positive right-icon="login" />
          </div>
        </form>
        <div class="mt-6">
          <span class="text-gray-700">If you dont have an account, <a href="{{ route('register') }}"
              class="text-green-600 hover:text-green-700">Register
              Here</a></span>
        </div>
      </div>
    </div>
  </div>
  <div class="custom-shape-divider-bottom-1679296373">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path
        d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
        opacity=".25" class="shape-fill"></path>
      <path
        d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
        opacity=".5" class="shape-fill"></path>
      <path
        d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
        class="shape-fill"></path>
    </svg>
  </div>

  <x-notifications z-index="z-50" />
  <x-dialog z-index="z-50" blur="md" align="center" />
  @livewireScripts
</body>

</html>
