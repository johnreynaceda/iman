<div>
  <form class="mt-1 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
    <section aria-labelledby="cart-heading" class="lg:col-span-8">
      <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
        @foreach ($categories as $category)
          <li class="flex py-3 sm:py-3">
            <div class="flex-shrink-0">
              {{-- <img src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg"
                alt="Front of men&#039;s Basic Tee in sienna."
                class="h-10 w-10 rounded-md object-cover border object-center sm:h-20 sm:w-20"> --}}
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 fill-gray-500">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M14 10v4h-4v-4h4zm2 0h5v4h-5v-4zm-2 11h-4v-5h4v5zm2 0v-5h5v4a1 1 0 0 1-1 1h-4zM14 3v5h-4V3h4zm2 0h4a1 1 0 0 1 1 1v4h-5V3zm-8 7v4H3v-4h5zm0 11H4a1 1 0 0 1-1-1v-4h5v5zM8 3v5H3V4a1 1 0 0 1 1-1h4z" />
              </svg>
            </div>

            <div class="ml-2 flex flex-1 flex-col justify-between sm:ml-3">
              <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                <div>
                  <div class="flex justify-between">
                    <h3 class="text-sm">
                      <a href="#"
                        class="font-medium text-lg text-gray-700 hover:text-gray-800">{{ $category->name }}</a>
                    </h3>
                  </div>
                  <div class="flex items-center space-x-1 text-sm text-gray-700">
                    <p class="text-gray-900 font-medium">{{ $category->assets->where('status', 1)->count() ?? 0 }}</p>
                    <p> Asset(s)</p>
                  </div>
                </div>
              </div>

              <p class=" flex space-x-2 text-sm text-gray-700">
                <x-button label="Get Asset" xs positive icon="chevron-double-right"
                  wire:click="getAsset({{ $category->id }})" spinner="getAsset({{ $category->id }})" />
              </p>
            </div>
          </li>
        @endforeach
      </ul>
    </section>

    <!-- Order summary -->
    <section aria-labelledby="summary-heading"
      class="mt-16 rounded-lg bg-gray-100 px-4 py-6 sm:p-6 lg:col-span-4 lg:mt-0 lg:p-8">
      <h2 id="summary-heading" class="text-lg font-bold text-gray-700 uppercase">Requested List</h2>

      <dl class=" space-y-2">
        <ul role="list" class="divide-y divide-gray-200">

          @forelse ($get_asset as $key => $item)
            <li class="flex justify-between items-center py-4">
              <div class="ml-3">
                <p class="font-bold text-sm text-gray-700 uppercase">{{ $item['name'] }}</p>
                <div x-data="{ count: 0 }" class="flex items-center gap-x-1">
                  <x-button.circle x-hold.click.repeat.200ms="count--" icon="minus"
                    wire:click="minusQty({{ $key }})" spinner="minusQty({{ $key }})" xs white />

                  <span class="bg-teal-600 rounded text-white px-2 " x-text="{{ $item['qty'] }}"></span>

                  <x-button.circle x-hold.click.repeat.200ms="count++" icon="plus"
                    wire:click="addQty({{ $key }})" spinner="addQty({{ $key }})" xs white />
                </div>
              </div>
              <div>
                <x-button icon="x" label="remove" flat xs negative
                  wire:click="removeItem({{ $key }})" />
              </div>
            </li>
          @empty
            <div class="py-3 flex flex-col w-full ">
              <x-svg.no-result class="h-32" />
              <span class="text-sm ml-3">No Requested Asset</span>
            </div>
          @endforelse

        </ul>

      </dl>

      <div class="mt-6">
        <x-button label="Send Request" slate class="w-full" wire:click="$set('request_modal', true)"
          right-icon="external-link" />
      </div>
      {{-- <livewire:sample-data /> --}}
    </section>
  </form>
  <x-modal wire:model.defer="request_modal" align="center">
    <x-card title="FORM CONFIRMATION">
      <div>
        <div class="overflow-hidden bg-white ">
          <div class="">
            <h3 class="text-base font-semibold leading-6 text-gray-700">Your Personal Information</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
          </div>
          <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Full name</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  {{ $details->firstname . ' ' . $details->middlename[0] . '. ' . $details->lastname }}</dd>
              </div>
              <div class="sm:col-span-1">
                <x-datetime-picker label="Return Date" wire:model.defer="return_date" without-time placeholder=""
                  :min="now()" />

              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Address</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $details->address }}</dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $details->contact }}</dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Accountable Person</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $details->department->name }}</dd>
              </div>


              <div class="sm:col-span-2">
                <x-textarea wire:model="purpose" label="Purpose for request" placeholder="Your purpose" />
              </div>
              <div class="sm:col-span-2 rounded-lg bg-gray-200 p-4 relative overflow-hidden">
                <div class="absolute -bottom-20 -right-10">
                  <img src="{{ asset('images/IMAnLogo.png') }}" class="h-64 opacity-20" alt="">
                </div>
                <dt class="text-lg font-bold text-gray-700">REQUEST LISTS </dt>
                <dd class="mt-1 text-sm text-gray-900">
                  <ul role="list"
                    class="divide-y  divide-gray-200 relative space-y-1 rounded-md border border-gray-200">
                    @foreach ($get_asset as $item)
                      <li class="flex items-center bg-white rounded-lg justify-between py-3 pl-3 pr-4 text-sm">
                        <div class="flex w-0 flex-1 items-center">
                          <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                              d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                              clip-rule="evenodd" />
                          </svg>
                          <span class="ml-2 w-0 flex-1 truncate font-medium">{{ $item['name'] }} x
                            {{ $item['qty'] }}</span>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </dd>
              </div>
            </dl>
          </div>
        </div>

      </div>

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat label="Cancel" x-on:click="close" />
          <x-button positive label="Request Send" right-icon="arrow-narrow-right" wire:click="sendRequest"
            spinner="sendRequest" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>
</div>
