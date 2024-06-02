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


<form id="myForm">
    <div class="box-header with-border">
        <h3 class="box-title">Multiple Collection</h3>

        <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 5px">
                <a href="/admin/collectionsList" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="container">
            <div class="row">

                <div class="col-12 col-md-4 col-lg-4 mb">

                    <label for="datepicker">Due Date:</label>
                    <input type="text" class="form-control" id="datepicker" name="due_date" placeholder="Select date" readonly>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="center" class="" id="center-error">Select Center
                    </label>
                    <select type="text" class="form-control select2" id="mySelect" placeholder="Select Center" name="center">
                        <!-- <option value="" disabled selected>Select an option...</option> -->
                    </select>
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="collection-type" id="collection-error">Collection Type</label>
                    <select type="text" class="form-control" id="collection-type" placeholder="Collection Type">
                        <option value="">Collection Type</option>
                        <option value="Cash in hand">Cash in hand</option>
                        <option value="Bank">Bank</option>
                    </select>
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="employee" class="" id="employee_error">Total Members</label>
                    <input type="text" class="form-control" id="total_members" placeholder="Total Members" readonly />
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
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
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan O/S</label>
                    <input type="text" class="form-control" id="loan_outstanding" placeholder="Loan Outstanding" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arrear</label>
                    <input type="text" class="form-control" id="arr-int" placeholder="Opening Arrear" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Collection</label>
                    <input type="text" class="form-control" id="total-amount" placeholder="Total Collection" readonly />
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Weeks</label>
                    <input type="text" class="form-control" id="loan-amount" placeholder="Due Weeks" readonly disabled />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Collection Weeks</label>
                    <input type="text" class="form-control" id="collection-Weeks" placeholder="Collection Weeks" readonly disabled />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Price</label>
                    <input type="text" class="form-control" id="arr-price" placeholder="Opening Arr. Price" readonly disabled />
                </div> -->

                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Outstanding</label>
                    <input type="text" class="form-control" id="loan-outstanding" placeholder="Loan Outstanding" readonly disabled />
                </div> -->

                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose" id="amount-error">Loan Collected</label>
                    <input type="text" class="form-control" id="loan-collected" placeholder="Loan Collected" />
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Demand</label>
                    <input type="text" class="form-control" id="total_demand" placeholder="Total Demand" readonly />
                </div>

            </div>
        </div>
        <br />
        <!-- <button class="remove-btn">Remove</button> -->
    </div>
    <div class="box-body table-responsive no-padding table-view container" style="background-color: #fff">
        <table id="data-table" class="table table-hover grid-table">
            <thead>
                <tr>
                    <th>Member Id</th>
                    <th>Member Name</th>
                    <!-- <th>Employee</th> -->
                    <th>Loan Amount</th>
                    <th>Loan O/S </th>
                    <th>opening.Arr</th>
                    <th>Current Due Amount</th>
                    <th>Total Amount</th>
                    <th>Collected</th>
                    <th>Present</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Table body content will be inserted dynamically -->
            </tbody>

        </table>
        <div class="col-12 col-md-4 col-lg-4 addbtn">
            <button type="submit" id="add-btn" class="btn btn-primary mt-2 d-block">
                <i class="fa fa-save"></i>&nbsp; Save
            </button>
            <button type="button" id="reset-btn" class="btn btn-warning mt-2 d-block">
                <i class="fa fa-refresh"></i> Reset
            </button>
        </div>
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
        $('#datepicker').val(formattedDate);
        // console.log(formattedDate, "formatted")
    });
    $(document).on('change', 'input[type="checkbox"]', function() {
        var checkboxValue = $(this).val();
        if (this.checked) {
            collection.push(checkboxValue);
            // Checkbox is checked, get its value
            // console.log('Checkbox with value ' + checkboxValue + ' is checked.');
            // console.log(collection, "cc")
            // Perform any actions you need with the checkbox value
        } else {
            var index = collection.indexOf(checkboxValue);
            if (index !== -1) {
                collection.splice(index, 1);
            }
            // console.log('Checkbox with value ' + checkboxValue + ' is unchecked.');
            // Checkbox is unchecked
            // console.log('Checkbox ' + checkboxValue + ' is unchecked.');
            // console.log(collection, "cs")
        }
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
        if (center_id == null || center_id == "") {
            return;
        }
        // console.log(center_id, "ihhxgfh");
        let postData = {
            center_id: center_id,
            date: $('#datepicker').val()
        };

        // jQuery AJAX POST call
        $.ajax({
            url: '/admin/getMultipleDetails', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(postData), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {

                // console.log(data, 'collection list')
                if (data.results.collections.length > 0) {
                    $('#data-table tbody').empty();
                    $('#total_demand').val(data.results.total_demand)
                    $('#loan_outstanding').val(data.results.loan_outstanding)
                    $('#total-amount').val(data.results.total_amount)
                    $('#arr-int').val(data.results.total_balance)
                    $('#total_members').val(data.results.collections.length)
                    for (let i = 0; i < data.results.collections.length; i++) {
                        var newRow = '<tr>' +
                            '<td>' + data.results.collections[i].member.id + '</td>' +
                            '<td>' + data.results.collections[i].member.client_name + '</td>' +
                            '<td>' + data.results.collections[i].loan.loan_amount + '</td>' +
                            '<td>' + data.results.collections[i].loan.outstanding_amount + '</td>' +
                            '<td>' + data.results.collections[i].balance_amount + '</td>' +
                            '<td>' + data.results.collections[i].collection_amount + '</td>' +
                            '<td>' + data.results.collections[i].total_amount + '</td>' +
                            '<td><input type="text" name="total_amount_' + data.results.collections[i].id + '" value="' + data.results.collections[i].total_amount + '" data-min=0 data-max="' + data.results.collections[i].total_amount + '" class="total-amount-input"></td>' +
                            '<td><input type="checkbox" name="checkbox_' + data.results.collections[i].id + '" value="' + data.results.collections[i].id + '"></td>' +
                            '</tr>';
                        $('#data-table tbody').append(newRow);
                    }
                    $('.total-amount-input').on('input', function() {
                        var value = $(this).val();
                        var max = parseFloat($(this).data('max'));
                        if (!/^\d*\.?\d{0,2}$/.test(value)) {
                            $(this).val(value.slice(0, -1)); // remove last character if not valid
                        } else if (parseFloat(value) > max) {
                            $(this).val(max); // set to max if value exceeds max
                        }
                    });
                } else {
                    toastr.error("No collection to pay");
                    clearForm();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });
    });

    function clearForm() {
        var centerElement = $('#mySelect');
        centerElement.val(null).trigger('change');
        $('#data-table tbody').empty();
        $('#total_demand').val('')
        $('#loan_outstanding').val('')
        $('#total-amount').val('')
        $('#arr-int').val('')
        $('#total_members').val('')
        collection = [];
    }

    function displayValidationMessage(id, message, color) {
        $('#' + id).text(message).css('color', color);
    }

    $('#myForm').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();
        //  console.log(event)
        // $("#add-btn").prop("disabled", true);

        let center = $('#mySelect').val();
        if (center == "" || center == null) {
            $('#center-error').text('');
            displayValidationMessage('center-error', "Select center", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('center-error', "Select center", 'black');
        }

        // Check if any checkbox is checked
        if (collection.length == 0) {
            toastr.error("Choose at least one collection to save");
            $("#add-btn").prop("disabled", false);
            return;
        }
        var formData = new FormData(document.getElementById("myForm"));
        var jsonObject = {};
        formData.forEach(function(value, key) {
            jsonObject[key] = value;
        });
        jsonObject['collection'] = collection;
        // console.log(jsonObject, "formdata")
        $.ajax({
            url: '/admin/multipleCollectionUpdate', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(jsonObject), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {
                // console.log('data', data)
                if (data.message == "Collection Updated") {
                    toastr.success(data.message);
                    clearForm();
                    $("#add-btn").prop("disabled", false);
                } else {
                    toastr.error("Collection already updated");
                    clearForm();
                    $("#add-btn").prop("disabled", false);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });
    });
    $('#reset-btn').click(function() {
        window.location.reload();
        // $('#myForm')[0].reset(); // Reset the form
    });
</script>
