<div>
  <div class="p-4 bg-white rounded-xl shadow">
    {{ $this->table }}
  </div>
  <x-modal wire:model.defer="view_modal" max-width="3xl">
    <x-card title="BORROWERS">
      <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
        @forelse ($assets as $item)
          <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
            @php
              $date = \App\Models\RequestedAsset::where('id', $item->requested_asset_id)
                  ->with('transaction')
                  ->first();
              $user = $date->transaction->user->employeeInformation;
            @endphp
            <div class="flex w-full items-center justify-between space-x-6 p-6">
              <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                  <h1 class="text-xs font-medium">Employee Name:</h1>
                  <h1 class="uppercase"> {{ $user->firstname . ' ' . $user->lastname }}</h1>
                </div>
                <div class="flex items-center space-x-3">
                  <h1 class="text-xs font-medium">Returned Date:</h1>
                  <h1 class="uppercase"> {{ $date->transaction->borrowed_date }}</h1>
                </div>
                <div class="flex flex-col items-start ">
                  <h1 class="text-xs font-medium">Purpose of borrowing:</h1>
                  <h1 class=""> {{ $date->transaction->purpose }}</h1>
                </div>
              </div>
              <x-avatar md label=" {{ $user->firstname[0] . '' . $user->lastname[0] }}" class="uppercase" />
            </div>
          </li>
        @empty
          <h3 class="truncate text-sm font-bold uppercase text-gray-900">
            No Borrowers
          </h3>
        @endforelse
        <!-- More people... -->
      </ul>

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat negative label="Cancel" x-on:click="close" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>

  {{-- <div class="px-2">
    <div class="flow-root">
      <ul role="list" class="-my-5 divide-y divide-gray-200">
        @php
          $assets = \App\Models\Asset::where('id', $getState())->first();
        @endphp

        @foreach ($assets->requestTransactions as $item)
          <li class="py-1">
            @php
              $date = \App\Models\RequestedAsset::where('id', $item->requested_asset_id)
                  ->with('transaction')
                  ->first();
              $user = $date->transaction->user->employeeInformation;
            @endphp
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <x-avatar sm label=" {{ $user->firstname[0] . '' . $user->lastname[0] }}" />
              </div>
              <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-bold uppercase text-gray-700">
                  {{ $user->firstname . ' ' . $user->lastname }}</p>
                <p class="truncate text-sm text-gray-500">

                  {{ $date->transaction->borrowed_date }}
                </p>
              </div>
            </div>
          </li>
        @endforeach


      </ul>
    </div>
  </div> --}}
</div>
