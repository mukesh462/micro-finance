<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name','dob','address','community','qualification','monthly_income','home_status','center_id','age','phone_number','city','pincode','religion','marital_status','monthly_expenses','date_of_joined','father_name','mother_name','spouse_name','spouse_occupation','no_of_adult','no_of_children','smartcard_no','voter_id','smartcard_img','voterid_img','nominee_name','relation_with_client','nominee_aadhar','nominee_mobile','nominee_dob','nominee_aadhar_img','account_holder_name','account_number','bank_name','ifsc_number','branch_name','pancard_no','pancard_img','total_family_members','nominee_voter_img','nominee_other_img','nominee_voter_id','nominee_other_id','status','photo','aadhar_no','aadhar_img','staff_id'
    ];
}
