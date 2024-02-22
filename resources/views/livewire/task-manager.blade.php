
<!-- resources/views/livewire/task-manager.blade.php -->

<div>
    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="submitForm">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" wire:model="full_name" />
            @error('full_name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" wire:model="phone_number" />
            @error('phone_number') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" wire:model="image" />
            @error('image') <span class="error">{{ $message }}</span> @enderror

            @if ($editId)
                <div class="mt-2">
                    <img src="{{ optional($pens->firstWhere('id', $editId))->image_url }}" alt="Image Preview" style="max-width: 200px; max-height: 200px;" />
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        @if ($editId)
            Livewire.emit('openFormModal');
        @endif
    });
</script>


