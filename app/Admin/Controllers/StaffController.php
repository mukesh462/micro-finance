<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\SubCenter;
use App\Models\User;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StaffController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Employee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Employee());

        $grid->column('id', __('Id'));
        $grid->column('staff_name', __('Staff name'));
        $grid->column('center.place_name', __('Center name'));
        $grid->column('image', __('Image'));
        $grid->column('address', __('Address'));
        $grid->column('mobile_no', __('Mobile no'));
        $grid->column('aadhar_no', __('Aadhar no'));
        $grid->column('pan_no', __('Pan no'));
        $grid->column('hold_amount', __('Hold amount'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(Employee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('staff_name', __('Staff name'));
        $show->field('image', __('Image'));
        $show->field('address', __('Address'));
        $show->field('mobile_no', __('Mobile no'));
        $show->field('aadhar_no', __('Aadhar no'));
        $show->field('pan_no', __('Pan no'));
        $show->field('hold_amount', __('Hold amount'));
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
        $form = new Form(new Employee());
        $main_center = SubCenter::pluck('place_name','id');
       $is_edit = request()->segment(3);
    //    dd($is_edit) ;
    if($is_edit =='create'){
        $form->select('center_id', __('Select center'))->options($main_center)->rules('required');
    }else{
        $form->select('center_id', __('Select center'))->options($main_center)->rules('required')->disable();
    }
        $form->text('staff_name', __('Staff name'))->rules('required');
        $form->image('image', __('Image'));
        $form->text('address', __('Address'))->rules('required');
        $form->text('mobile_no', __('Mobile no'))->rules('required');
        $form->text('aadhar_no', __('Aadhar no'))->rules('required');
        $form->text('pan_no', __('Pan no'))->rules('required');
        // $form->decimal('hold_amount', __('Hold amount'));
        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        $form->saving(function (Form $form) {
            //...
        // print_r($form->staff_name);exit;
        $new = new  Administrator();
        $new->username = trim($form->staff_name);
        $new->password ='$2y$12$4tvoJWDVQljke4kv.ns3L.KqRApq6Gp6wkx3j1MsASvCE.VKTTvCi';
        $new->name = 'Staff Maintence';
        $new->save();
        });

        return $form;
    }
}
