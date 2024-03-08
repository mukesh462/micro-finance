<div>

    <script src="{{ asset('/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/number-input/bootstrap-number-input.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/moment/min/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
    </script>

    <style>
        .select2 {
            width: 100% !important;
        }

        .form-group {
            margin: 0;
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
    $dat = $data->dob ?? '';
    @endphp
    <div class="box-header with-border">
        <h3 class="box-title">{{$type}}</h3>

        <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 5px">
                <a href="/admin/members" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
            </div>
        </div>
    </div>
    <form action="{{ $type == 'create' ? '/admin/member/save' : '/admin/member/edit'}}" method="post" enctype="multipart/form-data">

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
                                            @if($type == "edit")
                                            {{$data->id}}
                                            @else
                                            {{$member_id}}
                                            @endif

                                        </div><!-- /.box-body -->
                                    </div>
                                </div>
                                <input hidden  value="{{(isset($data->id) ? $data->id : '')}}" name="create"/>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Member name',
                                    'name' => 'client_name',
                                    'isRequired' => true,
                                    'value' => old('client_name', isset($data) ? $data->client_name : '')
                                    ])
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'DOB',
                                    'name' => 'dob',
                                    'id'=>'dob',
                                    'isRequired' => true,
                                    'value' => old('dob', isset($data) ? $data->dob : ''),
                                    'autoComplete'=>true
                                    ])

                                </div>
                                @csrf

                                <div class="  " style="margin: 0!important;width:100%">
                                    <label for="gender" class="asterisk  control-label">Gender</label>
                                    <div class="">
                                        <select class="gender" wire:ignore wire:mode="gender" id="gender" name="gender">
                                            <option value="">--- Select Gender ---</option>
                                            <option value="Male" {{ (old('gender') == 'Male' || (isset($data) && $data->gender == 'Male')) ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ (old('gender') == 'Female' || (isset($data) && $data->gender == 'Female')) ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ (old('gender') == 'Other' || (isset($data) && $data->gender == 'Other')) ? 'selected' : '' }}>Other</option>
                                        </select>

                                        @error('gender')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Address',
                                    'name' => 'address',
                                    'isRequired' => true,
                                    'value'=> old('address', isset($data) ? $data->address : ''),
                                    ])
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'State',
                                    'name' => 'state',
                                    'value'=> old('state', isset($data) ? $data->state : ''),
                                    'isRequired' => false,
                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="community" class="asterisk control-label">Community</label>
                                    <div class="">
                                        <select id="commu" class="form-control community" style="width: 100%;" name="community">
                                            <option value="" {{ (old('community') == '' || (isset($data) && $data->community == '')) ? 'selected' : '' }}>Select Community</option>
                                            <option value="BC" {{ (old('community') == 'BC' || (isset($data) && $data->community == 'BC')) ? 'selected' : '' }}>BC</option>
                                            <option value="MBC" {{ (old('community') == 'MBC' || (isset($data) && $data->community == 'MBC')) ? 'selected' : '' }}>MBC</option>
                                            <option value="SC" {{ (old('community') == 'SC' || (isset($data) && $data->community == 'SC')) ? 'selected' : '' }}>SC</option>
                                            <option value="ST" {{ (old('community') == 'ST' || (isset($data) && $data->community == 'ST')) ? 'selected' : '' }}>ST</option>
                                            <option value="Other" {{ (old('community') == 'Other' || (isset($data) && $data->community == 'Other')) ? 'selected' : '' }}>Other</option>
                                            <option value="Not prefer to say" {{ (old('community') == 'Not prefer to say' || (isset($data) && $data->community == 'Not prefer to say')) ? 'selected' : '' }}>Not prefer to say</option>
                                        </select>
                                        @error('community')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group" style="margin: 0;">

                                    <label for="qualification" class=" asterisk control-label">Qualification</label>

                                    <div class="">
                                        <select id="quali" class="form-control" name="qualification" tabindex="-1" aria-hidden="true">
                                            <option value="" {{ (old('qualification') == '' || (isset($data) && $data->qualification == '')) ? 'selected' : '' }}>Select qualification</option>
                                            <option value="SSLC" {{ (old('qualification') == 'SSLC' || (isset($data) && $data->qualification == 'SSLC')) ? 'selected' : '' }}>SSLC</option>
                                            <option value="HSC" {{ (old('qualification') == 'HSC' || (isset($data) && $data->qualification == 'HSC')) ? 'selected' : '' }}>HSC</option>
                                            <option value="UG" {{ (old('qualification') == 'UG' || (isset($data) && $data->qualification == 'UG')) ? 'selected' : '' }}>UG</option>
                                            <option value="PG" {{ (old('qualification') == 'PG' || (isset($data) && $data->qualification == 'PG')) ? 'selected' : '' }}>PG</option>
                                            <option value="Other" {{ (old('qualification') == 'Other' || (isset($data) && $data->qualification == 'Other')) ? 'selected' : '' }}>Other</option>
                                        </select>

                                        @error('qualification')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Monthly income',
                                    'name' => 'monthly_income',
                                    'value' => old('monthly_income',isset($data) ? $data->monthly_income : ''),
                                    'isRequired' => true,
                                    ])

                                </div>
                                <div class="form-group" style="margin: 0;">
                                    <label for="home_status" class=" asterisk control-label">Home status</label>
                                    <div class="">
                                        <select id="home_sta" class="form-control home_status" style="width: 100%;" name="home_status">
                                            <option value="" {{ (old('home_status') == '' || (isset($data) && $data->home_status == '')) ? 'selected' : '' }}>Select Home Status</option>
                                            <option value="Own" {{ (old('home_status') == 'Own' || (isset($data) && $data->home_status == 'Own')) ? 'selected' : '' }}>Own</option>
                                            <option value="Rent" {{ (old('home_status') == 'Rent' || (isset($data) && $data->home_status == 'Rent')) ? 'selected' : '' }}>Rent</option>
                                            <option value="Lease" {{ (old('home_status') == 'Lease' || (isset($data) && $data->home_status == 'Lease')) ? 'selected' : '' }}>Lease</option>
                                        </select>
                                        @error('home_status')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group" style="margin: 0;">
                                    <label for="status" class=" asterisk control-label">Member status</label>
                                    <select id="mem_status" class="form-control status" name="status">
                                        <option value="" {{ (old('status') == '' || (isset($data) && $data->status === null)) ? 'selected' : '' }}>Select Member Status</option>
                                        <option value="1" {{ (old('status') == '1' || (isset($data) && $data->status == 1)) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ (old('status') == '0' || (isset($data) && $data->status == 0)) ? 'selected' : '' }}>In Active</option>
                                    </select>

                                    @error('status')
                                    <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="center_id" class="asterisk control-label">Select Center
                                    </label>
                                    <div class="">
                                        <select id="center_id" class="form-control center_id" name="center_id" data-value="" id="center_id" tabindex="-1" aria-hidden="true" name="center_id">
                                            <option value="" {{ old('center_id') == '' ? 'selected' : '' }}>--- Select Center ---</option>
                                            @foreach ($centers as $value)
                                            <option value="{{ $value->id }}" {{ (old('center_id') == $value->id || (isset($data) && $data->center_id == $value->id)) ? 'selected' : '' }}>
                                                {{ $value->center_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('center_id')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'image',
                                    'label' => 'Photo',
                                    'value' => old('image', isset($data) ? env('APP_URL').'/uploads/'.$data->photo : ''),
                                    "name" =>"image",
                                    'isRequired' => false,
                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="age" class="  control-label">Age</label>
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input id="age" type="text" name="age" value="{{ old('age') ? old('age') : (isset($data->age) ? $data->age : '') }}" class="form-control age" placeholder="Input Age" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Mobile',
                                    'name' => 'phone_number',
                                    'value' => old('phone_number',isset($data) ? $data->phone_number : ''),
                                    'isRequired' => true,
                                    ])
                                </div>
                                <div class=" ">
                                    @include('livewire.text-input', [
                                    'label' => 'City',
                                    'name' => 'city',
                                    'value' => old('city',isset($data) ? $data->city : ''),
                                    'isRequired' => false,
                                    ])
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Pincode',
                                    'name' => 'pincode',
                                    'value' => old('pincode',isset($data) ? $data->pincode : ''),
                                    'isRequired' => false,
                                    ])
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="religion" class=" asterisk control-label">Religion</label>
                                    <div class="">
                                        <select id="reli" class="form-control" style="width: 100%;" name="religion" tabindex="-1" aria-hidden="true">
                                            <option value="" {{ (old('religion') == '' && (!isset($data) || $data->religion === null)) ? 'selected' : '' }}>Select Religion</option>
                                            <option value="Hindu" {{ (old('religion') == 'Hindu' || (isset($data) && $data->religion == 'Hindu')) ? 'selected' : '' }}>Hindu</option>
                                            <option value="Muslim" {{ (old('religion') == 'Muslim' || (isset($data) && $data->religion == 'Muslim')) ? 'selected' : '' }}>Muslim</option>
                                            <option value="Christian" {{ (old('religion') == 'Christian' || (isset($data) && $data->religion == 'Christian')) ? 'selected' : '' }}>Christian</option>
                                            <option value="Other" {{ (old('religion') == 'Other' || (isset($data) && $data->religion == 'Other')) ? 'selected' : '' }}>Other</option>
                                            <option value="Not prefer to say" {{ (old('religion') == 'Not prefer to say' || (isset($data) && $data->religion == 'Not prefer to say')) ? 'selected' : '' }}>Not prefer to say</option>
                                        </select>

                                        @error('religion')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group  " style="margin: 0;">
                                    <label for="marital_status" class=" asterisk control-label">Marital status</label>
                                    <div class="">
                                        <select id="mar_sta" class="form-control marital_status" style="width: 100%;" name="marital_status" data-value="Single" tabindex="-1" aria-hidden="true">
                                            <option value="" {{ (old('marital_status') == '' && (!isset($data) || $data->marital_status === null)) ? 'selected' : '' }}>Select Marital Status</option>
                                            <option value="Single" {{ (old('marital_status') == 'Single' || (isset($data) && $data->marital_status == 'Single')) ? 'selected' : '' }}>Single</option>
                                            <option value="Married" {{ (old('marital_status') == 'Married' || (isset($data) && $data->marital_status == 'Married')) ? 'selected' : '' }}>Married</option>
                                            <option value="Widow" {{ (old('marital_status') == 'Widow' || (isset($data) && $data->marital_status == 'Widow')) ? 'selected' : '' }}>Widow</option>
                                            <option value="Divorced" {{ (old('marital_status') == 'Divorced' || (isset($data) && $data->marital_status == 'Divorced')) ? 'selected' : '' }}>Divorced</option>
                                            <option value="Other" {{ (old('marital_status') == 'Other' || (isset($data) && $data->marital_status == 'Other')) ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('marital_status')
                                        <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                            {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Monthly Expenses',
                                    'name' => 'monthly_expenses',
                                    'value' => old('monthly_expenses',isset($data) ? $data->monthly_expenses : ''),
                                    'isRequired' => true,
                                    ])

                                </div>
                                <div class="">
                                    @include('livewire.text-input', [
                                    'label' => 'Date of joined',
                                    'name' => 'date_of_joined',
                                    'value' => old('date_of_joined',isset($data) ? $data->date_of_joined : ''),
                                    'id'=>"date_of_joined",
                                    'isRequired' => true,
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
                                'value' => old('father_name',isset($data) ? $data->father_name : ''),
                                'isRequired' => true,

                                ])
                                @include('livewire.text-input', [
                                'label' => 'Mother Name',
                                'name' => 'mother_name',
                                'value' => old('mother_name',isset($data) ? $data->mother_name : ''),
                                'isRequired' => true,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6"> @include('livewire.text-input', [
                                'label' => 'Spouse Name',
                                'name' => 'spouse_name',
                                'value' => old('spouse_name',isset($data) ? $data->spouse_name : ''),
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Spouse Occupation',
                                'name' => 'spouse_occupation',
                                'value' => old('spouse_occupation',isset($data) ? $data->spouse_occupation : ''),
                                'isRequired' => true,
                                ])</div>
                            <div class="col-12" style="margin-top: 5px;">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <label for="no_of_adult">No of Ad</label>
                                    <input type="number" min="0" name="no_of_adult" class="form-control" id="no_of_adult" value="{{ old('no_of_adult') ? old('no_of_adult') : (isset($data->no_of_adult) ? $data->no_of_adult : '') }}">
                                    @error('no_of_adult')
                                    <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <label for="no_of_children">No of child</label>
                                    <input type="number" min="0" name="no_of_children" class="form-control" id="no_of_children" value="{{ old('no_of_children') ? old('no_of_children') : (isset($data->no_of_children) ? $data->no_of_children : '') }}">
                                    @error('no_of_children')
                                    <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4 col-lg-4" style="margin-bottom: 2px;">
                                    @include('livewire.text-input', [
                                    'label' => 'Total Family Members',
                                    'name' => 'total_family_members',
                                    'value'=>old('total_family_members',isset($data) ? $data->total_family_members : ''),
                                    'readonly' => true,
                                    'isRequired' => true,
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
                                'value' => old('smartcard_no',isset($data) ? $data->smartcard_no : ''),
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Voter ID',
                                'name' => 'voter_id',
                                'value' => old('voter_id',isset($data) ? $data->voter_id : ''),
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Aadhar Card Number',
                                'name' => 'aadhar_no',
                                'value' => old('aadhar_no',isset($data) ? $data->aadhar_no : ''),
                                'isRequired' => false,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Pan No',
                                'name' => 'pancard_no',
                                'value' => old('pancard_no',isset($data) ? $data->nominee_name : ''),
                                'isRequired' => false,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6" style="margin-top: 5px;">

                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'smartcard_img',
                                    'label' => 'Smart card img',
                                    'value' => old('smartcard_img', isset($data) ? env('APP_URL').'/uploads/'.$data->smartcard_img : ''),
                                    "name" =>"smartcard_img",
                                    'isRequired' => true,
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'voterid_img',
                                    'label' => 'voterid img',
                                    'value' => old('voterid_img', isset($data) ? env('APP_URL').'/uploads/'.$data->voterid_img : ''),
                                    "name" =>"voterid_img",
                                    'isRequired' => true,
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'aadhar_img',
                                    'label' => 'Aadhar img',
                                    'value' => old('aadhar_img', isset($data) ? env('APP_URL').'/uploads/'.$data->aadhar_img : ''),
                                    "name" =>"aadhar_img",
                                    'isRequired' => false,
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'pancard_img',
                                    'label' => 'pancard img',
                                    'value' => old('pancard_img', isset($data) ? env('APP_URL').'/uploads/'.$data->pancard_img : ''),
                                    "name" =>"pancard_img",
                                    'isRequired' => false,
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
                                'value'=>old('nominee_name',isset($data) ? $data->nominee_name : ''),
                                'isRequired' => true,
                                ]) <div class="form-group" style="margin: 0;">
                                    <label for="relation_with_client" class="asterisk control-label">Relation with
                                        Member</label>
                                    <select id="rela" class="form-control relation_with_client" name="relation_with_client">
                                        <option value="" {{ (old('relation_with_client') == '' || (isset($data) && $data->relation_with_client === null)) ? 'selected' : '' }}>Select Relationship</option>
                                        <option value="Mother" {{ (old('relation_with_client') == 'Mother' || (isset($data) && $data->relation_with_client == 'Mother')) ? 'selected' : '' }}>Mother</option>
                                        <option value="Father" {{ (old('relation_with_client') == 'Father' || (isset($data) && $data->relation_with_client == 'Father')) ? 'selected' : '' }}>Father</option>
                                        <option value="Wife" {{ (old('relation_with_client') == 'Wife' || (isset($data) && $data->relation_with_client == 'Wife')) ? 'selected' : '' }}>Wife</option>
                                        <option value="Husband" {{ (old('relation_with_client') == 'Husband' || (isset($data) && $data->relation_with_client == 'Husband')) ? 'selected' : '' }}>Husband</option>
                                        <option value="Brother" {{ (old('relation_with_client') == 'Brother' || (isset($data) && $data->relation_with_client == 'Brother')) ? 'selected' : '' }}>Brother</option>
                                        <option value="Sister" {{ (old('relation_with_client') == 'Sister' || (isset($data) && $data->relation_with_client == 'Sister')) ? 'selected' : '' }}>Sister</option>
                                        <option value="Other" {{ (old('relation_with_client') == 'Other' || (isset($data) && $data->relation_with_client == 'Other')) ? 'selected' : '' }}>Other</option>
                                    </select>

                                    @error('relation_with_client')
                                    <label class="control-label" style='color:red;'><i class="fa fa-times-circle-o"></i>
                                        {{ $message }}</label>
                                    @enderror
                                </div>
                                @include('livewire.text-input', [
                                'label' => 'Nominee Aadhar',
                                'name' => 'nominee_aadhar',
                                'value'=>old('nominee_aadhar',isset($data) ? $data->nominee_aadhar : ''),
                                'isRequired' => true,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Nominee Voter ID',
                                'name' => 'nominee_voter_id',
                                'value'=>old('nominee_voter_id',isset($data) ? $data->nominee_voter_id : ''),
                                'isRequired' => false,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Nominee Other Number',
                                'name' => 'nominee_other_id',
                                'value'=>old('nominee_other_id',isset($data) ? $data->nominee_other_id : ''),
                                'isRequired' => false,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                @include('livewire.text-input', [
                                'label' => 'Nominee mobile',
                                'name' => 'nominee_mobile',
                                'value'=>old('nominee_mobile',isset($data) ? $data->nominee_mobile : ''),
                                'isRequired' => false,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Nominee dob',
                                'name' => 'nominee_dob',
                                'id'=>'nominee_dob',
                                'value'=>old('nominee_dob',isset($data) ? $data->nominee_dob : ''),
                                'isRequired' => true,
                                ])

                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'nominee_aadhar_img',
                                    'label' => 'Nominee Aadhar
                                    Photo',
                                    'value' => old('nominee_aadhar_img', isset($data) ? env('APP_URL').'/uploads/'.$data->nominee_aadhar_img : ''),
                                    "name" =>"nominee_aadhar_img",
                                    'isRequired' => true,
                                    ])
                                </div>

                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'nominee_voter_img',
                                    'label' => 'Nominee VoterID
                                    Photo',
                                    'value' => old('nominee_voter_img', isset($data) ? env('APP_URL').'/uploads/'.$data->nominee_voter_img : ''),
                                    "name" =>"nominee_voter_img",
                                    'isRequired' => false,
                                    ])
                                </div>
                                <div class="">
                                    @include('livewire.image-uploader', [
                                    'img' => 'nominee_other_img',
                                    'label' => 'Nominee Other Photo',
                                    'value' => old('nominee_other_img', isset($data) ? env('APP_URL').'/uploads/'.$data->nominee_other_img : ''),
                                    "name" =>"nominee_other_img",
                                    'isRequired' => false,
                                    ])
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
                                'value'=>old('account_holder_name',isset($data) ? $data->account_holder_name : ''),
                                'isRequired' => false,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Account Number',
                                'name' => 'account_number',
                                'value'=>old('account_number',isset($data) ? $data->account_number : ''),
                                'isRequired' => false,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Bank Name',
                                'name' => 'bank_name',
                                'value'=>old('bank_name',isset($data) ? $data->bank_name : ''),
                                'isRequired' => false,
                                ])
                            </div>
                            <div class="col-12 col-md-6 col-lg-6"> @include('livewire.text-input', [
                                'label' => 'IFSC Code',
                                'name' => 'ifsc_number',
                                'value'=>old('ifsc_number',isset($data) ? $data->ifsc_number : ''),
                                'isRequired' => false,
                                ])
                                @include('livewire.text-input', [
                                'label' => 'Branch Name',
                                'name' => 'branch_name',
                                'value'=>old('branch_name',isset($data) ? $data->branch_name : ''),
                                'isRequired' => false,
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
        var today = moment();
        var minDate = today.clone().subtract(60, 'years').startOf('day');
        var maxDate = today.clone().subtract(18, 'years').endOf('day');

        $('#dob').val('').datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: minDate,
            useCurrent: false // Prevents setting the current date as default
        }).on('dp.show', function() {
            // Update maxDate on datepicker show
            $(this).data('DateTimePicker').maxDate(maxDate);
        });
        let dat = "{{ $dat }}";
        if (dat != '') {
            $('#dob').val(dat)
        }
        $('#nominee_dob').datetimepicker({
            format: 'DD-MM-YYYY',
            minDate: minDate,
            maxDate: maxDate

        })
        $('#date_of_joined').datetimepicker({
            format: 'DD-MM-YYYY',
            maxDate: moment()
        })
        $('#gender').select2()
        $('#commu').select2()
        $('#quali').select2()
        $('#home_sta').select2()
        $('#mem_status').select2()
        $('#center_id').select2()
        $('#reli').select2()
        $('#mar_sta').select2()
        $('#rela').select2()



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
                var total = 0;
                console.log(typeof adult, typeof child)
                if (adult >= 0 && child >= 0) {
                    total = adult + child
                } else if (adult >= 0) {
                    total = adult
                } else if (child >= 0) {
                    total = child
                }
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