@section('title', 'Dashboard')
<x-admin-layout>

  <!-- Card is full width. Use in 12 col grid for best view. -->
  <!-- Card code block start -->
  <div class="w-full grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    <div class="bg-white dark:bg-gray-800 rounded py-5 pl-6 flex items-start shadow">
      <div class="text-gray-700 dark:text-gray-400">
        <img class="dark:hidden"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1.svg" alt="icon" />
        <img class="hidden dark:block"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1dark.svg"
          alt="icon" />
      </div>
      <div class="pl-3 pr-10 mt-1">
        <h3 tabindex="0" class="focus:outline-none  leading-4 text-gray-600 font-bold dark:text-gray-100 text-base">
          Total Pending</h3>
        <div class="flex items-end mt-4">
          <h2 tabindex="0"
            class="focus:outline-none text-yellow-500 dark:text-yellow-600 text-2xl leading-normal font-bold">
            {{ \App\Models\Transaction::where('status', 1)->count() }}</h2>
          <p tabindex="0" class="focus:outline-none ml-2 mb-1 text-sm text-gray-600 dark:text-gray-400">Request(s)</p>
        </div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded py-5 pl-6 flex items-start shadow">
      <div class="text-gray-700 dark:text-gray-400">
        <img class="dark:hidden"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1.svg"
          alt="icon" />
        <img class="hidden dark:block"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1dark.svg"
          alt="icon" />
      </div>
      <div class="pl-3 pr-10 mt-1">
        <h3 tabindex="0" class="focus:outline-none  leading-4 text-gray-600 font-bold dark:text-gray-100 text-base">
          Total Accepted</h3>
        <div class="flex items-end mt-4">
          <h2 tabindex="0"
            class="focus:outline-none text-green-500 dark:text-yellow-600 text-2xl leading-normal font-bold">
            {{ \App\Models\Transaction::whereIn('status', [2, 4])->count() }}</h2>
          <p tabindex="0" class="focus:outline-none ml-2 mb-1 text-sm text-gray-600 dark:text-gray-400">Request(s)</p>
        </div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded py-5 pl-6 flex items-start shadow">
      <div class="text-gray-700 dark:text-gray-400">
        <img class="dark:hidden"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1.svg"
          alt="icon" />
        <img class="hidden dark:block"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1dark.svg"
          alt="icon" />
      </div>
      <div class="pl-3 pr-10 mt-1">
        <h3 tabindex="0" class="focus:outline-none  leading-4 text-gray-600 font-bold dark:text-gray-100 text-base">
          Total Declined</h3>
        <div class="flex items-end mt-4">
          <h2 tabindex="0"
            class="focus:outline-none text-red-500 dark:text-yellow-600 text-2xl leading-normal font-bold">
            {{ \App\Models\Transaction::where('status', 3)->count() }}</h2>
          <p tabindex="0" class="focus:outline-none ml-2 mb-1 text-sm text-gray-600 dark:text-gray-400">Request(s)</p>
        </div>
      </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded py-5 pl-6 flex items-start shadow">
      <div class="text-gray-700 dark:text-gray-400">
        <img class="dark:hidden"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1.svg"
          alt="icon" />
        <img class="hidden dark:block"
          src="https://tuk-cdn.s3.amazonaws.com/can-uploader/medium_stat_cards_alternate_style-svg1dark.svg"
          alt="icon" />
      </div>
      <div class="pl-3 pr-10 mt-1">
        <h3 tabindex="0" class="focus:outline-none  leading-4 text-gray-600 font-bold dark:text-gray-100 text-base">
          Total Returned</h3>
        <div class="flex items-end mt-4">
          <h2 tabindex="0"
            class="focus:outline-none text-blue-500 dark:text-yellow-600 text-2xl leading-normal font-bold">
            {{ \App\Models\Transaction::where('status', 4)->count() }}</h2>
          <p tabindex="0" class="focus:outline-none ml-2 mb-1 text-sm text-gray-600 dark:text-gray-400">Request(s)</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Card code block end -->
  {{-- <livewire:sample-data /> --}}
</x-admin-layout>
