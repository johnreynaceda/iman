<div>
  <div class="flex w-full items-center justify-between space-x-6 relative  ">
    <div class="flex-1 truncate">
      <div class="d mt-2">
      </div>
      <div class="d mt-2">
        <h3 class="truncate text-xs  text-gray-400">Requested Item</h3>
        <h1 class="font-bold text-sm text-green-700 ">{{ $getRecord()->requestedAssets->count() }} Asset(s)</h1>
      </div>
      <div class="d mt-1">
        <h3 class="truncate text-xs  text-gray-400">Returned Date</h3>
        <h1 class="font-bold text-sm text-green-700 fill-primary flex space-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zM4 9v10h16V9H4zm2 2h2v2H6v-2zm0 4h2v2H6v-2zm4-4h8v2h-8v-2zm0 4h5v2h-5v-2z" />
          </svg>
          <span>{{ $getRecord()->returned_date }}</span>
        </h1>
      </div>
    </div>
    <div class="flex items-center space-y-1 flex-col">

      <x-avatar xl
        label="{{ $getRecord()->user->employeeInformation->firstname[0] }}{{ $getRecord()->user->employeeInformation->lastname[0] }}"
        class="uppercase" />

      @switch($getRecord()->status)
        @case(1)
          <x-badge flat warning label="Pending" />
        @break

        @case(2)
          <x-badge flat positive label="Approved" />
        @break

        @case(3)
          <x-badge flat negative label="Rejected" />
        @break

        @case(4)
          <x-badge flat indigo label="Returned" />
        @break

        @default
      @endswitch
      <div class="mt-1">
        @if ($getRecord()->status != 1)
          <x-button wire:click="openPreview({{ $getRecord()->id }})" spinner="openPreview({{ $getRecord()->id }})"
            label="Preview Request" right-icon="eye" 2xs positive />
        @endif
      </div>
    </div>
  </div>
  <div class="mt-3">
    <x-button wire:click="openRequest({{ $getRecord()->id }})" target_blank label="Open Request"
      right-icon="external-link" sm class="w-full" gray />
  </div>

  <x-modal wire:model.defer="preview_modal" align="center" max-width="lg">
    <x-card>
      {{-- <div>
        <div class="overflow-hidden bg-white ">
          <div class="">
            <h3 class="text-base font-semibold leading-6 text-gray-700">Requestor Information</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
          </div>
          <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Full name</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  {{ $details->employeeInformation->firstname ?? 'N/A' }}
                  {{ $details->employeeInformation->middlename[0] ?? 'N/A' }}.
                  {{ $details->employeeInformation->lastname ?? 'N/A' }}
                </dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Address</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $details->employeeInformation->address ?? 'N/A' }}</dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $details->employeeInformation->contact ?? 'N/A' }}</dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Department</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $details->employeeInformation->department->name ?? 'N/A' }}
                </dd>
              </div>

            </dl>
          </div>
        </div>
      </div> --}}

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat negative label="Close" x-on:click="close" />

        </div>
      </x-slot>
    </x-card>
  </x-modal>
</div>
