<div wire:poll.5s x-data="{ notif: false }">

  <div class="flex space-x-3 items-center">
    <button x-on:click="notif = !notif"
      class="bg-green-600 hover:bg-green-800 text-white h-9 grid place-content-center rounded-xl w-9 relative ">
      <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path
          d="M14.65 8.512c-2.28-4.907-3.466-6.771-7.191-6.693-1.327.027-1.009-.962-2.021-.587-1.01.375-.143.924-1.177 1.773-2.902 2.383-2.635 4.587-1.289 9.84.567 2.213-1.367 2.321-.602 4.465.559 1.564 4.679 2.219 9.025.607 4.347-1.613 7.086-4.814 6.527-6.378-.765-2.145-2.311-.961-3.272-3.027zm-3.726 8.083c-3.882 1.44-7.072.594-7.207.217-.232-.65 1.253-2.816 5.691-4.463 4.438-1.647 6.915-1.036 7.174-.311.153.429-1.775 3.116-5.658 4.557zm-1.248-3.494c-2.029.753-3.439 1.614-4.353 2.389.643.584 1.847.726 3.046.281 1.527-.565 2.466-1.866 2.095-2.904l-.016-.036c-.251.082-.508.171-.772.27z">
        </path>
      </svg>
      <span
        class="absolute -top-2.5 -right-2 items-center rounded-full bg-red-600 px-2.5 py-0.5 text-xs font-medium text-white">
        {{ $notifications->where('read_at', null)->count() }}
      </span>
    </button>
    <x-dropdown>
      <x-slot name="trigger">
        <x-avatar lg src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg" />
      </x-slot>

      <x-dropdown.item separator label="Profile" href="{{ route('admin.profile') }}" icon="user-circle" />
      <x-dropdown.item separator label="Logout" icon="logout" wire:click="$set('logout_modal' , true)" />
    </x-dropdown>
  </div>


  <x-modal wire:model.defer="logout_modal" align="center" max-width="md">
    <x-card>
      <div class="sm:flex sm:items-start z-50">
        <div
          class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
          <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
          </svg>
        </div>
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
          <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Logout account</h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">Are you sure you want to Logout your account?</p>
          </div>
        </div>
      </div>

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat label="Close" x-on:click="close" />

          <form method="POST" action="{{ route('logout') }}" role="none">
            @csrf

            <x-button href="{{ route('logout') }}"
              onclick="event.preventDefault();
                          this.closest('form').submit();" negative
              label="Logout" icon="logout" />
          </form>
        </div>
      </x-slot>
    </x-card>
  </x-modal>

  <div x-show="notif" @click.away="notif = false" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="absolute top-[6rem] resize-y bg-white shadow-lg p-3 rounded-lg border  w-80 z-10 right-32">
    <div class="relative">
      <div class="header flex justify-between items-center">
        <h1 class="font-semibold text-lg text-gray-700">Notifications</h1>
        <button wire:click="readAll" class="underline text-sm text-green-600 hover:text-green-800">
          <span>Mark all as read</span>
        </button>
      </div>
      <ul role="list" class="mt-2 h-96 overflow-y-auto">
        @forelse ($notifications as $item)
          @if ($item->sender_id == 1)
            <li class="flex py-2 cursor-pointer hover:bg-gray-100 rounded-lg px-1"
              onClick="location.href='{{ route('admin.borrowed') }}'"
              wire:click="openRequest({{ $item->id }},{{ $item->redirect }})">
            @else
            <li class="flex py-2 cursor-pointer hover:bg-gray-100 rounded-lg px-1"
              wire:click="openRequest({{ $item->id }},{{ $item->redirect }})">
          @endif
          @php
            $avatar = \App\Models\User::where('id', $item->sender_id)->first();
          @endphp
          @if ($item->sender_id == 1)
            <x-avatar md label="AD" class="uppercase" />
          @else
            <x-avatar md
              label="{{ $avatar->employeeInformation->firstname[0] }}{{ $avatar->employeeInformation->lastname[0] }}"
              class="uppercase" />
          @endif
          <div class="ml-3">
            <p class="text-sm font-medium  {{ $item->read_at == null ? 'text-green-500' : 'text-gray-700' }}">
              @if ($item->sender_id == 1)
              @else
                {{ $avatar->employeeInformation->firstname }} {{ $avatar->employeeInformation->lastname }}
              @endif
              {{ $item->description }}
            </p>
            <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
          </div>
          </li>
        @empty
          <li class="flex py-2 cursor-pointer hover:bg-gray-100 rounded-lg px-1">
            <p class="text-sm font-medium text-gray-700">No notifications yet</p>
          </li>
        @endforelse
      </ul>
    </div>
  </div>
</div>
