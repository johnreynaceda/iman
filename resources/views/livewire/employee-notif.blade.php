<div wire:poll.5s x-data="{ notif: false }">
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

  <div x-show="notif" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="notif = false"
    class="absolute top-[3.6rem] right-0 h-96   bg-white shadow-lg p-3 rounded-lg border  w-80 z-50 overflow-auto">
    <div class="relative overflow-y-auto">
      <div class="header flex justify-between items-center">
        <h1 class="font-semibold text-lg text-gray-700">Notifications</h1>
        <button wire:click="readAll" class="underline text-sm text-green-600 hover:text-green-800">
          <span>Mark all as read</span>
        </button>
      </div>
      <ul role="list" class="mt-2 ">
        @forelse ($notifications as $item)
          @if ($item->redirect == 's')
            <li class="flex py-2 cursor-pointer hover:bg-gray-100 rounded-lg px-1"
              wire:click="openRequest({{ $item->id }})" onClick="location.href='{{ route('employee.history') }}'">
            @else
            <li class="flex py-2 cursor-pointer hover:bg-gray-100 rounded-lg px-1"
              wire:click="openRequest({{ $item->id }})">
          @endif
          @php
            $avatar = \App\Models\User::where('id', $item->sender_id)->first();
          @endphp
          <x-avatar md label="AD" class="uppercase" />
          <div class="ml-3">
            <p class="text-sm font-medium  {{ $item->read_at == null ? 'text-green-500' : 'text-gray-700' }}">
              {{ $item->description }}</p>
            <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
          </div>
          </li>
        @empty
          <li class="flex py-2 cursor-pointer hover:bg-gray-100 rounded-lg px-1">
            <p class="text-sm font-medium text-gray-700">No notifications</p>
          </li>
        @endforelse
      </ul>
    </div>
  </div>
</div>
