<div>

  <form class="space-y-6" action="#" method="POST">

    <div class="flex space-x-2 items-center">
      <img src="{{ asset('images/IMAnLogo.png') }}" class="h-16" alt="">
      <h1 class="font-bold text-white lg:text-2xl">INTEGRATED MINDANAONS ASSOCIATION FOR NATIVES (IMAN)</h1>
    </div>
    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <h1 class="font-bold text-xl text-gray-600">CREATE NEW ACCOUNT</h1>
          <h1 class="text-sm text-gray-400">Please fill-in all the inputs. </h1>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-2">
              <x-input wire:model.defer="firstname" label="First Name" />
            </div>

            <div class="col-span-6 sm:col-span-2">
              <x-input wire:model.defer="middlename" label="Middle Name" />
            </div>
            <div class="col-span-6 sm:col-span-2">
              <x-input wire:model.defer="lastname" label="Last Name" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <x-input wire:model.defer="address" label="Address" />
            </div>
            <div class="col-span-6 sm:col-span-2">
              <x-input wire:model.defer="contact" label="Phone Number" />
            </div>

            <div class="col-span-6 sm:col-span-6">
              <div class="border-t">
              </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <x-input wire:model.defer="username" label="Username" />
            </div>
            <div class="col-span-6 sm:col-span-3">
              <x-input wire:model.defer="email" label="Email" suffix="@" />
            </div>
            <div class="col-span-6 sm:col-span-3">
              <x-inputs.password wire:model.defer="password" label="Password" />
            </div>
            <div class="col-span-6 sm:col-span-3">
              <x-inputs.password wire:model.defer="confirm_password" label="Confirm Password" />
            </div>



            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
              <x-native-select label="Department" wire:model="department_id">
                <option selected hidden>Select Department</option>
                @foreach ($departments as $department)
                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach

              </x-native-select>
            </div>
          </div>
        </div>
      </div>
      <div class="flex mt-5 justify-end space-x-3">
        <x-button href="{{ route('login') }}" label="Back to login" />
        <x-button wire:click="create" label="CREATE" right-icon="arrow-narrow-right" spinner="create" positive
          class="font-medium" />
      </div>
    </div>



  </form>

</div>
