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

    .checkAll {
        display: flex;
        gap: 5px;
        align-items: flex-start;
        justify-content: center;
    }
</style>
<!-- base model -->
<div class="bs-example">

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are you sure want to Reset
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <i class="fa fa-info-circle" style="margin-right: 2px"></i>
                        All Change should be clear
                        automatically
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" id="rest-form" class="btn btn-primary">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- final -->
<div class="bs-example">

    <div id="final" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Warning
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <i class="fa fa-info-circle" style="margin-right: 2px"></i>
                        Are you sure want Proceed
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <form style="display: inline;" action="{{admin_url('loan_disbrusment')}}" method="post">
                        <input type="hidden" name="data" id="sendVal">
                        @csrf
                        <button id="" class="btn btn-primary">
                            Ok
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 col-lg-3">
            <label for="" id="Center-error">Select
                Center
            </label>
            <select name="" class="form-control" id="Center">



            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="" id="Index-error">Select
                Index
            </label>
            {{-- @php
            $getProduct = \App\Models\Product::get();
            @endphp --}}
            <select name="" class="form-control" id="Index">
                <option value='' disabled>--- Select Index ---</option>
                {{-- @foreach ($getProduct as $key => $value)
                <option value='{{$value->id}}'>{{$value->index_no}}</option>
                @endforeach --}}

            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Total
                Memeber
            </label>
            <input type="text" class="form-control" id='total_member' disabled>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Total
                Amount
            </label>
            <input type="text" class="form-control total_amount" id='' disabled>
        </div>
        <div class="col-12  col-md-3 col-lg-3">
            <label for="">Index
                Date
            </label>
            <input type="text" class="form-control" id='index_date' disabled>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Select
                Fund
            </label>
            <select name="" class="form-control" id="">
                <option value="Own">Own</option>
                <option value="Lease">Lease</option>

            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
            <label for="">Disbursal Type

            </label>
            <select name="" class="form-control" id="">
                <option value="">Bank</option>
                <option value="">Cash In Hand</option>

            </select>
        </div>
        <div class="col-12  col-md-3 col-lg-3 search-btn">
            <button class="btn btn-info" id='search-btn' type='button' onclick='submitBtn()'><i
                    class="fa fa-search"></i> Search</button>
            <button class="btn btn-warning" id="rest-btn"><i class="fa fa-reset"></i> Reset</button>
        </div>

    </div>

    <div class="table-responsive " style="margin-top: 50px;display:none" id="table_handle">
        <table class="table">
            <thead>
                <td>S.no</td>
                <td>Center </td>
                <td>Employee </td>
                <td>Member</td>
                <td>Product </td>
                <td> Purpose</td>
                <td> Product Amount</td>
                <td class="checkAll"> Check All <input type="checkbox" id="masterCheckbox" /></td>
            </thead>
            <tbody id='list-table'>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"></td>
                    <td class="total">0</td>
                    <td colspan=""><button class="btn btn-warning" onclick='showSelectedData()'>Submit</button></td>

                </tr>
            </tfoot>
        </table>
    </div>
</div>


<script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>
<script>
    var center = $("#Center");
    var index = $("#Index");
    const submitBtn = () => {

        //  console.log(index, ' in ')
        //    var member = $("#Member").val();
        //  var plan = $("#Product").val(); 
        //   var purpose = $("#purpose").val();
        //   var amount = $("#product_amount").val();

        // console.log(employee, 'emp');
        const valObj = [{
            value: center.val(),
            id: "Center",
        },

        {
            value: index.val(),
            id: "Index",
        }
        ];
        console.log(checkField(valObj), 'jgyguyyg');
        if (checkField(valObj)) {
            $('.total').text($('.total_amount').val())

            center.attr('disabled', true)
            index.attr('disabled', true)
            $.ajax({
                url: "/get-data",
                data: {
                    id: index.val(),
                    tp: 'index_member'
                },
                success: function ({
                    results
                }) {
                    $('#list-table').html('')
                    results.forEach((dat, i) => {
                        const rowData = `<tr>
                    <td>${i + 1}</td>
                    <td>${dat.center_name}</td>
                    <td>${dat.employee_name}</td>
                    <td>${dat.member_name}</td>
                    <td>${dat.product_name}</td>
                    <td>${dat.loan_purpose}</td>
                    <td>${dat.plan_amount}</td>
                    <td>
                        <div class="switch__container">
                            <input id="switch-shadow${i * 45}" class="switch switch--shadow selected_value" value='${JSON.stringify(dat)}' type="checkbox">
                            <label for="switch-shadow${i * 45}"></label>
                        </div>
                    </td>



                </tr>`
                        $('#list-table').append(rowData)
                    })

                }
            });
            $('#table_handle').show()
        }
    }
    const addSelectData = (id, type = "staff", data = {}) => {
        $("#" + id).select2({
            ajax: {
                url: "{{ route('get.data') }}",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page || 1, // page number
                        tp: type,
                        data,
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: params.page * 10 < data
                                .total_count, // Adjust the limit per page as needed
                        },
                    };
                },
                cache: true, // Enable caching on the client side
            },
            minimumInputLength: 2,
            placeholder: "Select " + id,
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

    $('#Center').on('change', function () {
        console.log($(this).val(), 'hkjh')
        if ($(this).val() != '') {
            $.ajax({
                url: "/get-data",
                data: {
                    id: $(this).val(),
                    tp: 'index'
                },
                success: function ({
                    results
                }) {
                    console.log(results, 'sss')
                    $('#Index').html('')
                    $('#Index').append(
                        ' <option value="" disabled selected>--- Select Index ---</option>')
                    results.forEach((e) => {
                        $('#Index').append(
                            `<option data-value='${JSON.stringify(e)}' value='${e.id}'>${e.index_no}</option>`
                        );
                    })
                }
            });

        }

    })
    addSelectData('Center', 'center')
    const checkField = (data) => {

        data.forEach((element) => {
            // console.log(element.value, 'sdsds');
            if (element.value == "" || element.value == null) {
                // console.log(member);
                dispalyErrorMessage(element.id);

            }
        });;
        return data.every(e => e.value === "" || e.value !== null);

    };
    const removeError = (e) => {
        console.log(e.id, "sdsds");

        $("#" + e.id + "-error").css({
            color: "black",
        });
        $("#" + e.id + "-error").text("Select " + e.id);
    };
    var dispalyErrorMessage = (errorMessageId) => {
        var errorMessageNewId = "#" + errorMessageId;
        $(errorMessageNewId + "-error").css({
            color: "red",
        });
        console.log(errorMessageId, "erferf");

        $(errorMessageNewId + "-error").text(
            "Select  " + errorMessageId + " is required"
        );
    };
    $('#Index').select2()
    $('#Index').on('change', function () {
        console.log($(this).val(), 'value')
        if ($(this).val() != '' && $(this).val() != null) {
            const selectedVal = JSON.parse($(this).find(':selected').attr('data-value'));
            console.log($(this).find(':selected').attr('data-value'), 'seleceted');
            $('#index_date').val(selectedVal.index_date);
            $('#total_member').val(selectedVal.total_member);
            $('.total_amount').val(selectedVal.total_amount);


        }


    })
    $(document).on("select2:open", (e) => {
        removeError(e.target);
        // console.log(e.target.id, 'sffsfsf');
        document
            .querySelector(
                ".select2-container--open .select2-search__field"
            )
            .focus();
    });
    $('#rest-form').on('click', function () {
        $('#table_handle').hide()

        center.removeAttr('disabled')
        index.removeAttr('disabled')
        $('#Center').val(null).trigger('change');
        $('#Index').val(null).trigger('change');
        $('#index_date').val('');
        $('#total_member').val('');
        $('.total_amount').val('');
        $("#myModal").modal("hide");
        $('#list-table').html('')
        $('.total').text('0')


    })
    $("#rest-btn").click(function () {
        $("#myModal").modal("show");
    });
    const showSelectedData = () => {
        var selectedValues = []; // Array to store the selected checkbox values

        // Loop through each checkbox with class 'checkbox'
        $('.selected_value').each(function () {
            // Check if the checkbox is checked
            if ($(this).is(':checked')) {
                // If checked, add its value to the selectedValues array
                selectedValues.push(JSON.parse($(this).val()));
            }
        });
        if (selectedValues.length == 0) {
            toastr.error('Need to Approve Atleast one Employee ')
            return;

        } else {
            $('#sendVal').val(JSON.stringify(selectedValues))
            $('#final').modal('show')
        }

        // Display the selected values
        console.log(selectedValues, 'dada')
    }
    $('#masterCheckbox').click(function () {
        // Check if the master checkbox is checked
        var isChecked = $(this).is(':checked');

        // Set all other checkboxes to the same state as the master checkbox
        $('.selected_value').prop('checked', isChecked);
    });
</script>