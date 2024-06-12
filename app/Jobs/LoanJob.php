<?php

namespace App\Jobs;

use App\Models\Index;
use App\Models\IndexMember;
use App\Models\LoanAccount;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LoanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    protected $input;
    /**
     * Create a new job instance.
     */
    public function __construct($data,$all)
    {
        //
         $this->input = $all;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $first_due = date('Y-m-d', strtotime($this->input['first_due']));
        // dd($first_due);
        $finalData = json_decode($this->data);
        $inDex = IndexMember::where('index_id', $finalData[0]->index_id)->count();
        $inDexAprove = IndexMember::where('index_id', $finalData[0]->index_id)->where('loan_status',1)->count();
        $countAdd = $inDexAprove + count($finalData);
        if (count($finalData) == $inDex) {
            Index::where('id', $finalData[0]->index_id)->update(['index_status' => 2]);
        }elseif($countAdd == $inDex) {
            Index::where('id', $finalData[0]->index_id)->update(['index_status' => 2]);

        }
        foreach ($finalData as $key => $value) {
            $planFind = Product::find($value->plan_id);
            if (is_object($planFind)) {
                $loan_no = LoanAccount::where('member_id',$value->member_id)->count();
                $addTo = new LoanAccount();
                $addTo->index_id = $value->index_id;
                $addTo->index_member_id = $value->id;
                $addTo->center_id = $value->center_id;
                $addTo->member_id = $value->member_id;
                $addTo->loan_interest = $planFind->interest_amount;
                $addTo->plan_id = $value->plan_id;
                $addTo->loan_amount = $planFind->plan_amount;
                $addTo->interest_type = $planFind->interest_type;
                $addTo->loan_duration = $planFind->plan_duration;
                $addTo->loan_type = $planFind->plan_type;
                $addTo->staff_id = $value->staff_id;
                $addTo->loan_no = $loan_no == 0 ? date('Ymd').'00'. 1: date('Ymd').'00'.$loan_no +1;
                $addTo->fund_type = $this->input['fund'];
                $addTo->dis_type = $this->input['dis_mode'];
                $addTo->first_due = $this->input['first_due'];
                $addTo->dis_date =date('d-m-Y');
                $interest = $planFind->interest_type == 1 ? ($planFind->plan_amount * $planFind->interest_amount / 100) : $planFind->interest_amount;
                $addTo->outstanding_amount = $planFind->plan_amount + $interest;
                $addTo->save();
                IndexMember::where('id', $value->id)->update(['loan_status' => 1]);
                $arr = [];
                for ($due = 0; $due < $planFind->plan_duration; $due++) {
                    $dayPlus = $due + 1;
                    $loan_amt = $planFind->plan_amount / $planFind->plan_duration;
                    $interest = $planFind->interest_type == 1 ? ($planFind->plan_amount * $planFind->interest_amount / 100) : $planFind->interest_amount;
                    $month_interest = $interest / $planFind->plan_duration;
                    // dd(($planFind->plan_amount * $planFind->loan_interest));
                if ($planFind->plan_type == 1) { //week
                        $arr[] = [
                            'loan_id' =>$addTo->id ,
                            'member_id' => $value->member_id,
                            'center_id' => $value->center_id,
                            'staff_id' => $value->staff_id,
                            'due_number' => $dayPlus,
                            'due_date' => date('Y-m-d', strtotime($first_due . '+' . ($dayPlus) . 'week')),
                            'due_interest' => $month_interest,
                            'collection_date' => date('Y-m-d', strtotime($first_due . '+' . ($dayPlus) . 'week')),
                            'due_amount' => round($loan_amt + $month_interest, 2),
                            'collection_price' => round($loan_amt, 2),
                            'collection_interest' => $month_interest,
                            'collection_amount' => round($loan_amt + $month_interest, 2),
                            'due_balance' => 0,
                            'collection_interest' => $month_interest,
                        ];
                    } elseif ($planFind->plan_type == 2) { //14 days
                        $arr[] = [
                            'loan_id' =>$addTo->id ,
                            'member_id' => $value->member_id,
                            'center_id' => $value->center_id,
                            'staff_id' => $value->staff_id,
                            'due_number' => $dayPlus,
                            'due_date' => date('Y-m-d', strtotime($first_due . '+' . ($dayPlus * 14) . 'day')),
                            'due_interest' => $month_interest,
                            'collection_date' => date('Y-m-d', strtotime($first_due . '+' . ($dayPlus * 14) . 'day')),
                            'due_amount' => round($loan_amt + $month_interest, 2),
                            'collection_price' => round($loan_amt, 2),
                            'collection_interest' => $month_interest,
                            'collection_amount' => round($loan_amt + $month_interest, 2),
                            'due_balance' => 0,
                            'collection_interest' => $month_interest,
                        ];
                    } else { //month
                        $arr[] = [
                            'loan_id' =>$addTo->id ,
                            'member_id' => $value->member_id,
                            'center_id' => $value->center_id,
                            'staff_id' => $value->staff_id,
                            'due_number' => $dayPlus,
                            'due_date' => date('Y-m-d', strtotime($first_due . '+' . ($dayPlus) . 'month')),
                            'due_interest' => $month_interest,
                            'collection_date' => date('Y-m-d', strtotime($first_due . '+' . ($dayPlus) . 'month')),
                            'due_amount' => round($loan_amt + $month_interest, 2),
                            'collection_price' => round($loan_amt, 2),
                            'collection_interest' => $month_interest,
                            'collection_amount' => round($loan_amt + $month_interest, 2),
                            'due_balance' => 0,
                            'collection_interest' => $month_interest,
                        ];
                    }
                }

                DB::table('collections')->insert($arr);
            }
        }
    }
}
