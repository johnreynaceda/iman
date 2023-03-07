<div>
  @if (auth()->user()->is_admin)
    <x-button rounded xs warning label="View Details" class="font-medium" spinner="viewDetail({{ $getState() }})"
      wire:click="viewDetail({{ $getState() }})" icon="eye" />
  @else
    <x-button rounded xs positive label="View Details" class="font-medium" spinner="viewDetail({{ $getState() }})"
      wire:click="viewDetail({{ $getState() }})" icon="eye" />
  @endif
</div>
