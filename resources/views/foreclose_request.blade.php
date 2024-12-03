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
</div>

