<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

        .mb {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>


    <div class="container">
        <div id="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="center" class="" id="Center-error">Select Center</label>
                    <select type="text" class="form-control" id="Center" placeholder="Select Member"></select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <!-- <label for="staff">Select Employee</label> -->
                    <label for="employee" class="" id="Employee-error">Employee Name</label>
                    <input type="text" class="form-control" id="purpose" placeholder="employee" readonly disabled/>
                    <!-- <select type="text" class="form-control" id="Employee" disabled
                        placeholder="Select Employee"></select> -->
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="Member-error">Select Member</label>
                    <select type="text" class="form-control" placeholder="Select Member">
                       <option aria-readonly="true">Select Member</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="member" class="" id="Product-error">Disbursal Date</label>

                    <!-- <select type="text" class="form-control" id="Product" placeholder="Select Member"></select> -->
                    <!-- <span class='text-danger' id="product-error" style='display:none'> Product is required </span> -->
                    <input type="text" class="form-control" id="purpose" placeholder="Disbursal Date" readonly disabled/>
                </div>

                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Amount</label>
                    <input type="text" class="form-control" id="loan-amount" placeholder="Loan Amount" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Due Weeks</label>
                    <input type="text" class="form-control" id="loan-amount" placeholder="Due Weeks" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Collection Weeks</label>
                    <input type="text" class="form-control" id="collection-Weeks" placeholder="Collection Weeks" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Price</label>
                    <input type="text" class="form-control" id="arr-price" placeholder="Opening Arr. Price" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Opening Arr. Interest</label>
                    <input type="text" class="form-control" id="arr-int" placeholder="Opening Arr. Interest" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Outstanding</label>
                    <input type="text" class="form-control" id="loan-outstanding" placeholder="Loan Outstanding" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Collection Type</label>
                    <select type="text" class="form-control" id="collection-type" placeholder="Collection Type">
                       <option>Collection Type</option>
                       <option>Cash in hand</option>
                       <option>Bank</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Loan Collected</label>
                    <input type="text" class="form-control" id="loan-collected" placeholder="Loan Collected"/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb">
                    <label for="purpose">Total Collected</label>
                    <input type="text" class="form-control" id="total-collected" placeholder="Total Collected" readonly disabled/>
                </div>
                <div class="col-12 col-md-4 col-lg-4 addbtn" style="">
                    <button id="add-btn" class="btn btn-primary mt-2 d-block">
                        <i class="fa fa-save"></i>&nbsp; Save
                    </button>
                    <button id="reset-btn" class="btn btn-warning mt-2 d-block">
                        <i class="fa fa-refresh"></i> Reset
                    </button>
                </div>
            </div>
        </div>
        <br />
        <!-- <button class="remove-btn">Remove</button> -->
    </div>

    <script src="/jquery/jquery.min.js"></script>
    <script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>

    <script>
        let finalObj = [];
        let row_id = 1;
        const checkField = (data) => {
            var status;
            data.forEach((element) => {
                if (element.value == "" || element.value == null) {
                    // console.log(member);
                    dispalyErrorMessage(element.id);
                    status = false;
                } else {
                    status = true;
                }
            });
            return status;
            // console.log(id, 'sddsd');
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
            // $("#add-btn").click(function () {
            //     var center = $("#Center").val();
            //     var employee = $("#Employee").val();
            //     var member = $("#Member").val();
            //     var plan = $("#Product").val();
            //     var purpose = $("#purpose").val();
            //     // console.log(employee, 'emp');
            //     const valObj = [
            //         {
            //             value: center,
            //             id: "Center",
            //         },
            //         {
            //             value: employee,
            //             id: "Employee",
            //         },
            //         {
            //             value: member,
            //             id: "Member",
            //         },
            //         {
            //             value: plan,
            //             id: "Product",
            //         },
            //     ];
            //     if (checkField(valObj)) {
            //         let onblur = {
            //             sn: row_id,
            //             center,
            //             plan,
            //             purpose,
            //             employee,
            //         };
            //         finalObj.push(onblur);
            //         var newRow =
            //             "<tr>" +
            //             "<td>" +
            //             onblur.sn +
            //             "</td>" +
            //             "<td>" +
            //             $("#Center  option:selected").text() +
            //             "</td>" +
            //             "<td>" +
            //             $("#Employee option:selected").text() +
            //             "</td>" +
            //             "<td>" +
            //             $("#Member option:selected").text() +
            //             "</td>" +
            //             "<td>" +
            //             $("#Product option:selected").text() +
            //             "</td>" +
            //             "<td>" +
            //             purpose +
            //             "</td>" +
            //             `<td ><button class="remove-btn btn btn-danger btn-sm "  data-id='${row_id}' ><i class="fa fa-trash"></i> Remove</button></td>` +
            //             "</tr>";

            //         $("#table-body").append(newRow);
            //         row_id++;

            //         // Clear input fields
            //         // $('.').val('');
            //         // $('.plan-select').val('');
            //         // $('.purpose-field').val('');
            //         // $('.employee-select').val('');
            //     }

            //     $("#data-table").on("click", ".remove-btn", function () {
            //         $(this).closest("tr").remove(); // Remove the closest table row
            //         var fl = $(this).data("id"); // Use data() method to get the value of data-id
            //         finalObj = finalObj.filter((e) => e.sn != fl);
            //         console.log(fl, "hftdf");
            //     });
            // });

            // Remove button click event
        });
        $("#staff").on("change", function (event) {
            const selected = $(this).val();
            addSelectData("Member", "member", {
                id: selected,
            });
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
                                more: params.page * 10 < data.total_count, // Adjust the limit per page as needed
                            },
                        };
                    },
                    cache: true, // Enable caching on the client side
                },
                minimumInputLength: 2,
                placeholder: "Select " + id,
                templateResult: function (data) {
                    if (!data.id) {
                        return data.text;
                    }
                    var html = '<div >' + data.text + '</div>';
                    html += '<div class="additional-attribute">' + data.value + '</div>';
                    return $(html);
                }

                // Other options...
            });
        };

        addSelectData("Employee", "employee");
        addSelectData("Product", "product", {
            tes: "efef",
        });

        addSelectData("Center", "center");

        const validateAdd = () => {
            const staff = $("#staff");
            const plan = $("#product");
            const member = $("#member");
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
            $(this).attr("disabled", true);
            console.log("ihhxgfh");
            center_id = $(this).val();
            $("#Employee").removeAttr("disabled");
            addSelectData("Member", "member", {
                id: $(this).val(),
            });
        });
        $("#reset-form").on("click", function () {
            $("#myModal").modal("hide");
            $("#Center").val("");
            finalObj = [];
            $("#Center").attr("disabled", false);
            $("#table-body").html();
        });
    </script>
</body>

</html>