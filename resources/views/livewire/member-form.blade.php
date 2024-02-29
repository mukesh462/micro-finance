<div>
    <div class="bs-example">

        <div id="myModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Image preview
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body" id="open_preview">
                        <!-- <img id="" src="" width="150" height="150" alt="" srcset=""> -->
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancel
                        </button> -->
                        <button type="button" data-dismiss="modal" id="reset-form" class="btn btn-primary">
                            Ok
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireStyles
    <form wire:submit.prevent="submitForm" class="form-horizontal model-form-65ddb585837bb" accept-charset="UTF-8">

        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active tab-link">
                        <a href="#tab-form-1" data-toggle="tab">
                            Member Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-2 " data-toggle="tab">
                            Member Family Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-3 " data-toggle="tab">
                            Member Document <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-4 " data-toggle="tab">
                            Nominee Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-5 " data-toggle="tab">
                            Bank Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>

                </ul>
                <div class="tab-content fields-group">

                    <div class="tab-pane active container" id="tab-form-1" style='max-width:100%!important'>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class=" ">
                                    <label class="  control-label">Member ID</label>

                                    <div class="box box-solid box-default no-margin">
                                        <!-- /.box-header -->
                                        <div class="" style="padding: 6px;">
                                            4
                                        </div><!-- /.box-body -->
                                    </div>



                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Member name',
                                    'name' => 'client_name',
                                    'isRequired' => true,
                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="dob" class=" asterisk control-label">DOB</label>

                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>

                                            <input id="dob" type="text" name="dob" value="" class="form-control dob"
                                                placeholder="Input DOB">
                                        </div>


                                    </div>
                                </div>
                                <div class="">
                                    <div class="  " style="margin: 0!important">
                                        <label for="gender" class="asterisk  control-label">Gender</label>
                                        <div class="">
                                            <select class="form-control gender " style="" name="gender" data-value=""
                                                tabindex="-1" aria-hidden="true">
                                                <option value=""></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Address',
                                    'name' => 'address',
                                    'isRequired' => true,
                                    ])

                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'State',
                                    'name' => 'state',

                                    ])

                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="community" class=" asterisk control-label">Community</label>

                                    <div class="">
                                        <select class="form-control community " style="width: 100%;" name="community"
                                            data-value="Not prefer to say" tabindex="-1" aria-hidden="true">
                                            <option value=""></option>
                                            <option value="BC">BC</option>
                                            <option value="MBC">MBC</option>
                                            <option value="SC">SC</option>
                                            <option value="ST">ST</option>
                                            <option value="Other">Other</option>
                                            <option value="Not prefer to say" selected="">Not prefer to say</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="qualification" class=" asterisk control-label">Qualification</label>

                                    <div class="">
                                        <select class="form-control" name="qualification" tabindex="-1"
                                            aria-hidden="true">
                                            <option value=""></option>
                                            <option value="SSLC" selected="">SSLC</option>
                                            <option value="HSC">HSC</option>
                                            <option value="UG">UG</option>
                                            <option value="PG">PG</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Monthly income',
                                    'name' => 'monthly_income',

                                    ])

                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="home_status" class=" asterisk control-label">Home status</label>
                                    <div class="">
                                        <select class="form-control home_status " style="width: 100%;"
                                            name="home_status">
                                            <option value="Own" selected>Own</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Lease">Lease</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="status" class=" asterisk control-label">Member status</label>
                                    <select class="form-control status " name="status">

                                        <option value="1" selected>Active</option>
                                        <option value="0">In Active</option>
                                    </select>



                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">

                                <div class="">

                                    <label for="center_id" class=" asterisk control-label">Select Center
                                    </label>

                                    <div class="">
                                        <select wire:model='center_id' class="form-control center_id " style=""
                                            name="center_id" data-value="" tabindex="-1" aria-hidden="true">
                                            <option value=""></option>
                                            <option value="1">001 - Madurai</option>
                                            <option value="2">002 - Tirupur</option>

                                        </select>
                                        @error('center_id')
                                        <span class="error">{{ $message }}</span>
                                        @enderror



                                    </div>
                                </div>
                                <div class="">
                                    ffwfw
                                    @livewire('image-uploader',['img'=>'photo_img'])

                                    <!-- <label for="photo" class="  control-label">Photo</label>


                                    <input class=" form-control" placeholder="Select image"> -->




                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="age" class="  control-label">Age</label>

                                    <div class="">


                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>

                                            <input id="age" readonly="" disabled="" type="text" name="age" value=""
                                                class="form-control age" placeholder="Input Age">



                                        </div>


                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Mobile',
                                    'name' => 'phone_number',
                                    'isRequired' => true,
                                    ])
                                </div>
                                <div class=" ">
                                    @include('livewire.text-input', [
                                    'label' => 'City',
                                    'name' => 'city',
                                    'isRequired' => true,
                                    ])




                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Pincode',
                                    'name' => 'pincode',

                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="religion" class=" asterisk control-label">Religion</label>
                                    <div class="">
                                        <select class=" form-control " style=" width: 100%;" name="religion"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="Hindu">Hindu</option>
                                            <option value="Muslim">Muslim</option>
                                            <option value="Christian">Christian</option>
                                            <option value="Other">Other</option>
                                            <option value="Not prefer to say" selected>Not prefer to say</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="marital_status" class=" asterisk control-label">Marital status</label>
                                    <div class="">
                                        <select class="form-control marital_status " style="width: 100%;"
                                            name="marital_status" data-value="Single" tabindex="-1" aria-hidden="true">
                                            <option value=""></option>
                                            <option value="Single" selected>Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Monthly Expenses',
                                    'name' => 'monthly_expenses',
                                    'isRequired'=>true

                                    ])

                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Date of joined',
                                    'name' => 'date_of_joined',
                                    'isRequired'=>true

                                    ])

                                </div>

                            </div>
                        </div>







                    </div>
                    <div class="tab-pane container " id="tab-form-2">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                'label' => 'Father Name',
                                'name' => 'father_name',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Mother Name',
                                'name' => 'mother_name',
                                'isRequired' => true,
                                ])


                            </div>
                            <div class="col-12 col-md-6 col-lg-6"> @include('livewire.text-input', [
                                'label' => 'Spouse Name',
                                'name' => 'spouse_name',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Spouse Occupation',
                                'name' => 'spouse_occupation',
                                'isRequired' => true,
                                ])</div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label for="no_of_adult">No of Ad</label>
                                    <input type="number" min="0" name="no_of_adult" value="0" class="form-control"
                                        id="no_of_adult">

                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label for="no_of_children">No of child</label>
                                    <input type="number" min="0" name="no_of_children" value="0" class="form-control"
                                        id="no_of_children">
                                </div>
                                <div class="col-12 col-md-4 col-lg-4" style="margin-bottom: 2px;">
                                    @include('livewire.text-input', [
                                    'label' => 'Total Family Members',
                                    'name' => 'total_family_members',
                                    'isRequired' => false,
                                    'disabled'=>true
                                    ])
                                </div>



                            </div>
                        </div>




                    </div>
                    <div class="tab-pane container" id="tab-form-3">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                'label' => 'SmartCard No',
                                'name' => 'smartcard_no',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Voter ID',
                                'name' => 'voter_id',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Aadhar Card Number',
                                'name' => 'aadhar_no',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Pan No',
                                'name' => 'pancard_no',
                                'isRequired' => true,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6" style="margin-top: 5px;">
                                <div class="">
                                    <label for="smartcard_img" class="  control-label">SmartCard Img</label>
                                    <div class=" " style="display: flex;">

                                        <input class="form-control" type="file" name="smartcard_img" id="smartcard_img"
                                            placeholder="Select image">
                                        <button type="button" class="btn btn-sm btn-info" id="smart_card"
                                            style="display: none;">show</button>
                                    </div>

                                </div>
                                <div class="">
                                    <label for="voterid_img" class="  control-label">Voter ID Img</label>
                                    <input class=" form-control" name="voterid_img" id="voterid_img"
                                        placeholder="Select image">
                                </div>
                                <div class="">
                                    <label for="aadhar_img" class="  control-label">AadharCard Img</label>
                                    <input class=" form-control" name="aadhar_img" id="aadhar_img"
                                        placeholder="Select image">
                                </div>
                                <div class="">
                                    <label for="pancard_img" class="  control-label">Pan Img</label>
                                    <input class=" form-control" name="pancard_img" id="pancard_img"
                                        placeholder="Select image">
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="tab-pane container" id="tab-form-4">

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">

                                @include('livewire.text-input', [
                                'label' => 'Nominee name',
                                'name' => 'nominee_name',
                                'isRequired' => true,
                                ]) <div class="form-group  " style="margin: 0;">
                                    <label for="relation_with_client" class="  control-label">Relation with
                                        Member</label>
                                    <select class="form-control relation_with_client " style="width: 100%;"
                                        name="relation_with_client" data-value="" tabindex="-1" aria-hidden="true">
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Wife">Wife</option>
                                        <option value="Husband">Husband</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                @include('livewire.text-input', [
                                'label' => 'Nominee Aadhar',
                                'name' => 'nominee_aadhar',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Nominee Voter ID',
                                'name' => 'nominee_voter_id',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Nominee Other Number',
                                'name' => 'nominee_other_id',
                                'isRequired' => true,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                'label' => 'Nominee mobile',
                                'name' => 'nominee_mobile',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Nominee dob',
                                'name' => 'nominee_dob',
                                'isRequired' => true,
                                ])
                                <div class="">
                                    <label for="nominee_aadhar_img" class="  control-label">Nominee Aadhar Photo</label>
                                    <input class=" form-control" name="nominee_aadhar_img" id="nominee_aadhar_img"
                                        placeholder="Select image">
                                </div>
                                <div class="">
                                    <label for="nominee_voter_img" class="  control-label">Nominee VoterID
                                        Photo</label>
                                    <input class=" form-control" name="nominee_voter_img" id="nominee_voter_img"
                                        placeholder="Select image">
                                </div>
                                <div class="">
                                    <label for="nominee_other_img" class="  control-label">Nominee Other Photo</label>
                                    <input class=" form-control" name="nominee_other_img" id="nominee_other_img"
                                        placeholder="Select image">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane container " id="tab-form-5">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                'label' => 'Account Holder name',
                                'name' => 'account_holder_name',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Account Number',
                                'name' => 'account_number',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Bank Name',
                                'name' => 'bank_name',
                                'isRequired' => true,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6"> @include('livewire.text-input', [
                                'label' => 'IFSC Code',
                                'name' => 'ifsc_number',
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Branch Name',
                                'name' => 'branch_name',
                                'isRequired' => true,
                                ])</div>
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
        <script src="{{asset('/vendor/laravel-admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}"></script>
        <script src="{{asset('/vendor/laravel-admin/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
        <script
            src="{{ asset('/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

        <script>
            $('#no_of_adult').bootstrapNumber({
                upClass: 'success',
                downClass: 'default',
                center: true
            }); $('#no_of_children').bootstrapNumber({
                upClass: 'success',
                downClass: 'default',
                center: true
            });
            $('#dob').datetimepicker({
                format: 'DD-MM-YYYY',

            })
            $("#smartcard_img").on('change', function (eve) {
                console.log(eve, 'fwfw');
                var file = this.files[0];
                var imageType = /^image\//;

                if (!file || !imageType.test(file.type)) {
                    alert('Please select an image file.');
                    this.value = '';
                    return;
                }
                $('#smart_card').css({ display: 'block' })
                //var reader = new FileReader();
                // reader.onload = function (e) {
                //      var preview = document.getElementById('imagePreview');
                //       preview.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview">';
                //       preview.style.display = 'block';
                //   }
                //   reader.readAsDataURL(file);
            });
            $('#smart_card').on('click', () => {
                $('#myModal').model('show');
                $('#smartcard_img')
            })
            $(document).ready(function () {
                // Handle tab shown event
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    // Get the newly activated tab
                    var targetTab = $(e.target).attr('href');
                    // Update URL with tab ID
                    console.log(targetTab, 'yhuy');
                    history.pushState(null, null, '?tab=' + $(e.target).attr('href'));
                });

                // Check URL for tab parameter on page load
                // var urlParams = new URLSearchParams(window.location.search);
                var urlHash = window.location.hash;

                // var tabParam = urlParams.get();
                console.log(urlHash, 'gfgvfh');
                if (urlHash) {
                    $('.tab-link a[href="' + urlHash + '"]').tab('show');
                    //console.log($('.tab-link a[href="' + urlHash + '"]').tab('show'), 'efegegeg');
                }
            });
            $(function () {
                $("#dob").on("blur", function (e) {
                    var dateParts = $(this).val().split("-");
                    var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
                    const current = new Date(formattedDate).getFullYear() - new Date().getFullYear();
                    $("#age").val(Math.abs(current));
                });


                // $("#adult").on("input", function () {
                //     this.value = this.value.replace(/[^0-9]/g, "");
                // });
                // $("#child").on("input", function () {
                //     this.value = this.value.replace(/[^0-9]/g, "");
                // });
                $("#no_of_adult").on("change", function () {
                    this.value = this.value.replace(/[^0-9]/g, "");
                    var adult = parseInt($("#no_of_adult").val())
                    var child = parseInt($("#no_of_children").val())
                    console.log(adult, child)
                    var total = adult + child
                    $("#total_family_members").val(total)
                })
                $("#no_of_children").on("change", function () {
                    this.value = this.value.replace(/[^0-9]/g, "");
                    var adult = parseInt($("#no_of_adult").val())
                    var child = parseInt($("#no_of_children").val())
                    console.log(adult, child)
                    var total = adult + child
                    $("#total_family_members").val(total)
                })



            });
        </script>

        <!-- /.box-footer -->
    </form>

    @livewireScripts
</div>