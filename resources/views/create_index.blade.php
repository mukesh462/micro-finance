<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

    <style>
        .addbtn {
            margin-top: 25px;

        }

        .table-view {
            margin-top: 5%;
        }

        .select2 {
            width: 100% !important;
        }

        .select2-selection .select2-selection--single {
            padding: 3px;
        }
    </style>
</head>

<body>
    <div class="bs-example">
        <!-- Button HTML (to Trigger Modal) -->


        <!-- Modal HTML -->
        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure want to Change Center </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <p><i class="fa fa-info-circle" style="margin-right: 2px;"></i> Added Member details should be
                            clear automatically</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container ">

        <div id="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="center" class="" id="Center-error">Select Center</label>
                    <select type="text" class=" form-control" id="Center" placeholder="Select Member">
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <!-- <label for="staff">Select Employee</label> -->
                    <label for="employee" class="" id="Employee-error">Select Employee</label>
                    <select type="text" class=" form-control" id="Employee" placeholder="Select Employee">
                    </select>

                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="member" class="" id="Member-error">Select Member</label>
                    <select type="text" class=" form-control" id="Member" placeholder="Select Member">

                    </select>


                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="member" class="" id="Product-error">Select Product</label>

                    <select type="text" class=" form-control" id="Product" placeholder="Select Member">
                    </select>
                    <!-- <span class='text-danger' id="product-error" style='display:none'> Product is required </span> -->

                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="purpose">Purpose</label>
                    <input type="text" class="purpose-field form-control" id="purpose" placeholder="Enter Purpose">
                </div>
                <div class="col-12 col-md-4 col-lg-4  addbtn " style="">
                    <button id="add-btn" class=" btn btn-success mt-2 d-block "><i class="fa fa-plus"></i> Add</button>
                    <button id="reset-btn" class=" btn btn-warning mt-2 d-block "><i class="fa fa-refresh"></i>
                        Reset</button>

                </div>
            </div>

        </div>
        <br />
        <!-- <button class="remove-btn">Remove</button> -->
    </div>
    <div class="box-body table-responsive no-padding table-view container " style="background-color: #fff;">

        <table id="data-table" class="table table-hover grid-table">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Center</th>
                    <th>Employee</th>
                    <th>Member</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Table body content will be inserted dynamically -->
            </tbody>
        </table>
    </div>
    <script src="/jquery/jquery.min.js"></script>
    <script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>

    <script>
        const finalObj = [];
        const checkField = (data) => {
            var status;
            data.forEach(element => {
                if (element.value == '' || element.value == null) {
                    // console.log(member);
                    dispalyErrorMessage(element.id);
                    status = false;
                } else {
                    status = true;
                }
            });
            return status;
            // console.log(id, 'sddsd');

        }
        const removeError = (e) => {
            console.log(e.id, 'sdsds');

            $('#' + e.id + '-error').css({
                color: 'black'
            });
            $('#' + e.id + '-error').text('Select ' + e.id);

        }

        $(document).ready(function () {



            // Add button click event
            $('#add-btn').click(function () {
                var center = $('#Center').val();
                var employee = $('#Employee').val();
                var member = $('#Member').val();
                var plan = $('#Product').val();
                var purpose = $('#purpose').val();
                // console.log(employee, 'emp');
                const valObj = [{
                    value: center,
                    id: 'Center'
                }, {
                    value: employee, id: 'Employee'
                },
                {
                    value: member, id: 'Member'
                }, {
                    value: plan, id: 'Product'
                }]
                if (checkField(valObj)) {
                    var newRow = '<tr>' +
                        '<td>' + member + '</td>' +
                        '<td>' + plan + '</td>' +
                        '<td>' + purpose + '</td>' +
                        '<td>' + employee + '</td>' +
                        '<td><button class="remove-btn btn btn-danger btn-sm "><i class="fa fa-trash"></i> Remove</button></td>' +
                        '</tr>';

                    $('#table-body').append(newRow);

                    // Clear input fields
                    $('.').val('');
                    $('.plan-select').val('');
                    $('.purpose-field').val('');
                    $('.employee-select').val('');
                }

                $('#data-table').on('click', '.remove-btn', function () {
                    $(this).closest('tr').remove(); // Remove the closest table row
                })

            });

            // Remove button click event






        });
        $('#staff').on('change', function (event) {

            const selected = $(this).val();
            addSelectData('Member', 'member', {
                id: selected
            });
            $('#member').removeAttr('disabled')

            console.log('chage', selected)
        })
        const addSelectData = (id, type = 'staff', data = {}) => {
            console.log('#' + id)
            $('#' + id).select2({
                ajax: {
                    url: "{{ route('get.data') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page || 1, // page number
                            tp: type,
                            data

                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.results,
                            pagination: {
                                more: (params.page * 10) < data
                                    .total_count // Adjust the limit per page as needed
                            }
                        };
                    },
                    cache: true // Enable caching on the client side
                },
                minimumInputLength: 3,
                placeholder: 'Select ' + id

                // Other options...
            });
        }

        addSelectData('Employee');
        addSelectData('Product');
        addSelectData('Member');


        addSelectData('Center', 'center');


        const validateAdd = () => {
            const staff = $('#staff')
            const plan = $('#product')
            const member = $('#member')


        }


        var dispalyErrorMessage = (errorMessageId) => {

            var errorMessageNewId = '#' + errorMessageId;
            $(errorMessageNewId + '-error').css({
                color: 'red',

            })
            console.log(errorMessageId, 'erferf');

            $(errorMessageNewId + '-error').text('Select  ' + errorMessageId + ' is required')

        };
        $("#reset-btn").click(function () {
            $("#myModal").modal('show');


        });
        $(document).on('select2:open', (e) => {
            removeError(e.target)
            // console.log(e.target.id, 'sffsfsf');
            document.querySelector('.select2-container--open .select2-search__field').focus();
        });
    </script>

</body>

</html>