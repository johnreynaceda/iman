<div>
  {{ $this->table }}

  <x-modal wire:model.defer="view_modal" align="center" max-width="lg">
    <x-card>
      <div>
        <div class="overflow-hidden bg-white ">
          <div class="">
            <h3 class="text-base font-semibold leading-6 text-gray-700">Requestor Information</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
          </div>
          <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Transaction Number</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  {{ $transactions->transaction_code }}
                </dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm ">
                  @switch($transactions->status)
                    @case(1)
                      <x-badge flat warning label="Pending" />
                    @break

                    @case(2)
                      <x-badge flat success label="Approved" />
                    @break

                    @case(3)
                      <x-badge flat negative label="Declined" />
                    @break

                    @case(4)
                      <x-badge flat blue label="Returned" />
                    @break

                    @case(5)
                      <x-badge flat negative label="Due" />
                    @break

                    @default
                  @endswitch
                </dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Borrowed Date</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $transactions->borrowed_date }}</dd>
              </div>
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Returned Date</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  {{ $transactions->returned_date }}
                </dd>
              </div>
              @if ($transactions->status == 3)
                <div class="sm:col-span-2">
                  <dt class="text-sm font-medium text-gray-500">Reason for rejecting request</dt>
                  <dd class="mt-1 text-sm text-gray-900">
                    <p class="text-red-500">
                      {{ $transactions->remarks }}
                    </p>
                  </dd>
                </div>
              @else
              @endif

              <div class="sm:col-span-2 bg-gray-100 p-2 rounded-lg shadow">
                <h1 class="font-medium text-gray-700">Requested List</h1>
                <div class="mt-2">
                  <div class="flow-root">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                          <thead>
                            <tr class="divide-x divide-gray-200">
                              <th scope="col"
                                class="py-2 w-20 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                CATEGORY
                              </th>
                              <th scope="col" class="px-4 py-2 text-left text-sm font-semibold text-gray-900">
                                QUANTITY

                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">
                            @foreach ($transactions->requestedAssets as $item)
                              <tr class="divide-x divide-gray-200">
                                <td class="whitespace-nowrap py-2 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-0">
                                  {{ $item->category->name }}</td>

                                <td class="whitespace-nowrap p-2 text-sm text-gray-500">
                                  {{ $item->quantity }} Asset(s)
                                </td>

                              </tr>
                            @endforeach

                            <!-- More people... -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </dl>
          </div>
        </div>
      </div>

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat negative label="Close" x-on:click="close" />

        </div>
      </x-slot>
    </x-card>
  </x-modal>
</div>
