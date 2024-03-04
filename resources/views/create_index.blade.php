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

    /* .select2-selection .select2-selection--single {
        padding: 3px;
    } */

    .mb {
        margin-bottom: 10px;
    }

    .container {
        max-width: 100%;
    }
</style>
<!-- <div class="mb" style="width: 100%;margin: auto;"> -->

<div class="btn-group ">
    <a href="{{ admin_url('/indexes') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i><span
            class="hidden-xs">&nbsp;List</span></a>
</div>
<!-- </div> -->


<div class="bs-example">

    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are you sure want to Change Center
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <i class="fa fa-info-circle" style="margin-right: 2px"></i>
                        Added Member details should be clear
                        automatically
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" id="reset-form" class="btn btn-primary">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@if ($type != 'view')
<div class="container" style="margin-top: 10px;">
    <div id="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-4 mb">
                <label for="center" class="" id="Center-error">Select Center</label>
                @if ($type == 'create')
                <select class="form-control" id="Center" placeholder="Select Member"></select>
                @else
                <input class="form-control" id="Center" disabled data-id="{{ $data[0]->center_id }}"
                    value="{{ $data[0]->center_name }}" placeholder="Select Member"></i>
                @endif
            </div>
            <div class="col-12 col-md-4 col-lg-4 mb">
                <!-- <label for="staff">Select Employee</label> -->
                <label for="employee" class="" id="Employee-error"> Employee</label>
                @if ($type == 'create')
                <input type="text" class="form-control" id="Employee" disabled placeholder=" Employee"></>
                @else
                <input type="text" class="form-control" value="{{ $data[0]->emp_name }}"
                    data-id="{{ $data[0]->staff_id }}" id="Employee" disabled placeholder=" Employee"></>
                @endif
            </div>
            <div class="col-12 col-md-4 col-lg-4 mb">
                <label for="member" class="" id="Member-error">Select Member</label>
                <select type="text" class="form-control" id="Member" placeholder="Select Member"></select>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label for="member" class="" id="Product-error">Select Product</label>
                @php
                $getProduct = \App\Models\Product::get();
                @endphp
                <select class="form-control" id="Product" placeholder="Select Member">
                    <option selected>---Select Product----</option>
                    @foreach ($getProduct as $key => $value)
                    <option value='{{ $value->id }}'>{{ $value->plan_name }}</option>
                    @endforeach
                </select>
                <!-- <span class='text-danger' id="product-error" style='display:none'> Product is required </span> -->
            </div>
            <div class="col-12 col-md-4 col-lg-4">
                <label for="product_amount">Product Amount</label>
                <input type="text" class="purpose-field form-control" id="product_amount" disabled
                    placeholder="Product Amount" />
            </div>

            <div class="col-12 col-md-4 col-lg-4">
                <label for="purpose">Purpose</label>
                <input type="text" class="purpose-field form-control" id="purpose" placeholder="Enter Purpose" />
            </div>
            <div class="col-12 col-md-4 col-lg-4 addbtn">
                <button id="add-btn" class="btn btn-success mt-2 d-block">
                    <i class="fa fa-plus"></i> Add
                </button>
                <button id="reset-btn" class="btn btn-warning mt-2 d-block">
                    <i class="fa fa-refresh"></i> Reset
                </button>
            </div>
        </div>
        <!-- nominee -->
        <input type="hidden" name="" id="nominee">
    </div>
    <br />
    <!-- <button class="remove-btn">Remove</button> -->
</div>


@endif

<div class="box-body table-responsive no-padding table-view container" style="background-color: #fff">
    <table id="data-table" class="table table-hover grid-table">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Center</th>
                <!-- <th>Employee</th> -->
                <th>Member</th>
                <th>Nominee </th>
                <th>Product</th>
                <th>Purpose</th>
                <th>Loan Amount</th>
                @if ($type !== 'view')
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table body content will be inserted dynamically -->
        </tbody>
        <tfoot id="table-foot">
            <tr>
                <td colspan="{{ $type != 'view' ? '5' : '5' }}"></td>
                <td colspan="">Total Product Amount</td>
                <th colspan="" id="total_amount"> 0</th>
                <th>
                    <form action="{{ $type == 'create' ? '/admin/addIndex' : '/admin/editIndex' }}" method="post"
                        id="final-form" style="display: none;">
                        <input type="hidden" name="data" value="" id="data-bind">
                        @csrf
                        @if ($type == 'edit')
                        <input type="hidden" name="index_id" value="{{ $data[0]->index_id }}">
                        @endif
                        @if ($type != 'view')
                        <button class="btn btn-success "><i class="fa fa-plus"></i>
                            {{ $type == 'create' ? 'Add' : 'Update' }}
                            Index</button>
                        @endif

                    </form>
                </th>
            </tr>
        </tfoot>
    </table>

</div>
<script src="/jquery/jquery.min.js"></script>
<script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>

<script>
    let finalObj = @json(isset($data) ? $data : []);
    let row_id = finalObj.length == 0 ? 1 : finalObj.length + 1;
    let type = '{{ $type }}';
    console.log(type, 'jhst7yg')
    const checkField = (data) => {
        var status;
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

    $(document).ready(function () {
        // Add button click event
        $("#add-btn").click(function () {
            var center = $("#Center").val();
            var employee = $("#Employee").val();
            var member = $("#Member").val();
            var plan = $("#Product").val();
            var purpose = $("#purpose").val();
            var amount = $("#product_amount").val();

            // console.log(employee, 'emp');
            const valObj = [{
                value: center,
                id: "Center",
            },

            {
                value: member,
                id: "Member",
            }, {
                value: plan,
                id: "Product",
            },
            ];
            $.ajax({
                url: "{{ route('checkIndex') }}",
                dataType: "json",
                data: {

                    member_id: member, // search term
                    plan_id: plan

                },
                success: (e) => {
                    if (checkField(valObj) && e) {

                        let onblur = {
                            sn: row_id,
                            center: type == 'create' ? center : $('#Center').data('id'),
                            plan,
                            purpose,
                            employee,
                            member,
                            amount,
                            employee_id: $('#Employee').data('id'),
                            center_name: type == 'create' ? $("#Center  option:selected").text() : $(
                                '#Center').val(),
                            member_name: $("#Member option:selected").text(),
                            product_name: $("#Product option:selected").text(),
                            emp_name: $("#Employee").val(),
                            nominee_name: $('#nominee').val()
                        };
                        const validateRecord = finalObj.find((e) => e.plan == plan && e.member == member);
                        console.log(validateRecord, 'vall');
                        if (validateRecord == undefined) {

                            finalObj.push(onblur);

                            changeUi();
                            row_id++;
                            // $("#Member").select2('val', '');
                            $("#Product ").val(null).trigger('change');
                            $("#purpose").val('');
                            $("#product_amount").val('');
                            $("#Member").val('');
                            $('#Member').val(null).trigger('change');
                            console.log(finalObj, 'fill');

                            if (finalObj.length > 0) {
                                $('#final-form').css({
                                    display: 'block'
                                })
                            }
                            // totalChanger()
                        } else {
                            toastr.error('Member Already added in same plan')
                            return;

                        }

                    } else {
                        toastr.error('Member Already requested in previous Index')
                        return;
                    }



                },
                error: (e) => toastr.error(e)
            })




        });

        $('#Member').on('change', () => {
            console.log($('#Member').val(), 'sfsfsf');
            $.ajax({
                url: "{{ route('get.member') }}",
                dataType: "json",
                data: {
                    id: $('#Member').val(), // search term
                }, success: (e) => {
                    $('#nominee').val(e.nominee_name);
                    //console.log(e, 'memver_c');
                }
            })
        })
        // Remove button click event
    });
    $("#staff").on("change", function (event) {
        const selected = $(this).val();

        $("#member").removeAttr("disabled");

        console.log("chage", selected);
    });
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
    $('#Product').select2();
    // addSelectData("Employee", "employee");

    //  addSelectData("Product", "product");

    if (type == 'create') {

        addSelectData("Center", "center");
    } else {
        console.log('efefe');
        addSelectData("Member", "member", {
            id: '@json(isset($data) ? $data[0]->member_id : 0)',
        });
    }



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
    $("#reset-btn").click(function () {
        $("#myModal").modal("show");
    });
    $(document).on("select2:open", (e) => {
        removeError(e.target);
        // console.log(e.target.id, 'sffsfsf');
        document
            .querySelector(
                ".select2-container--open .select2-search__field"
            )
            .focus();
    });
    $("#Center").on("change", function () {
        center_id = $(this).val();
        if (center_id != null) {
            $(this).attr("disabled", true);
        }
        console.log(center_id, "ihhxgfh");
        // $("#Employee").removeAttr("disabled");
        $.ajax({
            url: "{{ route('get.employee') }}",
            dataType: "json",
            delay: 250,
            data: {

                id: center_id, // search term

            },
            success: (e) => {
                console.log('dataEmp', e);
                $('#Employee').val(e.staff_name);
                $('#Employee').attr('data-id', e.id);

                addSelectData("Member", "member", {
                    id: e.id,
                });
            }
        })

    });
    $('#Product').on('change', function () {
        // $("#Employee").removeAttr("disabled");
        $.ajax({
            url: "{{ route('get.product') }}",
            dataType: "json",
            data: {

                id: $(this).val(), // search term

            },
            success: (e) => {
                console.log('dataEmp', e);
                $('#product_amount').val(e.plan_amount);
            }
        })
    })
    $("#reset-form").on("click", function () {
        $("#myModal").modal("hide");
        $("#Center").val("");
        $("#Employee").val("");

        finalObj = [];
        $("#Center").removeAttr("disabled");
        $("#table-body").html('');
        $('#Center').val(null).trigger('change');
        changeUi()
        // totalChanger()
        if (finalObj.length == 0) {
            $('#final-form').css({
                display: 'none'
            })
        }
    });
    const totalChanger = () => {
        const addTotal = finalObj.reduce((acc, curr) => {
            return acc + parseInt(curr.amount);
        }, 0);
        $('#data-bind').val(JSON.stringify(finalObj));
        // console.log(addTotal);
        $('#total_amount').text(addTotal)
    }
    const changeUi = () => {
        $("#table-body").html('');

        finalObj.map((e) => {
            var newRow;
            console.log(type);
            if (type == 'view') {
                newRow = `
                <tr>
                    <td>${e.sn}</td>
                    <td>${e.center_name}</td>
                    <td>${e.member}-${e.member_name}</td>
                    <td>${e.nominee_name}</td>
                    <td>${e.product_name}</td>
                    <td>${e.purpose}</td>
                    <td>${e.amount}</td>
                </tr>`;
            } else {
                newRow = `
                <tr>
                    <td>${e.sn}</td>
                    <td>${e.center_name}</td>
                    <td>${e.member}-${e.member_name}</td>
                    <td>${e.nominee_name}</td>
                    <td>${e.product_name}</td>
                    <td>${e.purpose}</td>
                    <td>${e.amount}</td>
                    <td><button class="remove-btn btn btn-danger btn-sm" data-id='${e.sn}'><i class="fa fa-trash"></i></button></td>
                </tr>`;
            }


            $("#table-body").append(newRow);

        })

        totalChanger()
        if (finalObj.length > 0) {
            $('#final-form').css({
                display: 'block'
            })
        }
    }

    $("#data-table").on("click", ".remove-btn", function () {
        // $(this).closest("tr").remove(); // Remove the closest table row
        console.log('removeid');
        var fl = $(this).data("id"); // Use data() method to get the value of data-id
        finalObj = finalObj.filter((e) => e.sn != fl);
        if (finalObj.length == 0) {
            $('#final-form').css({
                display: 'none'
            })
        }
        changeUi()
        // totalChanger()
        // console.log(fl, "hftdf");
    });

    changeUi()
</script>