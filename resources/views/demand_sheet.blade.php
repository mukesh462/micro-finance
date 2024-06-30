<!-- <link href="{{ asset('/select2/dist/css/select2.min.css') }}" rel="stylesheet" /> -->

<style>
    .addbtn {
        margin-top: 25px;
    }

    .select2 {
        width: 100% !important;
    }

    .mb {
        margin-bottom: 10px;
    }

    .container {
        max-width: 100%;
    }
</style>


<form id="myForm" action="/admin/getDemandSheet" method="post">
@if ($errors->any())
        <div class="alert alert-danger">

                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach

        </div>
    @endif
    <div class="box-header with-border">
        <h3 class="box-title">Demand Sheet</h3>

        <!-- <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 5px">
                <a href="/admin/collectionsList" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
            </div>
        </div> -->
    </div>
    <div class="container">
        <div id="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-4 mb">

                    <label for="datepicker">Demand Date:</label>
                    <input type="text" class="form-control" id="datepicker" name="due_date" placeholder="Select date">
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="employee" class="" id="employee-error">Select Employee
                    </label>
                    <select type="text" class="form-control select2" id="mySelect1" placeholder="Select Employee" name="employee">
                        <!-- <option value="" disabled selected>Select an option...</option> -->
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="center" class="" id="center-error">Select Center
                    </label>
                    <select type="text" class="form-control select2" id="mySelect" placeholder="Select Center" name="center">
                        <!-- <option value="" disabled selected>Select an option...</option> -->
                    </select>
                </div>

                @csrf
            </div>
        </div>
        <br />
        <div class="col-12 col-md-4 col-lg-4 addbtn">
            <button type="submit" id="add-btn" class="btn btn-primary mt-2 d-block">
                <i class="fa fa-save"></i>&nbsp; Show
            </button>
            <button type="button" id="reset-btn" class="btn btn-warning mt-2 d-block">
                <i class="fa fa-refresh"></i> Reset
            </button>

        </div>
        <!-- <button class="remove-btn">Remove</button> -->
    </div>
    <div class="box-body table-responsive no-padding table-view container" style="background-color: #fff">



    </div>

</form>

<!-- <script src="/jquery/jquery.min.js"></script>
<script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script> -->

<script>
    let collection = [];

    $(document).ready(function() {
        $('.select2').select2();
        // $('#datepicker').datepicker();
        var currentDate = new Date();
        var day = ("0" + currentDate.getDate()).slice(-2); // Zero-padding the day
        var month = ("0" + (currentDate.getMonth() + 1)).slice(-2); // Zero-padding the month
        var year = currentDate.getFullYear();

        var formattedDate = day + '-' + month + '-' + year;
        //     var currentDate = new Date();
        //   var formattedDate = currentDate.getDate() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getFullYear();
        //   $('#datepicker').datepicker({
        //     dateFormat: 'dd-mm-yy', // Set the date format
        //     defaultDate: formattedDate // Set the default date in the desired format
        //   });
        // $('#datepicker').val(formattedDate);
        // console.log(formattedDate, "formatted")

        var today = moment().startOf('day');

        $('#datepicker').val(today.format('DD-MM-YYYY')).datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: today,
            useCurrent: true // Sets the current date as default
        });
        $('#datepicker').on('keydown', function(e) {
            e.preventDefault();
        });
        $('#datepicker').on('dp.change', function(e) {
            let defaultRow = $('#data-table tbody #default-row').detach();
            clearForm();
            $('#data-table tbody').append(defaultRow);
            $('#total-collected-amount').text(0);
        });
    });
    $(document).on('change', 'input[type="checkbox"]', function() {
        var checkboxValue = $(this).val();
        var amountInput = $(this).closest('tr').find('.total-amount-input');
        var amount = parseFloat(amountInput.val());
        if (this.checked) {
            collection.push(checkboxValue);
            updateTotalAmount(amount, true);
            amountInput.prop('readonly', true);
            // Checkbox is checked, get its value
            // console.log('Checkbox with value ' + checkboxValue + ' is checked.');
            // console.log(collection, "cc")
            // Perform any actions you need with the checkbox value
        } else {
            var index = collection.indexOf(checkboxValue);
            if (index !== -1) {
                collection.splice(index, 1);
            }
            updateTotalAmount(amount, false);
            amountInput.prop('readonly', false);
            // console.log('Checkbox with value ' + checkboxValue + ' is unchecked.');
            // Checkbox is unchecked
            // console.log('Checkbox ' + checkboxValue + ' is unchecked.');
            // console.log(collection, "cs")
        }
    });

    function updateTotalAmount(amount, isAdding) {
        var total = parseFloat($('#total-collected-amount').text()) || 0;
        if (isAdding) {
            total += amount;
        } else {
            total -= amount;
        }
        $('#total-collected-amount').text(total.toFixed(2));
    }

    // Initialize Select2 with AJAX
    $(document).ready(function() {
        // Initialize Select2 with AJAX and pagination
        $('#mySelect1').select2({
            placeholder: 'Search for Employee',
            minimumInputLength: 1, // Minimum number of characters before making the AJAX call
            ajax: {
                url: '/admin/getEmployees', // Replace with your actual API endpoint
                dataType: 'json',
                delay: 250, // Delay in milliseconds before making the request
                data: function(params) {
                    return {
                        q: params.term, // Search term
                        page: params.page || 1 // Page number (initialize to 1)
                    };
                },
                processResults: function(data, params) {
                    // Format the data as Select2 expects
                    var more = (params.page * 10) < data.total_count; // Adjust 10 based on your API's page size
                    var formattedResults = data.results.map(function(item) {
                        return {
                            id: item.id,
                            text: "00" + item.id + "-" + item.staff_name // adjust the property names accordingly
                        };
                    });
                    return {
                        results: formattedResults,
                        pagination: {
                            more: params.page * 10 < data.total_count
                        }
                    };
                },
                templateResult: function(data) {
                    // Custom template for results
                    if (data.loading) {
                        return result.text;
                    }
                    return 'No Employee found';
                },

                cache: true // Cache AJAX requests for faster results
            }
        });
        $('#mySelect').select2({
            placeholder: 'Search for Center',
            minimumInputLength: 1, // Minimum number of characters before making the AJAX call
            ajax: {
                url: '/admin/getCenterByEmployee', // Replace with your actual API endpoint
                dataType: 'json',
                delay: 250, // Delay in milliseconds before making the request
                data: function(params) {
                    var employee_id = $('#mySelect1').val();
                    if (employee_id == null) {
                        console.log(employee_id, "emp")

                        // If the search term is too short, return an empty object
                        return null;
                    }
                    return {
                        q: params.term, // Search term
                        page: params.page || 1, // Page number (initialize to 1)
                        employee_id: employee_id
                    };
                },
                transport: function(params, success, failure) {
                    if (params.data === null) {
                        alert("Select Employee");
                        // Do not proceed with the AJAX request
                        return;
                    }
                    var $request = $.ajax(params);
                    $request.then(success);
                    $request.fail(failure);
                    return $request;
                },
                processResults: function(data, params) {
                    // Format the data as Select2 expects
                    var more = (params.page * 10) < data.total_count; // Adjust 10 based on your API's page size
                    var formattedResults = data.results.map(function(item) {
                        return {
                            id: item.id,
                            text: item.center_name // adjust the property names accordingly
                        };
                    });
                    return {
                        results: formattedResults,
                        pagination: {
                            more: params.page * 10 < data.total_count
                        }
                    };
                },
                templateResult: function(data) {
                    // Custom template for results
                    if (data.loading) {
                        return result.text;
                    }
                    return 'No Center found';
                },

                cache: true // Cache AJAX requests for faster results
            }
        });
    });

    $('#mySelect1').on("change", function() {
        clearForm();
    })

    function clearForm() {
        var centerElement = $('#mySelect');
        centerElement.val(null).trigger('change');
        // $('#data-table tbody').empty();
        // $('#total_demand').val('')
        // $('#loan_outstanding').val('')
        // $('#total-amount').val('')
        // $('#arr-int').val('')
        // $('#total_members').val('')
        // collection = [];
    }

    function displayValidationMessage(id, message, color) {
        $('#' + id).text(message).css('color', color);
    }

    $('#myForm').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();
        //  console.log(event)
        // $("#add-btn").prop("disabled", true);

        let employee = $('#mySelect1').val();
        if (employee == "" || employee == null) {
            $('#employee-error').text('');
            displayValidationMessage('employee-error', "Select Employee", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('center-error', "Select Employee", 'black');
        }

        let center = $('#mySelect').val();
        if (center == "" || center == null) {
            $('#center-error').text('');
            displayValidationMessage('center-error', "Select Center", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('center-error', "Select Center", 'black');
        }


        var formData = new FormData(document.getElementById("myForm"));
        var jsonObject = {};
        formData.forEach(function(value, key) {
            jsonObject[key] = value;
        });
        jsonObject['collection'] = collection;
        console.log(jsonObject, "formdata")
        document.getElementById("myForm").submit();

    });
    $('#reset-btn').click(function() {
        window.location.reload();
        // $('#myForm')[0].reset(); // Reset the form
    });
</script>
