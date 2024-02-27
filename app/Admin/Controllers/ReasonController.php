<?php

namespace App\Admin\Controllers;

use App\Models\Reason;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReasonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reason';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reason());

        $grid->column('id', __('Id'));
        $grid->column('reason_type', __('Transaction type'));
        $grid->column('reason_name', __('Reason name'));
        // $grid->column('status', __('Status'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->filter(function ($filter) {
        //     $filter->disableIdFilter();
        //     // $filter->equal('date')->date();
        // });
        $grid->disableFilter();
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();

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
        $show = new Show(Reason::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('reason_type', __('Reason type'));
        $show->field('reason_name', __('Reason name'));
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
        $form = new Form(new Reason());

        $form->select('reason_type', __('Transaction type'))->options(["credit" => 'Credit', 'debit' => 'Debit'])->rules(['required']);
        $form->textarea('reason_name', __('Reason name'));
        // $form->switch('status', __('Status'))->default(1);
        $form->footer(function ($footer) {

            // disable reset btn
            // $footer->disableReset();

            // disable submit btn
            // $footer->disableSubmit();

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
            $footer->disableReset();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });
        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            // $tools->disableList();

            // Disable `Delete` btn.
            $tools->disableDelete();

            // Disable `Veiw` btn.
            $tools->disableView();

            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });

        return $form;
    }
    public function getReason(Request $request)
    {

        return Reason::select('id', 'reason_name as text')->where('reason_type', $request->input('q'))->get();
    }
}
