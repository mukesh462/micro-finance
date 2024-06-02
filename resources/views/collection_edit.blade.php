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

<?php
// dd($data);
?>
<div class="box-header with-border">
    <h3 class="box-title">Collection Edit</h3>
    <div class="box-tools">
        <div class="btn-group pull-right" style="margin-right: 5px">
            <a href="/admin/collectionsList" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
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
                    <select type="text" class="form-control" placeholder="Select Center" id="mySelect" name="center_name" readonly>
                        <option value="{{$data['Center']->id}}" selected>00{{$data['Center']->id}}-{{$data['Center']->center_name}}</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="employee" class="" id="employee_error">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Employee Name" value="{{$data['employee']->staff_name}}" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="member_error">Select Member</label>
                    <select type="text" class="form-control" placeholder="Select Member" id="member_list" name="member" readonly>
                        <option value="{{$data['Member']->id}}" selected>{{$data['Member']->client_name}}</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="loan_error">Select Loan Acc No</label>
                    <select type="text" class="form-control" placeholder="Select Loan" id="loan_list" name="loan_id" readonly>
                        <option value="{{$data['loan']->id}}" selected>{{$data['loan']->loan_no}}</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="Product-error">Disbursal Date</label>
                    <input type="text" class="form-control" id="disbursal_date" name="disbursal_date" placeholder="Disbursal Date" value="{{$data['loan']->dis_date}}" readonly />
                </div>
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Amount</label>
                    <input type="text" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" value="{{$data['loan']->loan_amount}}" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Outstanding</label>
                    <input type="text" class="form-control" id="loan_outstanding" name="loan_outstanding" placeholder="Loan Outstanding" value="{{$data['loan']->outstanding_amount}}" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">collection Weeks</label>
                    <input type="text" class="form-control" id="due_weeks" name="collection_weeks" placeholder="collection Weeks" value="{{$data['collection']->due_number}}" readonly />
                </div>

                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Price</label>
                    <input type="text" class="form-control" id="arr_price" name="arr_price" placeholder="Opening Arr. Price" readonly />
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Amount</label>
                    <input type="text" class="form-control" id="due_price" name="due_price" placeholder="Due Amount" value="{{$data['collection']->collection_amount}}" readonly />
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Interest</label>
                    <input type="text" class="form-control" id="due_int" name="due_int" placeholder="Due Interest" readonly />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Interest</label>
                    <input type="text" class="form-control" id="arr-int" placeholder="Opening Arr. Interest" readonly  />
                </div> -->

                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="collection-type" id="collection-error">Collection Type</label>
                    <select type="text" class="form-control" id="collection-type" placeholder="Collection Type" name="collection-type">
                        <option value="">Collection Type</option>
                        <option value="Cash in hand">Cash in hand</option>
                        <option value="Bank">Bank</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose" id="amount-error">Total Collected</label>
                    <input type="text" class="form-control total-amount-input" id="loan_collected" name="loan_collected" placeholder="Loan Collected" value="{{$data['collection']->collected_amount}}" />
                    <input type="hidden" class="form-control" id="collection_id" name="collection_id" value="{{$data['collection']->id}}" />
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Collected</label>
                    <input type="text" class="form-control" id="total-collected" placeholder="Total Collected" readonly  />
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 addbtn" style="">
                    <button type="submit" id="add-btn" class="btn btn-primary mt-2 d-block">
                        <i class="fa fa-save"></i>&nbsp; Save
                    </button>
                    <!-- <button type="button" id="reset-btn" class="btn btn-warning mt-2 d-block">
                        <i class="fa fa-refresh"></i> Reset
                    </button> -->
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
    $('.total-amount-input').on('input', function() {
        var value = $(this).val();
        if (!/^\d*\.?\d{0,2}$/.test(value)) {
            $(this).val(value.slice(0, -1)); // remove last character if not valid
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

        let colection = $('#collection-type').val();
        if (colection == "" || colection == null) {
            $('#collection-error').text('');
            displayValidationMessage('collection-error', "Select Collection Type", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('collection-error', "Select Collection Type", 'black');
        }

        let collected = $('#loan_collected').val();
        if (collected == "" || collected == null) {
            $('#amount-error').text('');
            displayValidationMessage('amount-error', "Enter Collected Amount", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        } else {
            displayValidationMessage('amount-error', "Loan Collected", 'black');
        }

        var formData = new FormData(document.getElementById("myForm"));
        var jsonObject = {};
        formData.forEach(function(value, key) {
            jsonObject[key] = value;
        });
        // console.log(jsonObject, "formdata")

        $.ajax({
            url: '/admin/editCollection', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(jsonObject), // convert data to JSON format
            // headers: {
            //     'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            // },
            success: function(data) {
                // console.log('data', data)
                if (data.message == "Collection updated successfully") {
                    // document.getElementById("myForm").reset()
                    toastr.success(data.message);
                    setTimeout(() => {
                        window.location.href = '/admin/collectionsList';
                        // $("#add-btn").prop("disabled", false);
                    }, 2000)
                } else {
                    toastr.error(data.message);
                    $("#add-btn").prop("disabled", false);
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('AJAX request failed: ' + status + ', ' + error);
            }
        });

        // Submit the form
        // this.submit();
    });
    // $('#reset-btn').click(function() {
    //       window.location.reload();
    //     // $('#myForm')[0].reset(); // Reset the form
    // });
</script>
