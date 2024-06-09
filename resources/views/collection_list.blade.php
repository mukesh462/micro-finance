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
        <h3 class="box-title">Collection List</h3>

        <!-- <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 5px">
                <a href="/admin/collectionList" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
            </div>
        </div> -->
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
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="employee" class="" id="employee_error">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Employee Name" readonly />
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="member_error">Select Member</label>
                    <select type="text" class="form-control" placeholder="Select Member" id="member_list" name="member">
                        <option aria-readonly="true" value="">Select Member</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="loan_error">Select Loan Acc No</label>
                    <select type="text" class="form-control" placeholder="Select Loan" id="loan_list" name="loan_id">
                        <option aria-readonly="true" value="">Select Loan Acc Number</option>
                    </select>
                </div>
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="Product-error">Disbursal Date</label>
                    <input type="text" class="form-control" id="disbursal_date" name="disbursal_date" placeholder="Disbursal Date" readonly disabled/>
                </div>
                <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Amount</label>
                    <input type="text" class="form-control" id="loan_amount" name="loan_amount" placeholder="Loan Amount" readonly/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Outstanding</label>
                    <input type="text" class="form-control" id="loan_outstanding" name="loan_outstanding" placeholder="Loan Outstanding" readonly  />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">collection Weeks</label>
                    <input type="text" class="form-control" id="due_weeks" name="collection_weeks" placeholder="collection Weeks" readonly />
                </div>

                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Price</label>
                    <input type="text" class="form-control" id="arr_price" name="arr_price" placeholder="Opening Arr. Price" readonly />
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Amount</label>
                    <input type="text" class="form-control" id="due_price" name="due_price" placeholder="Due Amount" readonly />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Interest</label>
                    <input type="text" class="form-control" id="due_int" name="due_int" placeholder="Due Interest" readonly />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Interest</label>
                    <input type="text" class="form-control" id="arr-int" placeholder="Opening Arr. Interest" readonly disabled />
                </div> -->

                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="collection-type" id="collection-error">Collection Type</label>
                    <select type="text" class="form-control" id="collection-type" placeholder="Collection Type" name="collection-type">
                        <option value="">Collection Type</option>
                        <option value="Cash in hand">Cash in hand</option>
                        <option value="Bank">Bank</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose" id="amount-error">Total Collected</label>
                    <input type="text" class="form-control" id="loan_collected" name="loan_collected" placeholder="Loan Collected" />
                    <input type="hidden" class="form-control" id="collection_id" name="collection_id" />
                </div> -->
                <!-- <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Collected</label>
                    <input type="text" class="form-control" id="total-collected" placeholder="Total Collected" readonly disabled />
                </div> -->
                <div class="col-12 col-md-4 col-lg-4 addbtn" style="">
                    <button type="submit" id="add-btn" class="btn btn-primary mt-2 d-block">
                        <i class="fa fa-save"></i>&nbsp; Search
                    </button>
                    <button type="button" id="reset-btn" class="btn btn-warning mt-2 d-block">
                        <i class="fa fa-refresh"></i> Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
    <br />
    <table id="data-table" class="table table-hover grid-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Center</th>
                <th>Member</th>
                <th>Collection Week</th>
                <th>Due Date</th>
                <th>Collection Amount </th>
                <th>Collected Amount</th>
                <th>Due Balance</th>
                <!-- <th>Total Amount</th> -->
                <!-- <th>Collected</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table body content will be inserted dynamically -->
        </tbody>

    </table>
    <!-- <button class="remove-btn">Remove</button> -->
</div>

<!-- <script src="/jquery/jquery.min.js"></script>
<script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script> -->

<script>
    $(document).ready(function() {
        $('.select2').select2();
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

    $("#mySelect").on("change", function() {
        resetForm();
        // $(this).attr("disabled", true);
        center_id = $(this).val();
        if(center_id == null){
            return;
        }
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
                            text:"00"+option.id+"-"+option.client_name
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
                // $('#disbursal_date').val('')
                // $('#loan_amount').val('')
                // $('#loan_outstanding').val('')
                // $('#collection_id').val('')
                // $('#arr_price').val('')
                // $('#due_price').val('')
                // // $('#due_int').val('')
                // $('#loan_collected').val('')
                // $('#due_weeks').val('')
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
    $("#member_list").on("change", function() {
        // $(this).attr("disabled", true);
        $('#data-table tbody').empty();
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
                    var emptyLoan= loanElement.querySelector('option[value=""]');
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
                $('#loan_outstanding').val('')
                $('#collection_id').val('')
                $('#arr_price').val('')
                $('#due_price').val('')
                // $('#due_int').val('')
                $('#loan_collected').val('')
                $('#due_weeks').val('')
                }
                // if (data.results.employee != null) {
                //     $('#employee_name').val(data.results.employee.staff_name);
                // }
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
    $("#loan_list").on("change", function() {
        $('#data-table tbody').empty();

        // // $(this).attr("disabled", true);
        // let loan_id = $(this).val();
        // let postData = {
        //     loan_id: loan_id,
        // };
        // // jQuery AJAX POST call
        // $.ajax({
        //     url: '/admin/getLoanDetails', // replace with your API endpoint
        //     method: 'POST',
        //     contentType: 'application/json', // set content type to JSON
        //     data: JSON.stringify(postData), // convert data to JSON format
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
        //     },
        //     success: function(data) {
        //         console.log(data,"loan")
        //         if(data.message == "data Found"){
        //         $('#disbursal_date').val(data.results.loan.dis_date)
        //         $('#loan_amount').val(data.results.loan.loan_amount)
        //         $('#loan_outstanding').val(data.results.loan.outstanding_amount)
        //         $('#arr_price').val(data.results.balance_amount)
        //         $('#collection_id').val(data.results.collection.id)
        //         $('#due_weeks').val(data.results.collection.due_number)
        //         $('#due_price').val(data.results.collection.collection_amount)
        //         // $('#due_int').val(data.results.collection.collection_interest)
        //         $('#loan_collected').val(data.results.total_amount)
        //         }else{
        //             toastr.error(data.message);
        //             document.getElementById("myForm").reset()
        //             var centerElement = $('#mySelect');
        //             // Programmatically remove the selected option
        //             centerElement.val(null).trigger('change');
        //             resetForm();
        //         }
        //         // if (data.results.loan.length > 0) {
        //         //     $.each(data.results.loan, function(index, option) {
        //         //         $('#loan_list').append($('<option>', {
        //         //             value: option.id,
        //         //             text: option.loan_amount
        //         //         }));
        //         //     });
        //         // } else {
        //         //     var selectElement = $('#loan_list');
        //         //     // Remove all existing options
        //         //     selectElement.find('option[value!=""]').remove();
        //         // }
        //         // if (data.results.employee != null) {
        //         //     $('#employee_name').val(data.results.employee.staff_name);
        //         // }
        //         console.log(data, "respo")
        //         // Handle successful response
        //         // $('#result').text(JSON.stringify(data, null, 2));
        //     },
        //     error: function(xhr, status, error) {
        //         // Handle error
        //         console.error('AJAX request failed: ' + status + ', ' + error);
        //     }
        // });

        // // addSelectData("Center", "center", {
        // //     id: $(this).val(),
        // // });
    });

    function displayValidationMessage(id, message, color) {
        $('#' + id).text(message).css('color', color);
    }

    $('#myForm').submit(function(event) {

        // Prevent the default form submission
        event.preventDefault();
       // $("#add-btn").prop("disabled", true);
        //  console.log(event)
        // Perform validation
        // var name = $('input[name="name"]').val();
        // var email = $('input[name="email"]').val();
        let center = $('#mySelect').val();
        if (center == "" || center == null) {
            $('#center-error').text('');
            displayValidationMessage('center-error',"Select center", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        }else
        {
            displayValidationMessage('center-error',"Select center", 'black');
        }

        let member = $('#member_list').val();
        if (member == "" || member == null) {
            $('#member_error').text('');
            displayValidationMessage('member_error',"Select Member", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        }else
        {
            displayValidationMessage('member_error',"Select Member", 'black');
        }
        let loan = $('#loan_list').val();
        if (loan == "" || loan == null) {
            $('#loan_error').text('');
            displayValidationMessage('loan_error',"Select Loan Acc No", 'red');
            $("#add-btn").prop("disabled", false);
            return;
        }else
        {
            displayValidationMessage('loan_error',"Select Loan Acc No", 'black');
        }



        var formData = new FormData(document.getElementById("myForm"));
        var jsonObject = {};
        formData.forEach(function(value, key){
            jsonObject[key] = value;
        });
        console.log(jsonObject,"formdata")

        $.ajax({
            url: '/admin/singleCollectionList', // replace with your API endpoint
            method: 'POST',
            contentType: 'application/json', // set content type to JSON
            data: JSON.stringify(jsonObject), // convert data to JSON format
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // include CSRF token in headers
            },
            success: function(data) {
               console.log('data',data)
               $('#data-table tbody').empty();
               if(data.message == "Collection Found") {
                toastr.success(data.message);

                // document.getElementById("myForm").reset()
                // var centerElement = $('#mySelect');
                // Programmatically remove the selected option
                // centerElement.val(null).trigger('change');
                // resetForm();

                    for (let i = 0; i < data.results.collections.length; i++) {
                var newRow = '<tr>' +
                    '<td>' + data.results.collections[i].id + '</td>' +
                    '<td>' +'00'+ data.results.center.id+'-'+data.results.center.center_name + '</td>' +
                    '<td>'  +'00'+ data.results.member.id+'-'+ data.results.member.client_name + '</td>' +
                    '<td>' + data.results.collections[i].due_number + '</td>' +
                    '<td>' + data.results.collections[i].due_date + '</td>' +
                    '<td>' + data.results.collections[i].collection_amount + '</td>' +
                    '<td>' + data.results.collections[i].collected_amount + '</td>' +
                    '<td>' + data.results.collections[i].due_balance + '</td>' +
                    '<td>' + (data.results.collections[i].status == 3 ? '<span class="btn btn-success">Paid</span>' : '<a href="/admin/collectionEdit/' + data.results.collections[i].id + '">Edit</a>') + '</td>'

                    // Add more table cells as needed
                    '</tr>';
                $('#data-table tbody').append(newRow);
                $("#add-btn").prop("disabled", false);
                    }
            }
               else {
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
        $('#data-table tbody').empty();
        var selectElement = document.getElementById("member_list");
        var emptyOption = selectElement.querySelector('option[value=""]');
        var clonedEmptyOption = emptyOption.cloneNode(true);
        selectElement.innerHTML = ''; // Clear all options
        selectElement.appendChild(clonedEmptyOption);
        var loanElement = document.getElementById("loan_list");
        var emptyLoan= loanElement.querySelector('option[value=""]');
        var clonedEmptyLoan = emptyLoan.cloneNode(true);
        loanElement.innerHTML = ''; // Clear all options
        loanElement.appendChild(clonedEmptyLoan);
    }
</script>
