<div>
  <div class="p-4 bg-gray-100 rounded-lg">
    <x-input label="Category Name" wire:model.defer="name" />
    <div class="mt-2">
      <x-button label="Add Category" right-icon="save-as" gray wire:click="addCategory" spinner="addCategory" />
    </div>
  </div>
  <div class="mt-3">
    {{ $this->table }}
  </div>
</div>
