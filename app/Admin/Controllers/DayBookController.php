<?php

namespace App\Admin\Controllers;

use App\Models\Center;
use App\Models\Collection;
use App\Models\DayBook;
use App\Models\Employee;
use App\Models\LoanAccount;
use App\Models\Member;
use App\Models\Reason;
use App\Models\Voucher;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use PDF;
use Carbon\Carbon;

class DayBookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DayBook';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DayBook());
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('opening_balance', __('Opening balance'));
        $grid->column('closing_balance', __('Closing balance'));
        $grid->column('View PDF')->display(function () {
            return "<a href ='/admin/viewDayBookReport/$this->id' target='_blank'>View Pdf</a>";
        });

        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->disableActions();
        $grid->disableCreateButton();

        // $grid->disableFilter();

        $grid->disableRowSelector();

        $grid->disableColumnSelector();

        // $grid->disableTools();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('date')->date();
        });


        $grid->disableExport();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
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
        $show = new Show(DayBook::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('date', __('Date'));
        $show->field('opening_balance', __('Opening balance'));
        $show->field('closing_balance', __('Closing balance'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    // protected function form()
    // {
    //     $form = new Form(new DayBook());

    //     $form->text('date', __('Date'));
    //     $form->decimal('opening_balance', __('Opening balance'));
    //     $form->decimal('closing_balance', __('Closing balance'));

    //     return $form;
    // }

    public function viewDayBookReport(HttpRequest $request)
    {
        $dayBook = DayBook::where('id', $request->segment(3))->first();

        if (is_object($dayBook)) {
            // dd($dayBook);
            $vouchers = Voucher::where('date', $dayBook->date)->get();
            $data['daybook'] = $dayBook;
            $data['vouchers'] = $vouchers;
            // $data['credit_sub_total'] = $dayBook->opening_balance;
            // $data['debit_sub_total'] = 0;
            $credit_sub_total = $dayBook->opening_balance;
            $debit_sub_total = 0;
            $grand_debit_sub_total = 0;

            if (count($vouchers) > 0) {
                foreach ($vouchers as $voucher) {
                    if ($voucher->transaction_type == "credit") {
                        $credit_sub_total = $credit_sub_total + $voucher->amount;
                    } else {
                        $debit_sub_total = $debit_sub_total + $voucher->amount;
                    }
                    $voucher->reason = Reason::where('id', $voucher->reason)->first()->reason_name;
                }
            }
            $grand_debit_sub_total = $debit_sub_total + $dayBook->closing_balance;
            $data['credit_sub_total'] = $credit_sub_total;
            $data['debit_sub_total'] = $debit_sub_total;
            $data['grand_debit_sub_total'] = $grand_debit_sub_total;
        } else {
            return redirect()->back();
        }

        $pdf = PDF::loadView('day_book', ['data' => $data]);

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="your_filename.pdf"',
        ];

        // Return the PDF content as a response
        return response($pdf->output(), 200, $headers);
    }
    public function singleCollection(HttpRequest $request)
    {
        return Admin::content(function (Content $content) {

            // optional
            // $content->header(' Collection');

            // $content->description('Single Member collection');
            $content->body(new Box('', view('single_collection')));
        });
    }

    public function bulkCollection(HttpRequest $request)
    {
        return Admin::content(function (Content $content) {

            // optional
            // $content->header(' Collection');

            // $content->description('Single Member collection');
            $content->body(new Box('', view('bulk_collection')));
        });
    }

    public function demandSheet(HttpRequest $request)
    {
        return Admin::content(function (Content $content) {

            // optional
            // $content->header(' Collection');

            // $content->description('Single Member collection');
            $content->body(new Box('', view('demand_sheet')));
        });
    }

    public function getDemandSheet(HttpRequest $request)
    {
        // return $request->all();

        $id = $request->input('center'); // Search term
        $emp_id = $request->input('employee'); // Search term
        $date = $request->input('due_date'); // Search term
        $date = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        // $date = "2024-07-11";
        // $id = $request->input('loan_id'); // Search term
        $data['employee'] = Employee::select('id', 'staff_name')->where('id', $emp_id)->first();
        // $data['loan'] = LoanAccount::where('id', $id)->where('loan_status', 0)->first();

        $data['center'] = Center::where('id', $id)->first();
        $collections = Collection::where('status', 1)->where('center_id', $id)->where('due_date', $date)->get();
        $loan_outstanding = 0;
        $total_balance = 0;
        $total_amount = 0;
        foreach ($collections as $key => $collection) {
            $lasts = Collection::where('loan_id', $collection->loan_id)->where('status', '!=', 3)->where('center_id', $id)->where('due_date', '<', $date)->get();
            $collections[$key]['paid_due'] = Collection::where('loan_id', $collection->loan_id)->where('status', '!=', 1)->where('center_id', $id)->count();
            $balance_amount = 0;
            if (count($lasts) > 0) {
                foreach ($lasts as $last) {
                    if ($last->status == 2) {
                        $balance_amount = ($last->collection_amount - $last->collected_amount) + $balance_amount;
                    } else if ($last->status == 1) {
                        $balance_amount = $balance_amount + $last->collection_amount;
                    }
                }
            }
            $collections[$key]['balance_amount'] = $balance_amount;
            $collections[$key]['total_amount'] = $collection->collection_amount + $balance_amount;
            $collections[$key]['member'] = Member::where('id', $collection->member_id)->first();
            $loan = LoanAccount::where('id', $collection->loan_id)->where('loan_status', 0)->first();
            $loan_outstanding = $loan->outstanding_amount + $loan_outstanding;
            $total_balance = $balance_amount + $total_balance;
            $total_amount = $total_amount + $collection->collection_amount;
            $collections[$key]['loan'] = $loan;
        }
        $data['collections'] = $collections;
        $data['total_balance'] = $total_balance;
        $data['total_amount'] = $total_amount;
        $data['total_demand'] = $total_amount + $total_balance;
        $data['loan_outstanding'] = $loan_outstanding;

        if (count($collections) > 0) {

            $response = [
                'message' => 'data Found',
                'results' => $data,
            ];
            // return response()->json($response);

            $pdf = PDF::loadView('collection_sheet', ['data' => $data]);

            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="your_filename.pdf"',
            ];

            // Return the PDF content as a response
            return response($pdf->output(), 200, $headers);
        } else {
            return redirect()->back()->withErrors(['error' => 'No Collections Found']);
        }
    }
}
