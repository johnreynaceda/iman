<div>

  <div class="p-4 bg-white rounded-xl shadow">
    <div class="header mb-3 flex justify-between">
      <x-button label="Add New Asset" icon="plus" gray wire:click="$set('add_modal', true)" />
      <x-button label="Manage Category" primary icon="cog" wire:click="$set('manage_modal', true)" />
    </div>
    {{ $this->table }}
  </div>

  <x-modal wire:model.defer="manage_modal" max-width="2xl">
    <x-card title="Manage Category Assets">

      <livewire:admin.category />

    </x-card>
  </x-modal>

  <x-modal wire:model.defer="add_modal" max-width="lg" align="center">
    <x-card title="Add New Assets">
      <div class="grid grid-cols-2 gap-4">
        <x-input wire:model.defer="name" label="Asset Name" />
        <x-input wire:model.defer="price" label="Price" suffix="₱" />
        <div class="col-span-2">
          <x-textarea wire:model.defer="description" label="Description" placeholder="Description here" />
        </div>
        <x-input wire:model.defer="serial_number" label="Serial Number" />
        <x-native-select label="Category" wire:model.defer="category">
          <option selected hidden>Select Category</option>
          @foreach ($categories as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endforeach
        </x-native-select>
        <x-native-select label="Remarks" wire:model.defer="remarks">
          <option selected hidden>Select Remarks</option>
          <option value="1">Brand New</option>
          <option value="2">Functional</option>
          <option value="3">Unfunctional</option>
          <option value="4">Slight Damage</option>
          <option value="5">Damage</option>
          <option value="6">Lost</option>
        </x-native-select>
        <div class="div flex flex-col space-y-1 justify-end ">
          <x-checkbox id="right-label" label="Is Bundle" wire:model="is_bundle" />
          @if ($is_bundle)
            <x-inputs.number label="Quantity" wire:model.defer="quantity" />
          @endif
        </div>
      </div>

      <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
          <x-button flat label="Cancel" x-on:click="close" />
          <x-button primary label="Save" right-icon="save-as" wire:click="addAsset" spinner="addAsset" />
        </div>
      </x-slot>
    </x-card>
  </x-modal>
</div>
