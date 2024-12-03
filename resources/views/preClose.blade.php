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

<div class="box-header with-border">

    <div class="box-tools">
        <div class="btn-group pull-right" style="margin-right: 5px">
            <a href="/admin/foreclosureList" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
        </div>
    </div>
</div>

<div class="container">
    <div id="container">
        <form id="myForm" autocomplete="off">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="center" class="" id="center-error">Select Center
                    </label>
                    <select type="text" class="form-control select2" id="mySelect" placeholder="Select Center" name="center">
                        <!-- <option value="" disabled selected>Select an option...</option> -->
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="employee" class="" id="employee_error">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Employee Name" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="member_error">Select Member</label>
                    <select type="text" class="form-control" placeholder="Select Member" id="member_list" name="member">
                        <option aria-readonly="true" value="">---Select Member---</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="loan_error">Select Loan Acc No</label>
                    <select type="text" class="form-control" placeholder="Select Loan" id="loan_list" name="loan_id">
                        <option aria-readonly="true" value="">Select Loan Acc Number</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="Product-error">Disbursal Date</label>
                    <input type="text" class="form-control" id="disbursal_date" name="disbursal_date" placeholder="Disbursal Date" readonly disabled />
                </div>
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Amount</label>
                    <input type="text" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Interest</label>
                    <input type="text" class="form-control" id="loan_interest" name="loan_interest" placeholder="Loan Interest" readonly />
                </div>


                 <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Weeks</label>
                    <input type="text" class="form-control" id="due_weeks" name="collection_weeks" placeholder="Due Weeks" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">collected Weeks</label>
                    <input type="text" class="form-control" id="collected_weeks" name="collection_weeks" placeholder="collected Weeks" readonly />
                </div>

                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">O/S Loan Principle</label>
                    <input type="text" class="form-control" id="loan_outstanding_principle" name="loan_outstanding_principle" placeholder="Loan Outstanding" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">O/S Loan interest</label>
                    <input type="text" class="form-control" id="loan_outstanding_interest" name="loan_outstanding_interest" placeholder="Loan Outstanding" readonly />
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">To be collect Principle</label>
                    <input type="text" class="form-control" id="arr_price" name="arr_price" placeholder="Opening Arr. Price" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">To be collect Interest</label>
                    <input type="text" class="form-control" id="due_price" name="due_price" placeholder="Due Amount" readonly />
                </div> -->
                 <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">To be collect Total</label>
                    <input type="text" class="form-control" id="total_collect" name="total_collect" placeholder="Total collection" readonly />
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Interest</label>
                    <input type="text" class="form-control" id="due_int" name="due_int" placeholder="Due Interest" readonly />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Interest</label>
                    <input type="text" class="form-control" id="arr-int" placeholder="Opening Arr. Interest" readonly disabled />
                </div> -->


                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose" id="amount-error">Total Collected</label>
                    <input type="text" class="form-control total-amount-input" id="loan_collected" name="loan_collected" placeholder="Loan Collected" />
                    <!-- <input type="hidden" class="form-control" id="collection_id" name="collection_id" /> -->
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Collected</label>
                    <input type="text" class="form-control" id="total-collected" placeholder="Total Collected" readonly disabled />
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 addbtn" style="">
                    <button type="submit" id="add-btn" class="btn btn-primary mt-2 d-block">
                        <i class="fa fa-save"></i>&nbsp; Save
                    </button>
                    <button type="button" id="reset-btn" class="btn btn-warning mt-2 d-block">
                        <i class="fa fa-refresh"></i> Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
    <br />
    <!-- <button class="remove-btn">Remove</button> -->
</div>

<!-- <script src="/jquery/jquery.min.js"></script>
<script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script> -->

<script>
    $(document).ready(function() {
        $('.select2').select2();
        // $('#member_list').select2();

    });

    // Initialize Select2 with AJAX
    $(document).ready(function() {
        // Initialize Select2 with AJAX and pagination
        $('#mySelect').select2({
            placeholder: 'Search for Center',
            minimumInputLength: 1, // Minimum number of characters before making the AJAX call
            ajax: {
                url: '/admin/getCenter', // Replace with your actual API endpoint
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

    $('.total-amount-input').on('input', function() {
        var value = $(this).val();
        if (!/^\d*\.?\d{0,2}$/.test(value)) {
            $(this).val(value.slice(0, -1)); // remove last character if not valid
        }
    });

    $("#mySelect").on("change", function() {
        resetForm();
        // $(this).attr("disabled", true);
        center_id = $(this).val();
        if (center_id == null) {
            return;
        }
        let postData = {
            center_id: center_id,
        };

        // jQuery AJAX POST call
        $.ajax({
            url: '/admin/getDetails', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(postData), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {
                if (data.results.member.length > 0) {
                    $.each(data.results.member, function(index, option) {
                        $('#member_list').append($('<option>', {
                            value: option.id,
                            text: option.client_name
                        }));
                    });
                } else {
                    var selectElement = $('#member_list');
                    // Remove all existing options
                    selectElement.find('option[value!=""]').remove();
                    toastr.error('No Member found');
                }
                if (data.results.employee != null) {
                    $('#employee_name').val(data.results.employee.staff_name);
                }
                $('#disbursal_date').val('')
                $('#loan_amount').val('')
                $('#loan_interest').val('')
                $('#due_weeks').val('')
                $('#collected_weeks').val('')
                $('#loan_outstanding_principle').val('')
                $('#loan_outstanding_interest').val('')
                $('#total_collect').val('')
                $('#loan_collected').val('')
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });

        // addSelectData("Center", "center", {
        //     id: $(this).val(),
        // });
    });
    $("#member_list").on("change", function() {
        // $(this).attr("disabled", true);
        let member_id = $(this).val();
        console.log(member_id, "ihhxgfh");
        let postData = {
            member_id: member_id,
        };
        // jQuery AJAX POST call
        $.ajax({
            url: '/admin/getLoan', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(postData), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {
                if (data.results.loan.length > 0) {
                    var loanElement = document.getElementById("loan_list");
                    var emptyLoan = loanElement.querySelector('option[value=""]');
                    var clonedEmptyLoan = emptyLoan.cloneNode(true);
                    loanElement.innerHTML = ''; // Clear all options
                    loanElement.appendChild(clonedEmptyLoan);
                    $.each(data.results.loan, function(index, option) {
                        $('#loan_list').append($('<option>', {
                            value: option.id,
                            text: option.loan_no
                        }));
                    });
                } else {
                    var selectElement = $('#loan_list');
                    // Remove all existing options
                    selectElement.find('option[value!=""]').remove();
                    toastr.error('No Loan found');
                    $('#disbursal_date').val('')
                    $('#loan_amount').val('')
                    $('#loan_interest').val('')
                    $('#due_weeks').val('')
                    $('#collected_weeks').val('')
                    $('#loan_outstanding_principle').val('')
                    $('#loan_outstanding_interest').val('')
                    $('#total_collect').val('')
                    $('#loan_collected').val('')
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });

        // addSelectData("Center", "center", {
        //     id: $(this).val(),
        // });
    });
    $("#loan_list").on("change", function() {
        // $(this).attr("disabled", true);
        let loan_id = $(this).val();
        if(loan_id) {

        let postData = {
            loan_id: loan_id,
        };
        // jQuery AJAX POST call
        $.ajax({
            url: '/admin/getLoanForeclose', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(postData), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {
                console.log(data, "loan")
                if (data.message == "data Found") {
                    $('#disbursal_date').val(data.results.loan.dis_date)
                    $('#loan_amount').val(data.results.loan.loan_amount)
                    $('#loan_interest').val(data.results.loan.loan_interest)
                    $('#due_weeks').val(data.results.due_collection.length)
                    $('#collected_weeks').val(data.results.collected_collection.length)
                    $('#loan_outstanding_principle').val(data.results.total_collection_amount)
                    $('#loan_outstanding_interest').val(data.results.total_collection_interest)
                    $('#total_collect').val(data.results.total_amount_collect)
                    $('#loan_collected').val(data.results.total_amount_collect)

                } else {
                    toastr.error(data.message);
                    document.getElementById("myForm").reset()
                    var centerElement = $('#mySelect');
                    // Programmatically remove the selected option
                    centerElement.val(null).trigger('change');
                    resetForm();
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });

    }else {
        $('#disbursal_date').val('')
        $('#loan_amount').val('')
        $('#loan_interest').val('')
        $('#due_weeks').val('')
        $('#collected_weeks').val('')
        $('#loan_outstanding_principle').val('')
        $('#loan_outstanding_interest').val('')
        $('#total_collect').val('')
        $('#loan_collected').val('')
    }
    });

    function displayValidationMessage(id, message, color) {
        $('#' + id).text(message).css('color', color);
    }

    $('#myForm').submit(function(event) {

        // Prevent the default form submission
        event.preventDefault();
        $("#add-btn").prop("disabled", true);
        //  console.log(event)
        // Perform validation
        // var name = $('input[name="name"]').val();
        // var email = $('input[name="email"]').val();
        let center = $('#mySelect').val();
        if (center == "" || center == null) {
            $('#center-error').text('');
            displayValidationMessage('center-error', "Select center", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('center-error', "Select center", 'black');
        }

        let member = $('#member_list').val();
        if (member == "" || member == null) {
            $('#member_error').text('');
            displayValidationMessage('member_error', "Select Member", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('member_error', "Select Member", 'black');
        }
        let loan = $('#loan_list').val();
        if (loan == "" || loan == null) {
            $('#loan_error').text('');
            displayValidationMessage('loan_error', "Select Loan Acc No", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('loan_error', "Select Loan Acc No", 'black');
        }

        // let colection = $('#collection-type').val();
        // if (colection == "" || colection == null) {
        //     $('#collection-error').text('');
        //     displayValidationMessage('collection-error', "Select Collection Type", 'red');
        //     $("#add-btn").prop("disabled", false);
        //     return;
        // } else {
        //     displayValidationMessage('collection-error', "Select Collection Type", 'black');
        // }

        let collected = $('#loan_collected').val();
        if (collected == "" || collected == null) {
            $('#amount-error').text('');
            displayValidationMessage('amount-error', "Enter Collected Amount", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('amount-error', "Loan Collected", 'black');
        }

        // console.log('hiiiiiiiiiiiiii')

        var formData = new FormData(document.getElementById("myForm"));
        var jsonObject = {};
        formData.forEach(function(value, key) {
            jsonObject[key] = value;
        });
        console.log(jsonObject, "formdata")

        $.ajax({
            url: '/admin/createPreclose', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(jsonObject), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {
                // console.log('data', data)
                if (data.message == "Loan Foreclose request updated successfully.") {
                    toastr.success(data.message);
                    document.getElementById("myForm").reset()
                    var centerElement = $('#mySelect');
                    centerElement.val(null).trigger('change');
                    resetForm();

                    $("#add-btn").prop("disabled", false);
                } else {
                    toastr.error(data.message);
                    $("#add-btn").prop("disabled", false);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });
    });
    $('#reset-btn').click(function() {
        document.getElementById("myForm").reset()
        var centerElement = $('#mySelect');
        // Programmatically remove the selected option
        centerElement.val(null).trigger('change');
        resetForm();
        //   window.location.reload();
        // $('#myForm')[0].reset(); // Reset the form
    });

    function resetForm() {
        var selectElement = document.getElementById("member_list");
        var emptyOption = selectElement.querySelector('option[value=""]');
        var clonedEmptyOption = emptyOption.cloneNode(true);
        selectElement.innerHTML = ''; // Clear all options
        selectElement.appendChild(clonedEmptyOption);
        var loanElement = document.getElementById("loan_list");
        var emptyLoan = loanElement.querySelector('option[value=""]');
        var clonedEmptyLoan = emptyLoan.cloneNode(true);
        loanElement.innerHTML = ''; // Clear all options
        loanElement.appendChild(clonedEmptyLoan);
    }
</script>
