<div>
  <div>
    <div x-animate>
      @if ($add_donor)
        <x-button label="Cancel" negative icon="x" xs wire:click="$set('add_donor', false)" />
      @else
        <x-button label="New Donor" dark icon="plus" sm wire:click="$set('add_donor', true)" />
      @endif
      @if ($add_donor)
        <div class="mt-2 bg-gray-100 p-4 rounded-lg">
          <x-input label="Fullname" wire:model="fullname" />
          <div class="mt-2 flex justify-end">
            <x-button label="Save" primary right-icon="save" xs wire:click="addDonor" spinner="addDonor" />
          </div>
        </div>
      @endif
    </div>
    <div class="mt-2">
      {{ $this->table }}
    </div>
  </div>
</div>
