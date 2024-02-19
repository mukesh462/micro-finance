<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\DeleteVoucher;
use App\Models\DayBook;
use App\Models\Employee;
use App\Models\Reason;
use App\Models\Voucher;
use App\Models\VoucherHistory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

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
        if(Auth::user()->employee_id!=null){
            $grid->model()->where('user_id', Auth::user()->employee_id)->where('added_by',"employee");
        }

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('transaction_type', __('Transaction type'));
        $grid->column('amount', __('Amount'));
        // $grid->column('added_by', __('Added By'));
        // $grid->column('user_id', __('Employee Name'))->display(function($user_id){
        //     if($this->added_by == "admin") {
        //         $admin = Administrator::where('id',$user_id)->first();
        //         return is_object($admin) ? $admin->username:"---";
        //     }
        //     else {
        //         $admin = Employee::where('id',$user_id)->first();
        //         return is_object($admin) ? $admin->user_name:"---";
        //     }
        // });
        // $grid->column('narration', __('Narration'));

        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('date')->date();
        });
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();

            $actions->add(new DeleteVoucher);
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
        $checkId = Voucher::orderBy('id',"desc")->first();
        if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {
            $form->display('Voucher Id')->value(is_object($checkId) ? $checkId->id + 1 : 1);
        }
        $form->date('date', __('Voucher Date'))->format('DD-MM-YYYY')->default(date('d-m-Y'))->readonly();
        $form->select('transaction_type', __('Transaction type'))->options(["credit" => 'Credit', 'debit' => 'Debit'])->rules(['required'])->load('reason', '/admin/getReason');
        $form->select('reason', __('Reason type'))->options(function ($id) {
            $reason = Reason::find($id);
            if ($reason) {
                return [$reason->id => $reason->reason_name];
            }
            
        })->rules(['required']);
        $form->text('amount', __('Amount'))->rules(['required'])->attribute(['id'=>"voucher-amount"]);
        $form->textarea('narration', __('Narration'))->rules(['required']);
        $form->tools(function (Form\Tools $tools) {
            // $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->saving(function (Form $form) {

            if ($form->model()->id == null) {
                if (Auth::user()->employee_id != null) {
                    $form->model()->user_id  = Auth::user()->employee_id;
                    $form->model()->added_by  = "employee";
                }
                else {
                    $form->model()->user_id  = Auth::user()->id;
                    $form->model()->added_by  = "admin";
                }
            }
            if ($form->model()->id != null) {
                // Convert the date string into a Carbon instance
                $dateToCompare = Carbon::createFromFormat('d-m-Y', $form->model()->date)->startOfDay();
                // Get the current date and time
                $currentDate = Carbon::now()->startOfDay();
                // dd($dateToCompare, $currentDate);

                if ($dateToCompare->lt($currentDate)) {
                    admin_error("Voucher Update Error", "Previous date voucher cannot be updated");
                    return redirect()->back();
                }
            }
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
                    } else if (($form->model()->transaction_type == $voucherHistory->transaction_type) && ($form->model()->amount != $voucherHistory->amount) && ($form->model()->transaction_type == "debit")) {
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
                    } else if (($form->model()->transaction_type != $voucherHistory->transaction_type) && ($form->model()->transaction_type == "credit")) {
                        if ($form->model()->amount == $voucherHistory->amount) {
                            $update_amount = $form->model()->amount + $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance + $update_amount;
                        } else if ($form->model()->amount > $voucherHistory->amount) {
                            $update_amount = $voucherHistory->amount + $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance + $update_amount;
                        } else {
                            $update_amount = $voucherHistory->amount + $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance + $update_amount;
                        }
                        $daybook->save();
                        $voucherHistory->transaction_type = $form->model()->transaction_type;
                        $voucherHistory->amount = $form->model()->amount;
                        $voucherHistory->save();
                    } else if (($form->model()->transaction_type != $voucherHistory->transaction_type) && ($form->model()->transaction_type == "debit")) {
                        if ($form->model()->amount == $voucherHistory->amount) {
                            $update_amount = $form->model()->amount + $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance - $update_amount;
                        } else if ($form->model()->amount > $voucherHistory->amount) {
                            $update_amount = $voucherHistory->amount + $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance - $update_amount;
                        } else {
                            $update_amount = $voucherHistory->amount + $form->model()->amount;
                            $daybook->closing_balance  =  $daybook->closing_balance - $update_amount;
                        }
                        $daybook->save();
                        $voucherHistory->transaction_type = $form->model()->transaction_type;
                        $voucherHistory->amount = $form->model()->amount;
                        $voucherHistory->save();
                    }
                } else {
                    $daybook->closing_balance = $form->model()->transaction_type == "credit" ? $daybook->closing_balance + $form->model()->amount : $daybook->closing_balance - $form->model()->amount;
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
                $checkDaybookLatest = DayBook::orderBy('id', "desc")->first();
                $newDay = new DayBook();
                if (is_object($checkDaybook)) {
                    $newDay->opening_balance = $checkDaybook->closing_balance;
                    $newDay->closing_balance =  ($form->model()->transaction_type == "credit") ? $checkDaybook->closing_balance + $form->model()->amount : $checkDaybook->closing_balance - $form->model()->amount;
                } else if (is_object($checkDaybookLatest)) {
                    $newDay->opening_balance = $checkDaybookLatest->closing_balance;
                    $newDay->closing_balance =  ($form->model()->transaction_type == "credit") ? $checkDaybookLatest->closing_balance + $form->model()->amount : $checkDaybookLatest->closing_balance - $form->model()->amount;
                } else {
                    $newDay->opening_balance = 0;
                    $newDay->closing_balance = ($form->model()->transaction_type == "credit") ? $form->model()->amount : -$form->model()->amount;
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

        Admin::script('

        $("#voucher-amount").on("input", function () {
            this.value = this.value.replace(/[^\d.]+/g, "").replace(/(?:\.\d*)\./, ". ");
        });
        ');
        return $form;
    }

    public function dayBookReport()
    {

        // dd('hi');
        // return view()
        $grid = new Grid(new DayBook);

        // Grid::init(DayBook::class,function (Grid $grid){

        // });

        // $grid = new Grid(new DayBook());
        // $grid->header(function ($query) {
        //     return 'header';
        // });

        // $grid->footer(function ($query) {
        //     return 'footer';
        // });
        // $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('Id'));
        // // $grid->column('date', __('Date'));
        // $grid->column('opening_balance', __('Opening Balance'));
        // $grid->column('closing_balance', __('Closing Balance'));
        // // $grid->column('created_at', __('Created at'));
        // // $grid->column('updated_at', __('Updated at'));
        // $grid->disableBatchActions();
        // $grid->disableColumnSelector();
        // $grid->disableExport();
        // $grid->actions(function ($actions) {
        //     $actions->disableDelete();
        //     // $actions->disableEdit();
        //     $actions->disableView();
        //             });
        return $grid;
    }
}
