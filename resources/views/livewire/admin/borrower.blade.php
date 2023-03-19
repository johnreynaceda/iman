<div>
  <div class="p-4 bg-white rounded-xl shadow">
    <div class="mb-3">
      <p class="font-medium text-gray-600">The table displays a list of users categorized into those who are blacklisted
        and those who
        are not
        blacklisted.</p>
    </div>
    {{ $this->table }}
  </div>

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
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Reset Password</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  <x-button label="Reset Password" spinner="resetPassword" right-icon="key"
                    x-on:confirm="{
        title: 'Sure to reset password?',
        description: 'This will reset the password of the user to the default password.',
        icon: 'question',
        method: 'resetPassword',
    }"
                    negative rounded sm />
                </dd>
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
