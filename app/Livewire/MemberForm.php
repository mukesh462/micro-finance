<?php

namespace App\Livewire;

use App\Models\Center;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithFileUploads;

class MemberForm extends Component
{
    use WithFileUploads;

    public $center_id, $staff_id, $client_name, $phone_number, $address, $city, $state, $pincode, $country, $dob, $age, $gender, $status, $inactive_time;
    public $community, $religion, $marital_status, $monthly_income, $monthly_expenses, $smartcard_no, $smartcard_img, $voter_id, $voterid_img, $aadhar_no, $aadhar_img, $pancard_no, $pancard_img;
    public $home_status, $spouse_name, $spouse_occupation, $nominee_name, $nominee_mobile, $relation_with_client, $nominee_dob, $no_of_children, $no_of_adult, $father_name, $mother_name, $qualification, $date_of_joined, $total_family_members;
    public $bank_name, $account_number, $account_holder_name, $ifsc_number, $branch_name, $photo, $nominee_pan, $nominee_pan_img, $nominee_aadhar, $nominee_aadhar_img, $nominee_voter_img, $nominee_voter_id, $nominee_other_img, $nominee_other_id, $centers;
    public $script;
    public function render()
    {
        return view('livewire.member-form');
    }
    public function submitForm()
    {

        $this->validate([
            'photo' => 'required|image',
            'client_name' => 'required',
            'dob' => ['required', 'date', 'before_or_equal:' . date('Y-m-d', strtotime('-18 years')), 'after_or_equal:' . date('Y-m-d', strtotime('-60 years'))]



        ]);
    }
    public function mount()
    {
        $this->centers = Center::select(DB::raw('CONCAT("00",id, " - ", center_name) as center_name'), 'id')->get();
    }
}
