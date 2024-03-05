<div>

    <script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/number-input/bootstrap-number-input.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/moment/min/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script
        src="{{ asset('/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
    </script>
    <script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>

    <style>
        .select2 {
            width: 100% !important;
        }
    </style>

    @php
        $centers = \App\Models\Center::select(
            DB::raw('CONCAT("00",id, " - ", center_name) as center_name'),
            'id',
        )->get();
        $member = \App\Models\Member::orderBy('id','desc')->first();
        if(is_object($member)){
            $member_id = $member->id + 1;
        }else{
            $member_id = 1;
        }
    @endphp
    <form action="/admin/member/save" method="post" enctype="multipart/form-data">

        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active tab-link">
                        <a href="#tab-form-1" id="tab-form-1-tab" data-toggle="tab">
                            Member Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-2 " id="tab-form-2-tab" data-toggle="tab">
                            Member Family Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-3 " id="tab-form-3-tab" data-toggle="tab">
                            Member Document <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-4 " id="tab-form-4-tab" data-toggle="tab">
                            Nominee Details <i class="fa fa-exclamation-circle text-red hide"></i>
                        </a>
                    </li>
                    <li class="tab-link">
                        <a href="#tab-form-5 " id="tab-form-5-tab" data-toggle="tab">
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
                                         {{$member_id}}
                                        </div><!-- /.box-body -->
                                    </div>



                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Member name',
                                        'name' => 'client_name',
                                        'isRequired' => true,
                                        'value'=> old('client_name')
                                    ])
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'DOB',
                                        'name' => 'dob',
                                        'isRequired' => true,
                                        'value'=> old('dob')
                                    ])

                                </div>
                                @csrf

                                <div class="  " style="margin: 0!important;width:100%">
                                    <label for="gender" class="asterisk  control-label">Gender</label>
                                    <div class="">
                                        <select class=" gender " wire:ignore wire:mode="gender" id="gender" name="gender" >
                                            <option value="" {{ old('gender') == '' ? 'selected' : '' }}>--- Select Gender ---</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('gender')
                                        <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                    </div>
                                </div>

                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Address',
                                        'name' => 'address',
                                        'isRequired' => true,
                                        'value'=> old('address')
                                    ])

                                </div>
                                <div class="">
                                @include('livewire.text-input', [
                                'label' => 'State',
                                'name' => 'state',
                                'value' => old('state')
                             ])
                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="community" class=" asterisk control-label">Community</label>

                                    <div class="">
                                        <select class="form-control community " style="width: 100%;" name="community">
                                            <option value="" {{ old('community') == '' ? 'selected' : '' }}>Select Community</option>
                                            <option value="BC" {{ old('community') == 'BC' ? 'selected' : '' }}>BC</option>
                                            <option value="MBC" {{ old('community') == 'MBC' ? 'selected' : '' }}>MBC</option>
                                            <option value="SC" {{ old('community') == 'SC' ? 'selected' : '' }}>SC</option>
                                            <option value="ST" {{ old('community') == 'ST' ? 'selected' : '' }}>ST</option>
                                            <option value="Other"{{ old('community') == 'Other' ? 'selected' : '' }}>Other</option>
                                            <option value="Not prefer to say" {{ old('community') == 'Not prefer to say' ? 'selected' : '' }}>Not prefer to say</option>
                                        </select>
                                        @error('community')
                                        <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">

                                    <label for="qualification" class=" asterisk control-label">Qualification</label>

                                    <div class="">
                                        <select class="form-control" name="qualification" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="" {{ old('qualification') == '' ? 'selected' : '' }}>Select qualification</option>
                                            <option value="SSLC" {{ old('qualification') == 'SSLC' ? 'selected' : '' }}>SSLC</option>
                                            <option value="HSC" {{ old('qualification') == 'HSC' ? 'selected' : '' }}>HSC</option>
                                            <option value="UG" {{ old('qualification') == 'UG' ? 'selected' : '' }}>UG</option>
                                            <option value="PG" {{ old('qualification') == 'PG' ? 'selected' : '' }}>PG</option>
                                            <option value="Other" {{ old('qualification') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('qualification')
                                        <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Monthly income',
                                        'name' => 'monthly_income',
                                        'value' => old('monthly_income')
                                    ])

                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="home_status" class=" asterisk control-label">Home status</label>
                                    <div class="">
                                        <select class="form-control home_status " style="width: 100%;" name="home_status">
                                        <option value="" {{ old('home_status') == '' ? 'selected' : '' }}>Select Home Status</option>
                                            <option value="Own" {{ old('home_status') == 'Own' ? 'selected' : '' }}>Own</option>
                                            <option value="Rent" {{ old('home_status') == 'Rent' ? 'selected' : '' }}>Rent</option>
                                            <option value="Lease" {{ old('home_status') == 'Lease' ? 'selected' : '' }}>Lease</option>
                                        </select>
                                        @error('home_status')
                                        <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="status" class=" asterisk control-label">Member status</label>
                                    <select class="form-control status " name="status">
                                    <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Member Status</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>In Active</option>

                                    </select>
                                    @error('status')
                                    <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="">
                                    <label for="center_id" class=" asterisk control-label">Select Center
                                    </label>
                                    <div class="">
                                        <select wire:model='center_id' class="form-control center_id " style=""
                                            name="center_id" data-value="" id="center_id" tabindex="-1"
                                            aria-hidden="true" name="center_id">
                                            <option value="" {{ old('center_id') == '' ? 'selected' : '' }}>--- Select Center ---</option>
                                            @foreach ($centers as $value)
                                                <option value="{{ $value->id}}"  {{ old('center_id') == $value->id ? 'selected' : ''}}>{{ $value->center_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('center_id')
                                            <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.image-uploader', [
                                        'img' => 'image',
                                        'label' => 'Photo',
                                        'value' => old('image') ? old('image') : '',
                                         "name" =>"image"
                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="age" class="  control-label">Age</label>
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input id="age" readonly="" disabled="" type="text"
                                                name="age" value="" class="form-control age"
                                                placeholder="Input Age">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Mobile',
                                        'name' => 'phone_number',
                                        'value' => old('phone_number')
                                    ])
                                </div>
                                <div class=" ">
                                    @include('livewire.text-input', [
                                        'label' => 'City',
                                        'name' => 'city',
                                        'value' => old('city')
                                    ])
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Pincode',
                                        'name' => 'pincode',
                                        'value' => old('pincode')
                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="religion" class=" asterisk control-label">Religion</label>
                                    <div class="">
                                        <select class=" form-control " style=" width: 100%;" name="religion"
                                            tabindex="-1" aria-hidden="true" >
                                            <option value="" {{ old('religion') == '' ? 'selected' : '' }}>Select Religion</option>
                                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Muslim" {{ old('religion') == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                            <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>Christian</option>
                                            <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                                            <option value="Not prefer to say" {{ old('religion') == 'Not prefer to say' ? 'selected' : '' }}>Not prefer to say</option>

                                        </select>
                                        @error('religion')
                                        <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="marital_status" class=" asterisk control-label">Marital status</label>
                                    <div class="">
                                        <select class="form-control marital_status " style="width: 100%;"
                                            name="marital_status" data-value="Single" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="" {{ old('marital_status') == '' ? 'selected' : '' }}>Select Marital Status</option>
                                            <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                            <option value="Married"  {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                            <option value="Widow" {{ old('marital_status') == 'Widow' ? 'selected' : '' }}>Widow</option>
                                            <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                            <option value="Other" {{ old('marital_status') == 'Other' ? 'selected' : '' }}>Other</option>

                                        </select>
                                        @error('marital_status')
                                        <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Monthly Expenses',
                                        'name' => 'monthly_expenses',
                                        'value' => old('monthly_expenses')
                                    ])

                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                        'label' => 'Date of joined',
                                        'name' => 'date_of_joined',
                                        'value' => old('date_of_joined')
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container " id="tab-form-2" style='max-width:100%!important'>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                    'label' => 'Father Name',
                                    'name' => 'father_name',
                                    'value' => old('father_name')
                                ])
                                @include('livewire.text-input', [
                                    'label' => 'Mother Name',
                                    'name' => 'mother_name',
                                    'value' => old('mother_name')
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6"> @include('livewire.text-input', [
                                'label' => 'Spouse Name',
                                'name' => 'spouse_name',
                                'value' => old('spouse_name')
                            ])
                                @include('livewire.text-input', [
                                    'label' => 'Spouse Occupation',
                                    'name' => 'spouse_occupation',
                                    'value' => old('spouse_occupation')
                                ])</div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label for="no_of_adult">No of Ad</label>
                                    <input type="number" min="0" name="no_of_adult"
                                        class="form-control" id="no_of_adult" value="{{old('no_of_adult')}}">
                                        @error('no_of_adult')
            <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                {{ $message }}</label>
        @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <label for="no_of_children">No of child</label>
                                    <input type="number" min="0" name="no_of_children"
                                        class="form-control" id="no_of_children" value="{{old('no_of_children')}}">
                                        @error('no_of_children')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4" style="margin-bottom: 2px;">
                                    @include('livewire.text-input', [
                                        'label' => 'Total Family Members',
                                        'name' => 'total_family_members',
                                        'value'=>old('total_family_members'),
                                        'disabled' => true,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container" id="tab-form-3" style='max-width:100%!important'>
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
                                    @include('livewire.image-uploader', [
                                        'img' => 'smartcard_img',
                                        'label' => 'Smart card img',
                                        'value' => old('smartcard_img') ? old('smartcard_img') : '',
                                         "name" =>"smartcard_img"
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                        'img' => 'voterid_img',
                                        'label' => 'voterid img',
                                        'value' => old('voterid_img') ? old('voterid_img') : '',
                                         "name" =>"voterid_img"
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                        'img' => 'aadhar_img',
                                        'label' => 'Aadhar img',
                                        'value' => old('aadhar_img') ? old('aadhar_img') : '',
                                         "name" =>"aadhar_img"
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                        'img' => 'pancard_img',
                                        'label' => 'pancard img',
                                        'value' => old('pancard_img') ? old('pancard_img') : '',
                                         "name" =>"pancard_img"
                                    ])
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="tab-pane container" id="tab-form-4" style='max-width:100%!important'>

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">

                                @include('livewire.text-input', [
                                    'label' => 'Nominee name',
                                    'name' => 'nominee_name',
                                    'value'=>old('nominee_name'),
                                ]) <div class="form-group  " style="margin: 0;">
                                    <label for="relation_with_client" class="  control-label">Relation with
                                        Member</label>
                                    <select class="form-control relation_with_client" style="width: 100%;"
                                        name="relation_with_client" data-value="" tabindex="-1"
                                        aria-hidden="true">
                                        <option value="" {{ old('relation_with_client') == '' ? 'selected' : '' }}>Select Relationship</option>
                                        <option value="Mother" {{ old('relation_with_client') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                        <option value="Father" {{ old('relation_with_client') == 'Father' ? 'selected' : '' }}>Father</option>
                                        <option value="Wife" {{ old('relation_with_client') == 'Wife' ? 'selected' : '' }}>Wife</option>
                                        <option value="Husband" {{ old('relation_with_client') == 'Husband' ? 'selected' : '' }}>Husband</option>
                                        <option value="Brother" {{ old('relation_with_client') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                        <option value="Sister" {{ old('relation_with_client') == 'Sister' ? 'selected' : '' }}>Sister</option>
                                        <option value="Other" {{ old('relation_with_client') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('relation_with_client')
                                    <label class="control-label" style='color:red;'><i
                                                    class="fa fa-times-circle-o"></i>
                                                {{ $message }}</label>
    @enderror
                                </div>
                                @include('livewire.text-input', [
                                    'label' => 'Nominee Aadhar',
                                    'name' => 'nominee_aadhar',
                                    'value'=>old('nominee_aadhar'),
                                ])
                                @include('livewire.text-input', [
                                    'label' => 'Nominee Voter ID',
                                    'name' => 'nominee_voter_id',
                                    'value'=>old('nominee_voter_id'),
                                ])
                                @include('livewire.text-input', [
                                    'label' => 'Nominee Other Number',
                                    'name' => 'nominee_other_id',
                                    'value'=>old('nominee_other_id'),
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                    'label' => 'Nominee mobile',
                                    'name' => 'nominee_mobile',
                                ])
                                @include('livewire.text-input', [
                                    'label' => 'Nominee dob',
                                    'name' => 'nominee_dob',
                                ])
                                <div class="">
                                    <label for="nominee_aadhar_img" class="  control-label">Nominee Aadhar
                                        Photo</label>
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
                    <div class="tab-pane container " id="tab-form-5" style='max-width:100%!important'>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                    'label' => 'Account Holder name',
                                    'name' => 'account_holder_name',
                                    'value'=>old('nominee_name'),
                                ])
                                @include('livewire.text-input', [
                                    'label' => 'Account Number',
                                    'name' => 'account_number',
                                    'value'=>old('nominee_name'),
                                ])
                                @include('livewire.text-input', [
                                    'label' => 'Bank Name',
                                    'name' => 'bank_name',
                                    'value'=>old('bank_name'),
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6"> @include('livewire.text-input', [
                                'label' => 'IFSC Code',
                                'name' => 'ifsc_number',
                                'value'=>old('ifsc_number'),
                            ])
                                @include('livewire.text-input', [
                                    'label' => 'Branch Name',
                                    'name' => 'branch_name',
                                    'value'=>old('branch_name'),

                                ])</div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">

        @csrf

            <div class="col-md-2">
            </div>

            <div class="col-md-8">

                <div class="btn-group pull-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>



            </div>
        </div>

        </form>


        <script>
            $('#no_of_adult').bootstrapNumber({
                upClass: 'success',
                downClass: 'default',
                center: true
            });
            $('#no_of_children').bootstrapNumber({
                upClass: 'success',
                downClass: 'default',
                center: true
            });
            $('#dob').datetimepicker({
                format: 'DD-MM-YYYY',

            })
            $('#gender').select2()

            $(document).ready(function() {
                // Handle tab shown event
                $('.tab-link a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    // Get the newly activated tab
                    var targetTab = $(e.target).attr('href');
                    // Update URL with tab ID

                    history.pushState(null, null, '?tab=' + $(e.target).attr('href'));
                });

                // Check URL for tab parameter on page load
                // var urlParams = new URLSearchParams(window.location.search);
                var urlHash = window.location.hash;

                // var tabParam = urlParams.get();

                if (urlHash) {
                    $(urlHash).addClass('active');

                    $(`${urlHash}-tab`).click()

                } else {
                    $('#tab-form-1').addClass('active');

                    $(`#tab-form-1-tab`).click()
                }
            });
            $(function() {
                $("#dob").on("blur", function(e) {
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
                $("#no_of_adult").on("change", function() {
                    this.value = this.value.replace(/[^0-9]/g, "");
                    var adult = parseInt($("#no_of_adult").val())
                    var child = parseInt($("#no_of_children").val())
                    console.log(adult, child)
                    var total = adult + child
                    $("#total_family_members").val(total)
                })
                $("#no_of_children").on("change", function() {
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


</div>
