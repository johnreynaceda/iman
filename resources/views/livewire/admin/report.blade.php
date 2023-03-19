<div x-data>
  <div>
    <ul role="list" class="mt-3 grid grid-cols-2 gap-5  lg:grid-cols-2 xl:grid-cols-2">
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF DAMAGE ASSETS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle wire:click="openReportModal(1)" spinner="openReportModal(1)" icon="printer" positive />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF MOST BORROWED
              ASSETS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(2)" spinner="openReportModal(2)" />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF LEAST BORROWED
              ASSETS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(3)" spinner="openReportModal(3)" />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF UNRETURNED ASSETS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(4)" spinner="openReportModal(4)" />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF LOST ASSETS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(5)"
                spinner="openReportModal(5)" />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
            class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF BLACKLISTED
              EMPLOYEE</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(6)"
                spinner="openReportModal(6)" />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
            class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF DONORS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(7)"
                spinner="openReportModal(7)" />
            </button>
          </div>
        </div>
      </li>
      <li class="col-span-1 flex rounded-md shadow-sm">
        <div
          class="flex-shrink-0 flex items-center justify-center w-16 bg-gray-600 text-white text-sm font-medium rounded-l-md">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
            class="fill-white">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M21 9v11.993A1 1 0 0 1 20.007 22H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.447 2 3.998 2H14v6a1 1 0 0 0 1 1h6zm0-2h-5V2.003L21 7zM8 7v2h3V7H8zm0 4v2h8v-2H8zm0 4v2h8v-2H8z" />
          </svg>
        </div>
        <div
          class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
          <div class="flex-1 truncate px-4 py-4 text-sm">
            <a href="#" class="font-bold text-lg text-gray-700 hover:text-gray-600">LIST OF ASSETS</a>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button"
              class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white bg-transparent text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <span class="sr-only">Open options</span>
              <x-button.circle icon="printer" positive wire:click="openReportModal(8)"
                spinner="openReportModal(8)" />
            </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <x-modal wire:model.defer="report_modal" max-width="5xl">
    <x-card>
      <div class="flex justify-between items-center bg-gray-100 rounded-lg">
        <div class="p-2">
          @if ($type == 8)
            <x-native-select wire:model="donor_id">
              <option>Filter By Donor</option>
              @foreach ($selected_donor as $item)
                <option value="{{ $item->id }}">{{ $item->fullname }}</option>
              @endforeach
            </x-native-select>
          @endif
        </div>
        <div class=" flex justify-end space-x-2 p-2  items-center ">
          <x-datetime-picker placeholder="Start Date" without-time wire:model="start_date" />
          <span>-</span>
          <x-datetime-picker placeholder="End Date" without-time wire:model="end_date" />
        </div>
      </div>
      <div class="p-2 " x-ref="printContainer">
        <div class="flex space-x-1 items-center">
          <img src="{{ asset('images/IMAnLogo.png') }}" class="h-10" alt="">
          <span class="font-semibold text-xl">INTEGRATED MINDANAONS ASSOCIATION FOR NATIVES (IMAN)</span>
        </div>
        @switch($type)
          @case(1)
            @include('admin.reports.damage-asset')
          @break

          @case(2)
            @include('admin.reports.most-borrowed')
          @break

          @case(3)
            @include('admin.reports.least-borrowed')
          @break

          @case(4)
            @include('admin.reports.unreturned')
          @break

          @case(5)
            @include('admin.reports.lost')
          @break

          @case(6)
            @include('admin.reports.blacklisted')
          @break

          @case(7)
            @include('admin.reports.donors')
          @break

          @case(8)
            @include('admin.reports.assets')
          @break

          @default
        @endswitch
      </div>
      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat negative label="Cancel" x-on:click="close" />
          <x-button positive label="Print Report" icon="printer"
            @click="printOut($refs.printContainer.outerHTML);" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>
</div>
