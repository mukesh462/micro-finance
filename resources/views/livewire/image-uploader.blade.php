<div>
    @livewireStyles
    <div class="bs-example">

        <div id="{{ $img }}" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Image preview
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body" id="open_preview">
                        <img id="previewImage" width='100' height='100' src="" alt="Preview">
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" id="reset-form" class="btn btn-primary">
                            Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <input type="file" wire:model="image">
        <button wire:click="showPreview">Show Preview</button>
    </div>
    {{-- <div id="imagePreviewModal" style="display: none;">
        <img id="previewImage" src="" alt="Preview">
    </div> --}}
</div>
@livewireScripts
<script>
    document.addEventListener('livewire:load', function() {
        $wire.on('showPreview', (s) => {
            //
            console.log(s, 'gegegege')
        });
        Livewire.on('showPreview', imageUrl => {
            document.getElementById('previewImage').src = imageUrl;
            alert(imageUrl)
            $('#{{ $img }}').model('show');
            //document.getElementById('imagePreviewModal').style.display = 'block';
        });
    });
</script>
