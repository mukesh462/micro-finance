<div>
    @livewireStyles
    <form wire:submit.prevent="submitForm" class="form-horizontal model-form-65ddb585837bb" accept-charset="UTF-8">

        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active">
                        <a href="#tab-form-1" data-toggle="tab">
                            Member Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#tab-form-2" data-toggle="tab">
                            Member Family Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#tab-form-3" data-toggle="tab">
                            Member Document <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#tab-form-4" data-toggle="tab">
                            Nominee Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#tab-form-5" data-toggle="tab">
                            Bank Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>

                </ul>
                <div class="tab-content fields-group">

                    <div class="tab-pane active container" id="tab-form-1" style='max-width:100%!important'>
                        <div class="form-row gap-1">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="form-group ">
                                    <label class="  control-label">Member ID</label>
                                    <div class="">
                                        <div class="box box-solid box-default no-margin">
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                4&nbsp;
                                            </div><!-- /.box-body -->
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="form-group  ">

                                    <label for="center_id" class=" asterisk control-label">Select Center
                                    </label>

                                    <div class="">



                                        <select wire:model='center_id' class="form-control center_id "
                                            style="width: 100%;" name="center_id" data-value="" tabindex="-1"
                                            aria-hidden="true">
                                            <option value=""></option>
                                            <option value="1">001 - Madurai</option>
                                            <option value="2">002 - Tirupur</option>

                                        </select>
                                        @error('center_id')
                                        <span class="error">{{ $message }}</span>
                                        @enderror



                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                @include('livewire.text-input', [
                                'label' => 'Member name',
                                'name' => 'client_name',
                                'isRequired' => true,
                                ])
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">

                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="form-group  ">

                                    <label for="photo" class="col-sm-2  control-label">Photo</label>

                                    <div class="col-sm-8">


                                        <div class="file-input file-input-new">
                                            <div class="file-preview ">
                                                <button type="button" class="close fileinput-remove" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <div class="file-drop-disabled">
                                                    <div class="file-preview-thumbnails">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="file-preview-status text-center text-success"></div>
                                                    <div class="kv-fileinput-error file-error-message"
                                                        style="display: none;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kv-upload-progress kv-hidden" style="display: none;">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success progress-bar-success progress-bar-striped active"
                                                        role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                        aria-valuemax="100" style="width:0%;">
                                                        0%
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="input-group file-caption-main">
                                                <div class="file-caption form-control  kv-fileinput-caption"
                                                    tabindex="500">
                                                    <span class="file-caption-icon"></span>
                                                    <input class="file-caption-name" onkeydown="return false;"
                                                        onpaste="return false;" placeholder="Select image">
                                                </div>
                                                <div class="input-group-btn input-group-append">



                                                    <div tabindex="500" class="btn btn-primary btn-file"><i
                                                            class="glyphicon glyphicon-folder-open"></i>&nbsp; <span
                                                            class="hidden-xs">Browse</span><input type="file"
                                                            class="photo" name="photo" id="1709028743700_50"></div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="form-group  ">

                                    <label for="dob" class="col-sm-2 asterisk control-label">DOB</label>

                                    <div class="col-sm-8">


                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>

                                            <input id="dob_date" style="width: 110px" type="text" name="dob" value=""
                                                class="form-control dob" placeholder="Input DOB">



                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">

                                <div class="form-group  ">

                                    <label for="age" class="col-sm-2  control-label">Age</label>

                                    <div class="col-sm-8">


                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                            <input id="age" readonly="" disabled="" type="text" name="age" value=""
                                                class="form-control age" placeholder="Input Age">



                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>






                        <div class="form-group  ">

                            <label for="gender" class="col-sm-2  control-label">Gender</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="gender">

                                <select class="form-control gender select2-hidden-accessible" style="width: 100%;"
                                    name="gender" data-value="" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-gender-qi-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-gender-qi-container"><span
                                                    class="select2-selection__placeholder">Gender</span></span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="phone_number" class="col-sm-2 asterisk control-label">Mobile</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="phone_number" name="phone_number" value=""
                                        class="form-control phone_number" placeholder="Input Mobile">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="address" class="col-sm-2 asterisk control-label">Address</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="address" name="address" value="" class="form-control address"
                                        placeholder="Input Address">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="city" class="col-sm-2  control-label">City</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="city" name="city" value="" class="form-control city"
                                        placeholder="Input City">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="pincode" class="col-sm-2  control-label">Pincode</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input class="numberic form-control" type="text" id="pincode" name="pincode"
                                        value="" placeholder="Input Pincode">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="state" class="col-sm-2  control-label">State</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="state" name="state" value="" class="form-control state"
                                        placeholder="Input State">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="country" class="col-sm-2  control-label">Country</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="country" name="country" value="" class="form-control country"
                                        placeholder="Input Country">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="community" class="col-sm-2 asterisk control-label">Community</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="community">

                                <select class="form-control community select2-hidden-accessible" style="width: 100%;"
                                    name="community" data-value="Not prefer to say" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="BC">BC</option>
                                    <option value="MBC">MBC</option>
                                    <option value="SC">SC</option>
                                    <option value="ST">ST</option>
                                    <option value="Other">Other</option>
                                    <option value="Not prefer to say" selected="">Not prefer to say</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-community-03-container"><span
                                                class="select2-selection__rendered" id="select2-community-03-container"
                                                title="Not prefer to say"><span
                                                    class="select2-selection__clear">×</span>Not prefer to
                                                say</span><span class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="religion" class="col-sm-2 asterisk control-label">Religion</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="religion">

                                <select class="form-control religion select2-hidden-accessible" style="width: 100%;"
                                    name="religion" data-value="Not prefer to say" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Christian">Christian</option>
                                    <option value="Other">Other</option>
                                    <option value="Not prefer to say" selected="">Not prefer to say</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-religion-r6-container"><span
                                                class="select2-selection__rendered" id="select2-religion-r6-container"
                                                title="Not prefer to say"><span
                                                    class="select2-selection__clear">×</span>Not prefer to
                                                say</span><span class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="qualification" class="col-sm-2 asterisk control-label">Qualification</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="qualification">

                                <select class="form-control qualification select2-hidden-accessible"
                                    style="width: 100%;" name="qualification" data-value="SSLC" tabindex="-1"
                                    aria-hidden="true">
                                    <option value=""></option>
                                    <option value="SSLC" selected="">SSLC</option>
                                    <option value="HSC">HSC</option>
                                    <option value="UG">UG</option>
                                    <option value="PG">PG</option>
                                    <option value="Other">Other</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-qualification-at-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-qualification-at-container" title="SSLC"><span
                                                    class="select2-selection__clear">×</span>SSLC</span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="marital_status" class="col-sm-2 asterisk control-label">Marital status</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="marital_status">

                                <select class="form-control marital_status select2-hidden-accessible"
                                    style="width: 100%;" name="marital_status" data-value="Single" tabindex="-1"
                                    aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Single" selected="">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Other">Other</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-marital_status-77-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-marital_status-77-container" title="Single"><span
                                                    class="select2-selection__clear">×</span>Single</span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="monthly_income" class="col-sm-2 asterisk control-label">Monthly income</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input class="numberic form-control form-control" type="text" id="monthly_income"
                                        name="monthly_income" value="" placeholder="Input Monthly income">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="monthly_expenses" class="col-sm-2 asterisk control-label">Monthly
                                expenses</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input class="numberic form-control" type="text" id="monthly_expenses"
                                        name="monthly_expenses" value="" placeholder="Input Monthly expenses">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="home_status" class="col-sm-2 asterisk control-label">Home status</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="home_status">

                                <select class="form-control home_status select2-hidden-accessible" style="width: 100%;"
                                    name="home_status" data-value="Own" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Own" selected="">Own</option>
                                    <option value="Rent">Rent</option>
                                    <option value="Lease">Lease</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-home_status-z5-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-home_status-z5-container" title="Own"><span
                                                    class="select2-selection__clear">×</span>Own</span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="date_of_joined" class="col-sm-2 asterisk control-label">Date of joined</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>

                                    <input style="width: 110px" type="text" id="date_of_joined" name="date_of_joined"
                                        value="2024-02-27" class="form-control date_of_joined"
                                        placeholder="Input Date of joined">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="status" class="col-sm-2 asterisk control-label">Member status</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="status">

                                <select class="form-control status select2-hidden-accessible" style="width: 100%;"
                                    name="status" data-value="1" tabindex="-1" aria-hidden="true">
                                    <option value=""></option>
                                    <option value="1" selected="">Active</option>
                                    <option value="0">In Active</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-status-pe-container"><span
                                                class="select2-selection__rendered" id="select2-status-pe-container"
                                                title="Active"><span
                                                    class="select2-selection__clear">×</span>Active</span><span
                                                class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-form-2">
                        <div class="form-group  ">

                            <label for="father_name" class="col-sm-2 asterisk control-label">Father Name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="father_name" name="father_name" value=""
                                        class="form-control father_name" placeholder="Input Father Name">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="mother_name" class="col-sm-2 asterisk control-label">Mother Name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="mother_name" name="mother_name" value=""
                                        class="form-control mother_name" placeholder="Input Mother Name">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="spouse_name" class="col-sm-2 asterisk control-label">Spouse Name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="spouse_name" name="spouse_name" value=""
                                        class="form-control spouse_name" placeholder="Input Spouse Name">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="spouse_occupation" class="col-sm-2 asterisk control-label">Spouse
                                Occupation</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="spouse_occupation" name="spouse_occupation" value=""
                                        class="form-control spouse_occupation" placeholder="Input Spouse Occupation">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="no_of_adult" class="col-sm-2 asterisk control-label">Number of Adult</label>

                            <div class="col-sm-8">


                                <div class="input-group">


                                    <div class="input-group">

                                        <input id="adult" min="0" max="10" style="width: 100px; text-align: center;"
                                            type="text" name="no_of_adult" value="0"
                                            class="form-control no_of_adult initialized"
                                            placeholder="Input Number of Adult" />

                                    </div>



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="no_of_children" class="col-sm-2 asterisk control-label">Number of
                                children</label>

                            <div class="col-sm-8">


                                <div class="input-group">


                                    <div class="input-group"><span class="input-group-btn"><button type="button"
                                                class="btn btn-primary">-</button></span><input id="child" min="0"
                                            max="10" style="width: 100px; text-align: center;" type="text"
                                            name="no_of_children" value="0"
                                            class="form-control no_of_children initialized"
                                            placeholder="Input Number of children"><span class="input-group-btn"><button
                                                type="button" class="btn btn-success">+</button></span></div>



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="total_family_members" class="col-sm-2 asterisk control-label">Total Family
                                Members</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input id="total_member" readonly="" type="text" name="total_family_members"
                                        value="0" class="form-control total_family_members"
                                        placeholder="Input Total Family Members">



                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-form-3">
                        <div class="form-group  ">

                            <label for="smartcard_no" class="col-sm-2 asterisk control-label">SmartCard No</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="smartcard_no" name="smartcard_no" value=""
                                        class="form-control smartcard_no" placeholder="Input SmartCard No">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="voter_id" class="col-sm-2 asterisk control-label">Voter ID</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="voter_id" name="voter_id" value=""
                                        class="form-control voter_id" placeholder="Input Voter ID">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="aadhar_no" class="col-sm-2 asterisk control-label">Aadhar Card Number</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input class="form-control numberic" type="text" id="aadhar_no" name="aadhar_no"
                                        value="" placeholder="Input Aadhar Card Number">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="pancard_img" class="col-sm-2  control-label">PAN Card Photo</label>

                            <div class="col-sm-8">


                                <div class="file-input file-input-new">
                                    <div class="file-preview ">
                                        <button type="button" class="close fileinput-remove" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="file-drop-disabled">
                                            <div class="file-preview-thumbnails">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="file-preview-status text-center text-success"></div>
                                            <div class="kv-fileinput-error file-error-message" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kv-upload-progress kv-hidden" style="display: none;">
                                        <div class="progress">
                                            <div class="progress-bar bg-success progress-bar-success progress-bar-striped active"
                                                role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100" style="width:0%;">
                                                0%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="input-group file-caption-main">
                                        <div class="file-caption form-control  kv-fileinput-caption" tabindex="500">
                                            <span class="file-caption-icon"></span>
                                            <input class="file-caption-name" onkeydown="return false;"
                                                onpaste="return false;" placeholder="Select image">
                                        </div>
                                        <div class="input-group-btn input-group-append">



                                            <div tabindex="500" class="btn btn-primary btn-file"><i
                                                    class="glyphicon glyphicon-folder-open"></i>&nbsp; <span
                                                    class="hidden-xs">Browse</span><input type="file"
                                                    class="pancard_img" name="pancard_img" id="1709028743790_51">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="pancard_no" class="col-sm-2  control-label">PAN Card Number</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="pancard_no" name="pancard_no" value=""
                                        class="form-control pancard_no" placeholder="Input PAN Card Number">



                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-form-4">
                        <div class="form-group  ">

                            <label for="nominee_name" class="col-sm-2 asterisk control-label">Nominee name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="nominee_name" name="nominee_name" value=""
                                        class="form-control nominee_name" placeholder="Input Nominee name">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_mobile" class="col-sm-2 asterisk control-label">Nominee mobile</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="nominee_mobile" name="nominee_mobile" value=""
                                        class="form-control nominee_mobile" placeholder="Input Nominee mobile">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="relation_with_client" class="col-sm-2  control-label">Relation with
                                Member</label>

                            <div class="col-sm-8">


                                <input type="hidden" name="relation_with_client">

                                <select class="form-control relation_with_client select2-hidden-accessible"
                                    style="width: 100%;" name="relation_with_client" data-value="" tabindex="-1"
                                    aria-hidden="true">
                                    <option value=""></option>
                                    <option value="Mother">Mother</option>
                                    <option value="Father">Father</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Husband">Husband</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Other">Other</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    style="width: 100%;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-relation_with_client-nl-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-relation_with_client-nl-container"><span
                                                    class="select2-selection__placeholder">Relation with
                                                    Member</span></span><span class="select2-selection__arrow"
                                                role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_dob" class="col-sm-2 asterisk control-label">Nominee dob</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>

                                    <input style="width: 110px" type="text" id="nominee_dob" name="nominee_dob"
                                        value="2024-02-27" class="form-control nominee_dob"
                                        placeholder="Input Nominee dob">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_aadhar" class="col-sm-2 asterisk control-label">Nominee Aadhar
                                Number</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input class="numeric form-control" type="text" id="nominee_aadhar"
                                        name="nominee_aadhar" value="" placeholder="Input Nominee Aadhar Number">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_voter_img" class="col-sm-2  control-label">Nominee voter Photo</label>

                            <div class="col-sm-8">


                                <div class="file-input file-input-new">
                                    <div class="file-preview ">
                                        <button type="button" class="close fileinput-remove" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="file-drop-disabled">
                                            <div class="file-preview-thumbnails">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="file-preview-status text-center text-success"></div>
                                            <div class="kv-fileinput-error file-error-message" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kv-upload-progress kv-hidden" style="display: none;">
                                        <div class="progress">
                                            <div class="progress-bar bg-success progress-bar-success progress-bar-striped active"
                                                role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100" style="width:0%;">
                                                0%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="input-group file-caption-main">
                                        <div class="file-caption form-control  kv-fileinput-caption" tabindex="500">
                                            <span class="file-caption-icon"></span>
                                            <input class="file-caption-name" onkeydown="return false;"
                                                onpaste="return false;" placeholder="Select image">
                                        </div>
                                        <div class="input-group-btn input-group-append">



                                            <div tabindex="500" class="btn btn-primary btn-file"><i
                                                    class="glyphicon glyphicon-folder-open"></i>&nbsp; <span
                                                    class="hidden-xs">Browse</span><input type="file"
                                                    class="nominee_voter_img" name="nominee_voter_img"
                                                    id="1709028743804_2"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_voter_id" class="col-sm-2  control-label">Nominee voter Number</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input class="numeric form-control" type="text" id="nominee_voter_id"
                                        name="nominee_voter_id" value="" placeholder="Input Nominee voter Number">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_other_img" class="col-sm-2  control-label">Nominee Other Photo</label>

                            <div class="col-sm-8">


                                <div class="file-input file-input-new">
                                    <div class="file-preview ">
                                        <button type="button" class="close fileinput-remove" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="file-drop-disabled">
                                            <div class="file-preview-thumbnails">
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="file-preview-status text-center text-success"></div>
                                            <div class="kv-fileinput-error file-error-message" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kv-upload-progress kv-hidden" style="display: none;">
                                        <div class="progress">
                                            <div class="progress-bar bg-success progress-bar-success progress-bar-striped active"
                                                role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100" style="width:0%;">
                                                0%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="input-group file-caption-main">
                                        <div class="file-caption form-control  kv-fileinput-caption" tabindex="500">
                                            <span class="file-caption-icon"></span>
                                            <input class="file-caption-name" onkeydown="return false;"
                                                onpaste="return false;" placeholder="Select image">
                                        </div>
                                        <div class="input-group-btn input-group-append">



                                            <div tabindex="500" class="btn btn-primary btn-file"><i
                                                    class="glyphicon glyphicon-folder-open"></i>&nbsp; <span
                                                    class="hidden-xs">Browse</span><input type="file"
                                                    class="nominee_other_img" name="nominee_other_img"
                                                    id="1709028743811_84"></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="nominee_other_id" class="col-sm-2  control-label">Nominee Other Number</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="nominee_other_id" name="nominee_other_id" value=""
                                        class="form-control nominee_other_id" placeholder="Input Nominee Other Number">



                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-form-5">
                        <div class="form-group  ">

                            <label for="account_holder_name" class="col-sm-2  control-label">Account Holder
                                name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="account_holder_name" name="account_holder_name" value=""
                                        class="form-control account_holder_name"
                                        placeholder="Input Account Holder name">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="account_number" class="col-sm-2  control-label">Account Number</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="account_number" name="account_number" value=""
                                        class="form-control account_number" placeholder="Input Account Number">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="bank_name" class="col-sm-2  control-label">Bank Name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="bank_name" name="bank_name" value=""
                                        class="form-control bank_name" placeholder="Input Bank Name">



                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="ifsc_number" class="col-sm-2  control-label">IFSC Code</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="ifsc_number" name="ifsc_number" value=""
                                        class="form-control ifsc_number" placeholder="Input IFSC Code">
                                </div>


                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="branch_name" class="col-sm-2  control-label">Branch Name</label>

                            <div class="col-sm-8">


                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                    <input type="text" id="branch_name" name="branch_name" value=""
                                        class="form-control branch_name" placeholder="Input Branch Name">



                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">

            <input type="hidden" name="_token" value="DtuEzWf2Rmnkt8xMAJaZnCM19Ot8JPZJHvSnuLsB" autocomplete="off">

            <div class="col-md-2">
            </div>

            <div class="col-md-8">

                <div class="btn-group pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>



            </div>
        </div>
        <script src="{{ asset('/vendor/laravel-admin/number-input/bootstrap-number-input.js') }}"></script>
        <script src="{{ asset('/vendor/laravel-admin/moment/min/moment-with-locales.min.js') }}"></script>
        <script
            src="{{ asset('/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

        <script>
            $('#adult').bootstrapNumber({
                upClass: 'success',
                downClass: 'default',
                center: true
            });
            $('#dob_date').datetimepicker({
                format: 'DD-MM-YYYY',

            })
        </script>

        <!-- /.box-footer -->
    </form>

    @livewireScripts
</div>