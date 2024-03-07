<?php

namespace App\Admin\Actions\Post;

use App\Models\DayBook;
use App\Models\Voucher;
use App\Models\VoucherHistory;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class memberEdit extends RowAction
{
    public $name = 'Edit';

    public function handle(Model $model)
    {
        return $this->response()->redirect('/admin/member/'.$model->id.'/edit');
    }
}
