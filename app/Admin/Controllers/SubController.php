<?php

namespace App\Admin\Controllers;

use App\Models\MainCenter;
use App\Models\SubCenter;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SubController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sub Center';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SubCenter());

        $grid->column('id', __('Id'));
        $grid->column('main.place_name', __('Main Center'));
        // $grid->main()->place_name();
        $grid->column('place_name', __('Place name'));
        $grid->column('place_code', __('Place code'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('staff_count', __('Staff count'));
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();
            // $actions->disableView();
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
        $show = new Show(SubCenter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('main_id', __('Main id'));
        $show->field('place_name', __('Place name'));
        $show->field('place_code', __('Place code'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('staff_count', __('Staff count'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SubCenter());
        $main_center = MainCenter::pluck('place_name','id');
        $form->select('main_id', __('Main center'))->options($main_center)->rules('required');
        $form->text('place_name', __('Place name'))->rules('required');
        $form->text('place_code', __('Place code'));
        // $form->number('staff_count', __('Staff count'));
        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            $tools->disableList();
        
            // Disable `Delete` btn.
            $tools->disableDelete();
        
            // Disable `Veiw` btn.
            $tools->disableView();
        
            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->footer(function ($footer) {

            // disable reset btn
            // $footer->disableReset();
        
            // disable submit btn
            // $footer->disableSubmit();
        
            // disable `View` checkbox
            $footer->disableViewCheck();
        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
        
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        
        });
        return $form;
    }
}
