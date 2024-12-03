<?php

namespace App\Admin\Controllers;

use App\Models\Center;
use App\Models\Collection;
use App\Models\Employee;
use App\Models\LoanAccount;
use App\Models\Member;
use App\Models\PrecloseList;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

class PrecloseListController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Foreclosure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PrecloseList());

        // $grid->column('id', __('Id'));
        $grid->column('center_id', __('Center Name'))->display(function ($center_id) {
            $center = Center::where('id', $center_id)->first();
            return is_object($center) ? "00" . $center_id . "-" . $center->center_name : "---";
        });
        $grid->column('employee_id', __('Employee Name'))->display(function ($employee_id) {
            $employee = Employee::where('id', $employee_id)->first();
            return $employee->staff_name;
        });
        $grid->column('member_id', __('Member Name'))->display(function ($member_id) {
            $member = Member::where('id', $member_id)->first();
            return $member->client_name;
        });
        // // $grid->column('loan_id', __('Loan id'));
        // $grid->column('disbursal_date', __('Disbursal date'));
        // $grid->column('loan_amount', __('Loan amount'));
        // $grid->column('loan_interest', __('Loan interest'));
        // $grid->column('previously_collected', __('Previously collected'));
        // $grid->column('balance_due_weeks', __('Balance due weeks'));
        // $grid->column('collected_weeks', __('Collected weeks'));
        // $grid->column('outstanding_principle', __('Outstanding principle'));
        // $grid->column('outstanding_interest', __('Outstanding interest'));
        $grid->column('total_collected', __('Total collected'));
        $grid->column('status', __('Status'))->display(function ($status) {
            // $member = Member::where('id', $member_id)->first();
            if($status == 0)
            {
                return "<span class='btn-sm btn-info'>Pending</span>";
            }
        });
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableFilter();
        // $grid->filter(function ($filter) {
        //     // Remove the default id filter
        //     $filter->disableIdFilter();
        //     // $filter->like('center_name', 'Center Name');
        // });
        $grid->disableExport();
        $grid->disableCreateButton();
        $grid->tools(function ($tools) {
            $tools->append('<a href="/admin/foreclosure" class="btn btn-sm btn-success" title="New">
            <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;New</span>
        </a>');
        });
        // $grid->actions(function ($actions) {
        //     $actions->disableDelete();
        //     $actions->disableEdit();
        //     $actions->disableView();
        // });
        $grid->column("id","Action")->display(function($id){
            return "<a href='/admin/foreclose/$id'>View</a>";
        });
        $grid->disableActions();

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
        $show = new Show(PrecloseList::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('center_id', __('Center id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('loan_id', __('Loan id'));
        $show->field('disbursal_date', __('Disbursal date'));
        $show->field('loan_amount', __('Loan amount'));
        $show->field('loan_interest', __('Loan interest'));
        $show->field('previously_collected', __('Previously collected'));
        $show->field('balance_due_weeks', __('Balance due weeks'));
        $show->field('collected_weeks', __('Collected weeks'));
        $show->field('outstanding_principle', __('Outstanding principle'));
        $show->field('outstanding_interest', __('Outstanding interest'));
        $show->field('total_collected', __('Total collected'));
        $show->field('status', __('Status'));
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
        // $form = new Form(new PrecloseList());

        // $form->number('member_id', __('Member id'));
        // $form->number('center_id', __('Center id'));
        // $form->number('employee_id', __('Employee id'));
        // $form->number('loan_id', __('Loan id'));
        // $form->text('disbursal_date', __('Disbursal date'));
        // $form->decimal('loan_amount', __('Loan amount'));
        // $form->decimal('loan_interest', __('Loan interest'));
        // $form->decimal('previously_collected', __('Previously collected'));
        // $form->number('balance_due_weeks', __('Balance due weeks'));
        // $form->number('collected_weeks', __('Collected weeks'));
        // $form->decimal('outstanding_principle', __('Outstanding principle'));
        // $form->decimal('outstanding_interest', __('Outstanding interest'));
        // $form->decimal('total_collected', __('Total collected'));
        // $form->switch('status', __('Status'));

        // return $form;
    }

    public function createPreclose(Request $request)
    {
        // return $request;
        // Retrieve parameters from the request
        $id = $request->input('loan_id'); // Search term
        // $data['employee'] = Employee::select('id', 'staff_name')->where('center_id', $id)->first();
        $loan = LoanAccount::where('id', $id)->where('loan_status', 0)->first();

        $checkPreClose = PrecloseList::where('loan_id', $id)->first();
        if(is_object($checkPreClose)){
            $response = [
                'message' => 'Loan Already Foreclosed',
                'results' => [],
            ];
            return response()->json($response);
        }

        if(is_object($loan)) {

            $collections = Collection::where('loan_id', $id)->get();

            $collected_collections = $collections->filter(function($collection) {
                return in_array($collection->status, [2, 3]);
            });

            $due_collections = $collections->filter(function($collection) {
                return $collection->status == 1;
            });
            $data['total_collection_amount'] = $due_collections->sum('collection_price');
            $data['total_collection_interest'] = $due_collections->sum('due_interest');

            // return array_values($due_collections);

            $data['due_collection'] = array_values($due_collections->toArray());
            $data['collected_collection'] = $collected_collections;


            if (count($data['due_collection']) > 0) {
                $last = Collection::where('status', 2)->where('loan_id', $id)->latest()->first();
                $data['balance_amount'] = is_object($last) ? $last->due_balance : 0;
                $data['total_collection_amount'] = $data['total_collection_amount'] + $data['balance_amount'];
                $data['total_amount_collect'] = $data['total_collection_amount'] + $data['total_collection_interest'];
                $previously_collected = $loan->loan_amount+$loan->loan_interest-$data['total_amount_collect'];

                $preclose = new PrecloseList();
                $preclose->loan_id = $request->input('loan_id');
                $preclose->center_id = $request->input('center');
                $preclose->employee_id = $loan->staff_id;
                $preclose->member_id = $request->input('member');

                $preclose->disbursal_date = $loan->dis_date;
                $preclose->loan_amount = $loan->loan_amount;
                $preclose->loan_interest = $request->input('loan_interest');
                $preclose->previously_collected = $previously_collected;
                $preclose->collected_weeks = count($data['collected_collection']);
                $preclose->outstanding_principle = $data['total_collection_amount'];
                $preclose->outstanding_interest = $data['total_collection_interest'];
                $preclose->total_collected = $request->input('loan_collected');
                $preclose->balance_due_weeks = count($data['due_collection']);
                $preclose->save();

                $response = [
                    'message' => 'Loan Foreclose request updated successfully.',
                    'results' => [],
                ];
            } else {
                $response = [
                    'message' => 'No collection to pay',
                    'results' => [],
                ];
            }
        }else{
            $response = [
                'message' => 'Loan not found',
                'results' => [],
            ];
        }

        // Prepare response data
        // Return JSON response
        return response()->json($response);
    }

    public function viewForeClose(){
        return Admin::content(function (Content $content) {

            // $content->header(' Loan');
            // $content->description('Ln Disbursement');

            $content->title('Foreclosure');
            $content->description('Request');
            $content->body(new Box('', view('foreclose_request')));
        });
    }
}
