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



<div class="container">
    <div id="container">
        <form id="myForm">
            <div class="row">

            <div class="col-12 col-md-4 col-lg-4 mb">

      <label for="datepicker">Select Date:</label>
      <input type="text" class="form-control" id="datepicker" placeholder="Select date">
    </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="center" class="" id="center-error">Select Center
                    </label>
                    <select type="text" class="form-control select2" id="mySelect" placeholder="Select Center" name="center">
                        <!-- <option value="" disabled selected>Select an option...</option> -->
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="employee" class="" id="employee_error">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" placeholder="Employee Name" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="member_error">Select Member</label>
                    <select type="text" class="form-control" placeholder="Select Member" id="member_list" name="member">
                        <option aria-readonly="true" value="">Select Member</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="loan_error">Select Loan Acc No</label>
                    <select type="text" class="form-control" placeholder="Select Loan" id="loan_list">
                        <option aria-readonly="true" value="">Select Loan Acc Number</option>
                        <option  value="2">Example</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="Product-error">Disbursal Date</label>
                    <input type="text" class="form-control" id="purpose" placeholder="Disbursal Date" readonly disabled />
                </div>

                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Amount</label>
                    <input type="text" class="form-control" id="loan-amount" placeholder="Loan Amount" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Weeks</label>
                    <input type="text" class="form-control" id="loan-amount" placeholder="Due Weeks" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Collection Weeks</label>
                    <input type="text" class="form-control" id="collection-Weeks" placeholder="Collection Weeks" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Price</label>
                    <input type="text" class="form-control" id="arr-price" placeholder="Opening Arr. Price" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Interest</label>
                    <input type="text" class="form-control" id="arr-int" placeholder="Opening Arr. Interest" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Outstanding</label>
                    <input type="text" class="form-control" id="loan-outstanding" placeholder="Loan Outstanding" readonly disabled />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="collection-type" id="collection-error">Collection Type</label>
                    <select type="text" class="form-control" id="collection-type" placeholder="Collection Type">
                        <option value="">Collection Type</option>
                        <option value="Cash in hand">Cash in hand</option>
                        <option value="Bank">Bank</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose" id="amount-error">Loan Collected</label>
                    <input type="text" class="form-control" id="loan-collected" placeholder="Loan Collected" />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Collected</label>
                    <input type="text" class="form-control" id="total-collected" placeholder="Total Collected" readonly disabled />
                </div>
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
        $('#datepicker').datepicker();  
    });

    // Initialize Select2 with AJAX
    $(document).ready(function() {
        // Initialize Select2 with AJAX and pagination
        $('#mySelect').select2({
            placeholder: 'Search for Center',
            minimumInputLength: 3, // Minimum number of characters before making the AJAX call
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

    $("#mySelect").on("change", function() {
        // $(this).attr("disabled", true);
        center_id = $(this).val();
        console.log(center_id, "ihhxgfh");
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
                }
                if (data.results.employee != null) {
                    $('#employee_name').val(data.results.employee.staff_name);
                }
                console.log(data, "respo")
                // Handle successful response
                // $('#result').text(JSON.stringify(data, null, 2));
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

    function displayValidationMessage(id, message, color) {
        $('#' + id).text(message).css('color', color);
    }

    $('#myForm').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();
        //  console.log(event)
        // Perform validation
        // var name = $('input[name="name"]').val();
        // var email = $('input[name="email"]').val();
        let center = $('#mySelect').val();
        if (center == "" || center == null) {
            $('#center-error').text('');
            displayValidationMessage('center-error',"Select center", 'red');
            return;
        }else
        {
            displayValidationMessage('center-error',"Select center", 'black');
        }

        let member = $('#member_list').val();
        if (member == "" || member == null) {
            $('#member_error').text('');
            displayValidationMessage('member_error',"Select Member", 'red');
            return;
        }else
        {
            displayValidationMessage('member_error',"Select Member", 'black');
        }
        let loan = $('#loan_list').val();
        if (loan == "" || loan == null) {
            $('#loan_error').text('');
            displayValidationMessage('loan_error',"Select Loan Acc No", 'red');
            return;
        }else
        {
            displayValidationMessage('loan_error',"Select Loan Acc No", 'black');
        }

        let colection = $('#collection-type').val();
        if (colection == "" || colection == null) {
            $('#collection-error').text('');
            displayValidationMessage('collection-error',"Select Collection Type", 'red');
            return;
        }else
        {
            displayValidationMessage('collection-error',"Select Collection Type", 'black');
        }

        let collected = $('#loan-collected').val();
        if (collected == "" || collected == null) {
            $('#amount-error').text('');
            displayValidationMessage('amount-error',"Enter Collected Amount", 'red');
            return;
        }else
        {
            displayValidationMessage('amount-error',"Loan Collected", 'black');
        }
        // if (name === '' || email === '') {
        //     alert('Please fill in all fields.');
        //     return false; // Prevent form submission
        // }

        // If validation passes, submit the form
        // You can add additional validation checks here if needed

        // Submit the form
        // this.submit();
    });
    $('#reset-btn').click(function() {
          window.location.reload();
        // $('#myForm')[0].reset(); // Reset the form
    });
</script>
