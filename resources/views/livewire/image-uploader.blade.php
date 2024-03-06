<div>

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
                    <div class="modal-body" style="display: flex;justify-content: center;"
                        id="open-{{ $img }}">
                        @if ($value)
                            <img width="150" height="150" src="{{ $value->temporaryUrl() }}" alt=""
                                srcset="">
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-primary">
                            Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin: 0;max-width: 100% !important;">

        <label for="up-{{ $img }}" class="control-label  {{ $isRequired ? 'asterisk' : '' }}" style='text-align:left'>
            {{ $label }}
        </label>


        <div class="" style="display:flex;gap:4px;position: relative;">
            <label id='mas{{ $img }}' for="up-{{ $img }}" class=" form-control "
                style='text-align:left;   white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;color:grey;font-size:small'>
            {{ $label }}
            </label>
            <input type="file" style="display: none;" id="up-{{ $img }}" wire:model="{{ $img }}"
                class="form-control" name="{{ $img }}" accept="image/*">
            <button data-toggle="modal" type='button' class="btn btn-sm btn-info"
                @if ($value) style='display:block;'
                @else style='display:none;' @endif
                id="dis-{{ $img }}" data-target="#{{ $img }}"> Preview</button>
        </div>

        @error($img)
            <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                {{ $message }}</label>
        @enderror

    </div>

</div>

<script>
    document.getElementById('up-{{ $img }}').addEventListener('change', function() {
        console.log('call')
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var imageUrl = event.target.result;
                $('#open-{{ $img }}').html('')
                $('#open-{{ $img }}').html('<img width="150" height="150" src="' + imageUrl +
                    '">')

                $('#dis-{{ $img }}').css('display', 'block')
                $('#mas{{ $img }}').text(file.name)

            };
            reader.readAsDataURL(file);
        }
    });

    $('#adder').on('click', () => {

        $('#{{ $img }}').model('show');
    })
</script>
