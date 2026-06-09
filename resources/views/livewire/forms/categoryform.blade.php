<flux:modal
    name="create-category"
    class="max-w-md"
    @close="closeModal"
>
    <div class="space-y-6">
        <flux:heading size="lg">{{ $categoryId ? __('Edit Category') : __('Create Category') }}</flux:heading>

        @error('name')
            <flux:callout variant="danger" icon="x-circle" heading="{{ $message }}" />
        @enderror

        <form class="space-y-4" wire:submit.prevent="save">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus />

            <flux:textarea wire:model="description" :label="__('Description')" />

            <div class="flex items-center gap-3">
                <flux:button variant="outline" wire:click="closeModal">{{ __('Cancel') }}</flux:button>

                <flux:button variant="primary" type="submit" class="flex-1">
                    {{ $categoryId ? __('Update') : __('Create') }}
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>
