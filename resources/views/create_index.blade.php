<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <style>
        .addbtn {
            margin-top: 15px;
            margin-right: 10px;
        }

        .table-view {
            margin-top: 5%;
        }
    </style>
</head>

<body>



    <div class="container d-flex justify-content-center align-items-center">

        <div id="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="staff">Select Staff</label>
                    <select type="text" class="member-select form-control" id="staff"
                        placeholder="Select Member">
                        {{-- @foreach ($staff as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->staff_name }}</option>
                    @endforeach --}}
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="member">Select Member</label>
                    <select type="text" class="member-select form-control" disabled id="member"
                        placeholder="Select Member">
                        {{-- <option>sdsd</option> --}}
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="pro">Select Product</label>
                    <select type="text" class="member-select form-control" id="product"
                        placeholder="Select Member">
                        {{-- <option>sdsd</option> --}}
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label for="purpose">Purpose</label>
                    <input type="text" class="purpose-field form-control" id="purpose" placeholder="Enter Purpose">
                </div>
                <div class="col-12 pull-right addbtn" style="">
                    <button id="add-btn" class=" btn btn-success mt-2 "><i class="fa fa-plus"></i> Add</button>

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
                    <th>Member</th>
                    <th>Plan</th>
                    <th>Purpose</th>
                    <th>Employee</th>
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
        $(document).ready(function() {



            // Add button click event
            $('#add-btn').click(function() {
                var member = $('#member').val();
                var plan = $('.plan-select').val();
                var purpose = $('.purpose-field').val();
                var employee = $('.employee-select').val();
                if (member == '' || member == null) {
                    console.log(member);
                    dispalyErrorMessage("#member", "#meber", "Member is Required.");
                    return;
                }

                var newRow = '<tr>' +
                    '<td>' + member + '</td>' +
                    '<td>' + plan + '</td>' +
                    '<td>' + purpose + '</td>' +
                    '<td>' + employee + '</td>' +
                    '<td><button class="remove-btn btn btn-danger btn-sm "><i class="fa fa-trash"></i> Remove</button></td>' +
                    '</tr>';

                $('#table-body').append(newRow);

                // Clear input fields
                $('.member-select').val('');
                $('.plan-select').val('');
                $('.purpose-field').val('');
                $('.employee-select').val('');
            });

            // Remove button click event
            $('#data-table').on('click', '.remove-btn', function() {
                $(this).closest('tr').remove(); // Remove the closest table row
            });



        });
        $('#staff').on('change', function(event) {

            const selected = $(this).val();
            addSelectData('member', 'member', {
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
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page || 1, // page number
                            tp: type,
                            data

                        };
                    },
                    processResults: function(data, params) {
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
                // Other options...
            });
        }

        addSelectData('staff');
        addSelectData('product', 'product');


        const validateAdd = () => {
            const staff = $('#staff')
            const plan = $('#product')
            const member = $('#member')


        }
        const dispalyErrorMessage = (errorMessageId, inputFieldId, errorMessage) => {

            var errorMessageNewId = errorMessageId.split("#");
            $(inputFieldId).parent().after("<span id='" + errorMessageNewId[1] + "'>" + errorMessage + "</span>");
            $(errorMessageId).css("display", "block");
            $(errorMessageId).css("width", "100%");
            $(errorMessageId).css("color", "red");
            $(errorMessageId).css('required', true);
            $(errorMessageId).css('margin-top', "-15px");
            $(errorMessageId).css('margin-bottom', "10px");
            console.log('wdwwd')
        };
    </script>

</body>

</html>
