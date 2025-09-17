<x-filament::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4" style="margin-top:2rem;">
            Save
        </x-filament::button>
    </form>
</x-filament::page>
