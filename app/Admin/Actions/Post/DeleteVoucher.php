<?php

namespace App\Admin\Actions\Post;

use App\Models\DayBook;
use App\Models\Voucher;
use App\Models\VoucherHistory;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class DeleteVoucher extends RowAction
{
    public $name = 'Delete ';

      public function dialog()
    {
       return  $this->confirm('Are you sure to delete this voucher?');
    }

    public function handle(Model $model)
    {
        // $model ...
        // dd($model->id);
        $dateToCompare = Carbon::createFromFormat('d-m-Y',$model->date)->startOfDay();
        // Get the current date and time
        $currentDate = Carbon::now()->startOfDay();

        if ($dateToCompare->lt($currentDate)) {
            return $this->response()->error('Previous date voucher cannot be deleted')->refresh();
        }
        $voucherHistory = VoucherHistory::where('voucher_id', $model->id)->first();
        $daybook = DayBook::where('date', $model->date)->first();
        if (is_object($voucherHistory)) {
            if($voucherHistory->transaction_type == "credit") {
                $daybook->closing_balance  =  $daybook->closing_balance - $voucherHistory->amount;
                $daybook->save();
            }
            else {
                $daybook->closing_balance  =  $daybook->closing_balance + $voucherHistory->amount;
                $daybook->save();
            }
            $voucherHistory->delete();
            $model->delete();
          }
          return $this->response()->success('Voucher deleted Successfully')->refresh();
    }
}
