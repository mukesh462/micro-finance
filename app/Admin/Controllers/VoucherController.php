<?php

namespace App\Admin\Controllers;

use App\Models\DayBook;
use App\Models\Voucher;
use App\Models\VoucherHistory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class VoucherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Voucher';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Voucher());
        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('transaction_type', __('Transaction type'));
        $grid->column('amount', __('Amount'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Voucher::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('transaction_type', __('Transaction type'));
        $show->field('amount', __('Amount'));
        $show->field('date', __('Date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Voucher());
        $checkId = Voucher::latest()->first();
        if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {
            $form->display('Voucher Id')->value(is_object($checkId) ? $checkId->id + 1 : 1);
        }
        $form->date('date', __('Voucher Date'))->format('DD-MM-YYYY')->default(date('d-m-Y'))->readonly();
        $form->select('transaction_type', __('Transaction type'))->options(["credit" => 'Credit', 'debit' => 'Debit'])->rules(['required']);
        $form->decimal('amount', __('Amount'))->rules(['required']);
        $form->textarea('narration', __('Narration'))->rules(['required']);
        $form->tools(function (Form\Tools $tools) {
            // $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->saving(function (Form $form) {
            //    if($form->model()->id == null) {
            //     $daybook = DayBook::where('date',$form->date)->first();
            //     dd($daybook);
            //    }
        });
        $form->saved(function (Form $form) {
            $daybook = DayBook::where('date', $form->model()->date)->first();
            if (is_object($daybook)) {
                $voucherHistory = VoucherHistory::where('voucher_id', $form->model()->id)->first();
                if (is_object($voucherHistory)) {
                    if (($form->model()->transaction_type == $voucherHistory->transaction_type) && ($form->model()->amount != $voucherHistory->amount) && ($form->model()->transaction_type == "credit")) {
                        if ($form->model()->amount > $voucherHistory->amount) {
                            $update_amount = $form->model()->amount - $voucherHistory->amount;
                        } else {
                            $update_amount = - ($voucherHistory->amount - $form->model()->amount);
                        }
                        $voucherHistory->amount = $form->model()->amount;
                        $voucherHistory->save();
                        $daybook->closing_balance  =  $daybook->closing_balance + $update_amount;
                        $daybook->save();
                        //   $update_amount = $form->model()->amount > $voucherHistory->amount? $form->model()->amount - $voucherHistory->amount: $voucherHistory->amount - $form->model()->amount;  
                    }else if(($form->model()->transaction_type == $voucherHistory->transaction_type) && ($form->model()->amount != $voucherHistory->amount) && ($form->model()->transaction_type == "debit")) {
                        if ($form->model()->amount > $voucherHistory->amount) {
                            $update_amount = $form->model()->amount - $voucherHistory->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance - $update_amount;
                        } else {
                            $update_amount = $voucherHistory->amount - $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance + $update_amount;
                        }
                        $daybook->save();
                        $voucherHistory->amount = $form->model()->amount;
                        $voucherHistory->save();
                    }
                }
                else {
                    $daybook->closing_balance = $form->model()->transaction_type == "credit" ? $daybook->closing_balance + $form->model()->amount : $daybook->closing_balance - $form->model()->amount ;
                    $daybook->save();
                    $voucherHistory = new VoucherHistory();
                    $voucherHistory->voucher_id = $form->model()->id;
                    $voucherHistory->transaction_type = $form->model()->transaction_type;
                    $voucherHistory->amount = $form->model()->amount;
                    $voucherHistory->save();
                }
            } else {

                $currentDate = $form->model()->date; // Your current date in the format dd-mm-yyyy
                // Convert the current date to a Carbon instance with the specified format
                $currentDateCarbon = Carbon::createFromFormat('d-m-Y', $currentDate);

                // Get the previous date
                $previousDate = $currentDateCarbon->subDay();
                $previousDateFormatted = $previousDate->format('d-m-Y');
                $checkDaybook = DayBook::where('date', $previousDateFormatted)->first();
                $newDay = new DayBook();
                if (is_object($checkDaybook)) {
                    $newDay->opening_balance = $checkDaybook->closing_balance;
                    $newDay->closing_balance =  ($form->model()->transaction_type == "credit")?$checkDaybook->closing_balance + $form->model()->amount:$checkDaybook->closing_balance - $form->model()->amount;
                } else {
                    $newDay->opening_balance = 0;
                    $newDay->closing_balance = ($form->model()->transaction_type == "credit")?$form->model()->amount:-$form->model()->amount;
                }
                $newDay->date = $form->model()->date;
                $newDay->save();
                $voucherHistory = new VoucherHistory();
                $voucherHistory->voucher_id = $form->model()->id;
                $voucherHistory->transaction_type = $form->model()->transaction_type;
                $voucherHistory->amount = $form->model()->amount;
                $voucherHistory->save();
            }
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
