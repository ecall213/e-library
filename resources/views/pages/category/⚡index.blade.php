<?php

use Livewire\Component;
use Livewire\Attributes\computed;
use Livewire\WithPagination;
use App\Models\category;

new class extends Component
{
    use WithPagination;
    
    #[computed] 
    public function categories()
    {
        return category::latest()->paginate(10);
    }
};
?>

<div class="max-w-7xl mx-auto space-y-4">
    <flux:heading size="x1" class="text-zinc-800 dark:text-white">Category</flux:heading>
    <flux:subheading size="text-zinc-600 dark:text-zinc-400">Manage your categories</flux:subheading>
    <flux:separator variant="subtle" />

    <!-- modal -->
    <flux:modal.trigger name="create-category">
        <flux:button variant="primary" icon="plus" color="primary">Add Category</flux:button>
    </flux:modal.trigger>

    <livewire:category.create />
    <livewire:category.edit />

    <x-flash-message />

     {{-- table --}}
    <div class="overflow-x-auto">
       <flux:table :paginate="$this->categories">
            <flux:table.columns>
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Description</flux:table.column>
                <flux:table.column>Created At</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->categories as $category)
                    <flux:table.row :key="$category->id">
                        
                        <flux:table.cell class="flex items-center gap-3">
                            {{ $category->name }}
                        </flux:table.cell>

                        <flux:table.cell class="text-zinc-500 dark:text-zinc-400">
                            {{ $category->description ?? '-' }}
                        </flux:table.cell>

                        <flux:table.cell class="whitespace-nowrap">{{ $category->created_at->diffForHumans() }}</flux:table.cell>

                        <flux:table.cell>


                            <flux:dropdown>
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="pencil" wire:click="edit({{ $category->id }})">Edit</flux:menu.item>

                                    <flux:menu.separator />

                                    {{-- <flux:menu.item variant="danger" icon="trash" wire:click="$dispatch('confirm-delete', id: $category->id)">Delete</flux:menu.item> --}}
                                    <flux:menu.item variant="danger" icon="trash" wire:click="$dispatch('confirm-delete', {id: {{ $category->id }}})">Delete</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>


    </div>

</div>