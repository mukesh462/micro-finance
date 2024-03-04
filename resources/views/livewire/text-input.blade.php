<div class="form-group" style='margin:0!important'>

    <label for="{{ $name }}" class="control-label"
        style='margin-top:5px'>{{ $label }}</label>

    <div class="">


        <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

            <input type="text" id="{{ $name }}" name="{{ $name }}" wire:model="{{ $name }}"
                wire:model.blur="{{ $name }}" value="{{old($name)}}" class="form-control "
                @isset($disabled)
                    disabled
                @endisset
                placeholder="{{ $label }}">
        </div>
        @error($name)
            <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                {{ $message }}</label>
        @enderror

    </div>


</div>
