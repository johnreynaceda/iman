<div>
  @if ($getRecord()->status == 5)
    <x-button label="Return Asset" right-icon="reply" slate xs wire:click="openReturnModal({{ $getState() }})" />
  @else
    <x-button label="View" icon="eye" sm dark wire:click="viewRecord({{ $getState() }})"
      spinner="viewRecord({{ $getState() }})" />
  @endif
</div>
