<div class="form-group  @error($name) has-error  @enderror " style='margin:0!important'>

    <label for="{{ $name }}" class=" {{ isset($isRequired) ? 'asterisk' : '' }}  control-label"
        style='margin-top:5px'>{{ $label }}</label>

    <div class="">


        <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

            <input type="text" id="{{ $name }}" name="{{ $name }}" wire:model="{{ $name }}"
                value="" class="form-control " placeholder="{{ $label }}">
        </div>
        @error($name)
            <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                {{ $message }}</label>
        @enderror

    </div>
    {{-- <div class="col-sm-8">

            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> The Member name field is
                required.</label><br>

            <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                <input type="text" id="client_name" name="client_name" value=""
                    class="form-control client_name" placeholder="Input Member name">



            </div>


        </div> --}}

</div>
