<?php

namespace App\Admin\Controllers;

use App\Models\Center;
use App\Models\CenterOwnerList;
use App\Models\Employee;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CenterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Center';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Center());

        $grid->column('id', __('Center Id'));
        $grid->column('center_name', __('Center Name'));
        $grid->column('employee_id', __('Employee Name'))->display(function ($employee_id) {
            $employee = Employee::where('id', $employee_id)->first();
            return $employee->staff_name;
        });
        $grid->column('meeting_date', __('Meeting Date'));
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
        $show = new Show(Center::findOrFail($id));

        $show->field('id', __('Id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Center());
        $checkId = Center::orderBy('id',"desc")->first();
        if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {
            $center = Center::pluck('employee_id')->toArray();
            $employees = Employee::where('status', 1)->whereNotIn('id', $center)->pluck('staff_name', 'id');
        } else {
            $center = Center::whereNot('id', request()->segment(3))->pluck('employee_id')->toArray();
            $employees = Employee::where('status', 1)->whereNotIn('id', $center)->pluck('staff_name', 'id');
        }
        if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {
            $form->display('Center Id')->value(is_object($checkId) ? $checkId->id + 1 : 1);
        }
        $form->text('center_name', __('Center Name'))->rules('required');
        $form->text('center_address', __('Center Address'))->rules('required');
        $form->select('employee_id', __('Select Employee'))->options($employees)->rules('required');
        $form->date('formation_date', __('Formation Date'))->format('DD-MM-YYYY')->default(date('d-m-Y'))->readonly();
        $form->date('meeting_date', __('Next Meeting Date'))->format('DD-MM-YYYY')->rules(['required', 'date'])->attribute(['id' => "meeting-date"]);
        $form->text('meeting_day', __('Meeting Day'))->attribute(['id' => "day-id"])->readonly();
        $form->time('meeting_time', __('Meeting Time'))->format('h:mm A')->rules('required');
        $form->text('meeting_place', __('Meeting Place'))->rules('required');
        $form->text('mobile_number', 'Mobile Number')->rules('required|regex:/^[0-9]+$/|min:10');
        $form->tools(function (Form\Tools $tools) {
            // $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->saving(function (Form $form) {
            // if (($form->model()->id != null) && ($form->model()->employee_id != $form->employee_id)) {

            // } else if ($form->model()->id == null) {

            // }
            if ($form->model()->id == null) {
                $employee = Employee::where('id', $form->model()->employee_id)->first();
                if (is_object($employee)) {
                    $employee->center_id = $form->model()->id;
                    $employee->save();
                }
                $centerId = Center::orderBy('id',"desc")->first();
                $newCenter = new CenterOwnerList();
                $newCenter->center_id = is_object($centerId) ? $centerId->id + 1 : 1;
                $newCenter->employee_id = $form->employee_id;
                $newCenter->save();
            } else if ($form->model()->employee_id != $form->employee_id) {
                $employee = Employee::where('id', $form->model()->employee_id)->first();
                if (is_object($employee)) {
                    $employee->center_id = NULL;
                    $employee->save();
                }
                $employee1 = Employee::where('id', $form->employee_id)->first();
                if (is_object($employee1)) {
                    $employee1->center_id = $form->model()->id;
                    $employee1->save();
                }
                $newCenter = new CenterOwnerList();
                $newCenter->center_id = $form->model()->id;
                $newCenter->employee_id = $form->employee_id;
                $newCenter->save();
            }
        });
        $form->saved(function (Form $form) {
            $employee = Employee::where('id', $form->model()->employee_id)->first();
            if (is_object($employee)) {
                $employee->center_id = $form->model()->id;
                $employee->save();
            }
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });
        Admin::script('$(function(){
                  $("#meeting-date").on("blur",function(){
                    var value = $("#meeting-date").val();
                    var dateParts = value.split("-");
                    var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
                    var date = new Date(formattedDate);
                    var dayNumber = date.getDay();
                    var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    $("#day-id").val(daysOfWeek[dayNumber])
                  });
        })');
        return $form;
    }
}
