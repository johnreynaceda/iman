<div>
  <x-button label="RETURN" gray href="{{ route('admin.requests') }}" class="font-bold" icon="reply" />
  <div class="p-4 mt-3 bg-white rounded-xl shadow">

    <div class="overflow-hidden bg-white ">
      <div class="">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Requestor Information</h3>
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
            <dt class="text-sm font-medium text-gray-500">Transaction Number</dt>
            <dd class="mt-1 text-sm text-gray-900">
              {{ $transaction->transaction_code }}</dd>
            </dd>
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
            <dt class="text-sm font-medium text-gray-500">Borrowed Date</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $transaction->borrowed_date }}</dd>
          </div>
          <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Returned Date</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $transaction->returned_date }}</dd>
          </div>
          <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Purpose of borrowing</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $transaction->purpose }}</dd>
          </div>
          <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Department</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $transaction->user->employeeInformation->department->name }}</dd>
          </div>

          <div class="sm:col-span-2 rounded-lg bg-gray-200 p-4">
            <dt class="text-md font-bold text-gray-700">REQUEST LISTS </dt>
            <dd class="mt-1 text-sm text-gray-900">

              <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($transaction->requestedAssets as $key => $item)
                  <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                    <div class="flex w-full items-center justify-between space-x-6 p-4">
                      <div class="flex-1 truncate">
                        <div class="flex items-center space-x-3">
                          <h3 class="truncate  font-bold uppercase text-gray-700">{{ $item->category->name }}</h3>
                        </div>
                        <p class="mt-1 truncate text-sm text-gray-500">x {{ $item->quantity }}</p>
                        <x-button label="manage" wire:click="manageItem({{ $item->id }},{{ $item->category_id }})"
                          class="mt-2" positive 2xs right-icon="arrow-right" />
                      </div>
                      <img class="h-14 w-14 border flex-shrink-0 rounded-full bg-gray-300"
                        src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg"
                        alt="">
                    </div>
                    <div class=" border-t p-1">
                      <div>
                        <div class="flow-root">
                          <ul role="list" class=" divide-y divide-gray-200">
                            @php
                              $selecteds = collect($selected_asset)->where('category_id', $item->category_id);
                            @endphp
                            @forelse ($selecteds as $key => $item)
                              <li class="py-1 px-1">
                                <div class="flex items-center space-x-4">
                                  <div class="flex-shrink-0">

                                  </div>
                                  <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-medium text-gray-900">{{ $item['name'] }}</p>
                                  </div>
                                  <div>
                                    <x-button label="remove" icon="x"
                                      wire:click="removeAsset({{ $key }})" flat negative 2xs />
                                  </div>
                                </div>
                              </li>
                            @empty
                            @endforelse
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            </dd>
          </div>

          <div class="div flex space-x-3">
            <x-button label="Accept"
              x-on:confirm="{
              title: 'Sure to accept?',
              description: 'This action cannot be undone.',
              icon: 'question',
              method: 'acceptRequest',
          }"
              positive class="font-bold" spinner="acceptRequest" icon="thumb-up" />
            <x-button label="Decline" spinner="declineRequest" negative class="font-bold" icon="thumb-down"
              x-on:confirm="{
              title: 'Sure to decline?',
              description: 'This action cannot be undone.',
              icon: 'question',
              method: 'declineRequest',
          }" />
          </div>
        </dl>
      </div>
    </div>
  </div>

  <x-modal wire:model.defer="assets_modal" max-width="md" align="center">
    <x-card title="LIST OF ASSETS">
      <div>
        <ul role="list" class="divide-y divide-gray-200">
          @foreach ($assets as $asset)
            <li class="flex py-2">
              <div class="flex justify-between w-full ">
                <div class="flex">
                  <img class="h-10 w-10 rounded-full"
                    src="https://t3.ftcdn.net/jpg/04/62/93/66/360_F_462936689_BpEEcxfgMuYPfTaIAOC1tCDurmsno7Sp.jpg"
                    alt="">
                  <div class="ml-3">
                    <p class="text-md truncate uppercase font-bold text-gray-700">{{ $asset->name }}</p>
                    <p class="text-xs text-gray-500">{{ $asset->serial_number }}</p>
                  </div>
                </div>
                <div>
                  <x-button.circle wire:click="selectAsset({{ $asset->id }})"
                    spinner="selectAsset({{ $asset->id }})" class="mt-2" positive xs icon="arrow-right" />
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat negative label="Close" x-on:click="close" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>

  <x-modal wire:model.defer="remarks_modal" align="center">
    <x-card>
      <div>
        <form action="#" class="relative">
          <div
            class="overflow-hidden rounded-lg border border-gray-300 shadow-sm focus-within:border-green-500 focus-within:ring-1 focus-within:ring-green-500">
            <label for="title" class="sr-only">REMARKS</label>
            <h1 class="p-3 text-lg font-bold">REMARKS</h1>
            <label for="description" class="sr-only">Description</label>
            <textarea rows="2" name="description" wire:model.defer="remarks" id="description"
              class="block w-full resize-none border-0 py-0 placeholder-gray-500 focus:ring-0 sm:text-sm"
              placeholder="Write your reason for declining the request..."></textarea>
            @error('remarks')
              <span class="text-sm ml-3 text-red-500">{{ $message }}</span>
            @enderror

            <!-- Spacer element to match the height of the toolbar -->
            <div aria-hidden="true">
              <div class="py-2">
                <div class="h-9"></div>
              </div>
              <div class="h-px"></div>
              <div class="py-2">
                <div class="py-px">
                  <div class="h-9"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="absolute inset-x-px bottom-0">

            <div class="flex items-center justify-between space-x-3 border-t border-gray-200 px-2 py-2 sm:px-3">
              <div class="flex">

              </div>
              <div class="flex-shrink-0">
                <x-button label="Done" negative wire:click="doneRemark" spinner="doneRemark"
                  right-icon="save-as" />
              </div>
            </div>
          </div>
        </form>

      </div>
    </x-card>
  </x-modal>


</div>
