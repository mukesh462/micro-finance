<style>
    .container {
        max-width: 100%;
    }

    .search-btn {
        margin-top: 25px;
    }

    .select2 {
        width: 100%;
    }

    /* Estilo iOS */
    .switch__container {
        /* margin: 30px auto; */
        /* width: 120px; */
    }

    .switch {
        visibility: hidden;
        position: absolute;
        margin-left: -9999px;
    }

    .switch+label {
        display: block;
        position: relative;
        cursor: pointer;
        outline: none;
        user-select: none;
    }

    .switch--shadow+label {
        padding: 2px;
        width: 56px;
        height: 22px;
        background-color: #dddddd;
        border-radius: 60px;
    }

    .switch--shadow+label:before,
    .switch--shadow+label:after {
        display: block;
        position: absolute;
        top: 1px;
        left: 1px;
        bottom: 1px;
        content: "";
    }

    .switch--shadow+label:before {
        right: 1px;
        background-color: #f1f1f1;
        border-radius: 60px;
        transition: background 0.4s;
    }

    .switch--shadow+label:after {
        width: 22px;
        background-color: #fff;
        border-radius: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        transition: all 0.4s;
    }

    .switch--shadow:checked+label:before {
        background-color: #8ce196;
    }

    .switch--shadow:checked+label:after {
        transform: translateX(30px);
    }

    /* Estilo Flat */
    .switch--flat+label {
        padding: 2px;
        width: 120px;
        height: 60px;
        background-color: #dddddd;
        border-radius: 60px;
        transition: background 0.4s;
    }

    .switch--flat+label:before,
    .switch--flat+label:after {
        display: block;
        position: absolute;
        content: "";
    }

    .switch--flat+label:before {
        top: 2px;
        left: 2px;
        bottom: 2px;
        right: 2px;
        background-color: #fff;
        border-radius: 60px;
        transition: background 0.4s;
    }

    .switch--flat+label:after {
        top: 4px;
        left: 4px;
        bottom: 4px;
        width: 56px;
        background-color: #dddddd;
        border-radius: 52px;
        transition: margin 0.4s, background 0.4s;
    }

    .switch--flat:checked+label {
        background-color: #8ce196;
    }

    .switch--flat:checked+label:after {
        margin-left: 60px;
        background-color: #8ce196;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Select
                Center
            </label>
            <select name="" class="form-control" id="center_select">



            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Select
                Index
            </label>
            {{-- @php
                $getProduct = \App\Models\Product::get();
                @endphp --}}
            <select name="" class="form-control" id="index_select">
                <option selected>--- Select Index ---</option>
                {{-- @foreach($getProduct as $key => $value)
                    <option value='{{$value->id}}'>{{$value->index_no}}</option>
                @endforeach --}}

            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Total
                Memeber
            </label>
            <input type="text" class="form-control" disabled>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Total
                Amount
            </label>
            <input type="text" class="form-control" disabled>
        </div>
        <div class="col-12  col-md-3 col-lg-3">
            <label for="">Index
                Date
            </label>
            <input type="text" class="form-control" disabled>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Select
                Fund
            </label>
            <select name="" class="form-control" id="index_select">
                <option value="">Test</option>
                <option value="">Test</option>

            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Disbursal Type

            </label>
            <select name="" class="form-control" id="index_select">
                <option value="">Test</option>
                <option value="">Test</option>

            </select>
        </div>
        <div class="col-12  col-md-3 col-lg-3 search-btn">
            <button class="btn btn-info"><i class="fa fa-search"></i> Search</button>
            <button class="btn btn-warning"><i class="fa fa-reset"></i> Reset</button>
        </div>

    </div>

    <div class="table-responsive " style="margin-top: 50px;">
        <table class="table">
            <thead>
                <td>S.no</td>
                <td>Center </td>
                <td>Employee </td>
                <td>Member</td>
                <td>Product </td>
                <td> Purpose</td>
                <td> Product Amount</td>
                <td> Action</td>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Madutau</td>
                    <td>Raja</td>
                    <td>Ampala</td>
                    <td>Shaja</td>
                    <td>test</td>
                    <td>5220</td>
                    <td>
                        <div class="switch__container">
                            <input id="switch-shadow" class="switch switch--shadow" type="checkbox">
                            <label for="switch-shadow"></label>
                        </div>
                    </td>



                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"></td>
                    <td>45454</td>
                    <td colspan=""><button class="btn btn-warning">Submit</button></td>

                </tr>
            </tfoot>
        </table>
    </div>
</div>


<script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>
<script>
    const addSelectData = (id, type = "staff", data = {}) => {
        $("#" + id).select2({
            ajax: {
                url: "{{ route('get.data') }}"
                , dataType: "json"
                , delay: 250
                , data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page || 1, // page number
                        tp: type
                        , data
                    , };
                }
                , processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results
                        , pagination: {
                            more: params.page * 10 < data
                                .total_count, // Adjust the limit per page as needed
                        }
                    , };
                }
                , cache: true, // Enable caching on the client side
            }
            , minimumInputLength: 2
            , placeholder: "Select " + id,
            // templateResult: function (data) {
            //     if (!data.id) {
            //         return data.text;
            //     }
            //     var html = '<div >' + data.text + '</div>';
            //     html += '<div class="additional-attribute">' + data.value + '</div>';
            //     return $(html);
            // }

            // Other options...
        });
    };
    $('#center_select').on('change', function() {
        console.log($(this).val(), 'hkjh')
        $.ajax({
            url: "/get-data"
            , data: {
                id: $(this).val()
                , tp: 'index'
            }
            , success: function({
                results
            }) {
                $('#index_select').html('')
                results.forEach((e) => {
                    $('#index_select').append(`<option value='${e.id}'>${e.text}</option>`);
                })
            }
        });

    })
    addSelectData('center_select', 'center')

    $('#index_select').select2()

</script>
