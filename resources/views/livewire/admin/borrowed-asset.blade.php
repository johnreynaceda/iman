<div>
  <div class="bg-white p-4 rounded-xl shadow">
    {{ $this->table }}
  </div>
  <x-modal wire:model.defer="view_modal" max-width="3xl">
    <x-card>
      <h1 class="my-2 font-bold text-gray-600">TRANSACTION NUMBER: {{ $details->transaction_code ?? 'N/A' }}</h1>
      <div class="overflow-hidden bg-white">

        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
          <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">Borrowed Date</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ $details->borrowed_date ?? 'N/A' }}</dd>
            </div>
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">Returned Date</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ $details->returned_date ?? 'N/A' }}</dd>
            </div>
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500">Purpose of borrowing</dt>
              <dd class="mt-1 text-sm text-gray-900">{{ $details->purpose ?? 'N/A' }}</dd>
            </div>
            <div class="sm:col-span-2 bg-gray-200 relative overflow-hidden rounded-lg p-4">
              <div class="absolute -bottom-20 -left-10">
                <img src="{{ asset('images/IMAnLogo.png') }}" class="h-64 opacity-30" alt="">
              </div>
              <dt class="text-lg font-bold text-green-700 ">REQUESTED ASSETS</dt>
              <dd class="mt-1 text-sm text-gray-900">
                <div class="my-4 relative">
                  <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
                    @foreach ($assets as $asset)
                      <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                        <div class="flex w-full items-center justify-between space-x-6 p-4">
                          <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                              <h3 class="truncate  font-bold uppercase text-gray-700">{{ $asset->name }}</h3>
                            </div>
                            <p class="mt-1 truncate text-sm text-gray-500">{{ $asset->serial_number }}</p>

                          </div>
                          <img class="h-14 w-14 border flex-shrink-0 rounded-full bg-gray-300"
                            src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg"
                            alt="">
                        </div>
                        <div class="border-t p-2 flex flex-col space-y-1">
                          <x-native-select wire:model="new_remarks.{{ $asset->id }}">
                            <option selected hidden>Select Remarks</option>
                            <option value="1">Brand New</option>
                            <option value="2">Functional</option>
                            <option value="3">Unfunctional</option>
                            <option value="4">Slight Damage</option>
                            <option value="5">Damage</option>
                            <option value="6">Lost</option>
                          </x-native-select>
                          @isset($new_remarks[$asset->id])
                            @if ($new_remarks[$asset->id] == 5 || $new_remarks[$asset->id] == 6 || $new_remarks[$asset->id] == 4)
                              <x-input label="Remarks" wire:model="damage_remarks.{{ $asset->id }}" />
                            @endif
                          @endisset
                        </div>
                      </li>
                    @endforeach

                    <!-- More people... -->
                  </ul>

                </div>

              </dd>
            </div>
          </dl>
        </div>
      </div>

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat negative label="Cancel" x-on:click="close" />
          <x-button positive label="Return Asset" icon="reply"
            x-on:confirm="{
        title: 'Are you sure to continue?',
        description: 'make sure that the asset is returned and the remarks is correct.',
        icon: 'question',
        method: 'returnAsset',
    }" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>

  <x-modal wire:model.defer="return_modal" max-width="lg">
    <x-card title="DUE REQUESTS">
      <div>
        <div class="mt-6 flow-root">
          <ul role="list" class="-my-5 divide-y divide-gray-200">
            @foreach ($requested_asset as $key => $item)
              <li wire:key="{{ $item }}" class="py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                      <path fill="none" d="M0 0h24v24H0z" />
                      <path
                        d="M20.083 15.2l1.202.721a.5.5 0 0 1 0 .858l-8.77 5.262a1 1 0 0 1-1.03 0l-8.77-5.262a.5.5 0 0 1 0-.858l1.202-.721L12 20.05l8.083-4.85zm0-4.7l1.202.721a.5.5 0 0 1 0 .858L12 17.65l-9.285-5.571a.5.5 0 0 1 0-.858l1.202-.721L12 15.35l8.083-4.85zm-7.569-9.191l8.771 5.262a.5.5 0 0 1 0 .858L12 13 2.715 7.429a.5.5 0 0 1 0-.858l8.77-5.262a1 1 0 0 1 1.03 0zM12 3.332L5.887 7 12 10.668 18.113 7 12 3.332z" />
                    </svg>
                  </div>
                  <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-medium text-gray-700 uppercase">{{ $item->asset->name }}</p>
                    <p class="truncate text-sm text-gray-500">{{ $item->asset->serial_number }}</p>
                  </div>
                  <div>
                    <x-native-select label="Select New Remarks" wire:model="new_remarks.{{ $item->id }}">

                      <option value="1">Brand New</option>
                      <option value="2">Functional</option>
                      <option value="3">Unfunctional</option>
                      <option value="4">Slight Damage</option>
                      <option value="5">Damage</option>
                      <option value="6">Lost</option>
                    </x-native-select>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>


      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat label="Cancel" x-on:click="close" />
          <x-button dark right-icon="reply" wire:click="returnAssets({{ $transaction_id }})"
            spinner="returnAssets({{ $transaction_id }})" label="Return Assets" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>
</div>
