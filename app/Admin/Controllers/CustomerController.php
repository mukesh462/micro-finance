<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\ManageDocument;
use App\Models\Customer;
use App\Models\Employee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());

        $grid->column('id', __('Id'));
        $grid->column('customer_name', __('Customer name'));
        $grid->column('address', __('Address'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('dob', __('Dob'));
        $grid->column('gender', __('Gender'));
        $grid->column('center.place_name', __('Center'));
        $grid->column('staff.staff_name', __('Staff Name'));
        $grid->column('added_by', __('Added by'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        // $grid->column('row_id', __('Row id'));
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->add(new ManageDocument);
            // $actions->disableEdit();
            // $actions->disableView();
        });
        $grid->disableCreateButton();
        $grid->tools(function ($tools) {
            $tools->append('
            
       
                <a href="http://localhost:8000/admin/index/create"  class="btn btn-sm btn-success pull-right" title="New">
                    <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;New</span>
                </a>
          
            
                  ');
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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('customer_name', __('Customer name'));
        $show->field('address', __('Address'));
        $show->field('phone_number', __('Phone number'));
        $show->field('dob', __('Dob'));
        $show->field('gender', __('Gender'));
        $show->field('center_id', __('Center id'));
        $show->field('staff_id', __('Staff id'));
        $show->field('added_by', __('Added by'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('row_id', __('Row id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customer());
        // dd(auth()->user());
        $user_check = auth()->user()->name;
        if ($user_check == 'Administrator') {
            $form->select('staff_id', __('Select Staff'))->options(Employee::pluck('staff_name', 'id'))->required();
            $form->hidden('added_by', __('Added by'))->value('Administrator');
            // $form->number('row_id', __('Row id'));
        } else {

            $form->hidden('added_by', __('Added by'))->value('Staff');
        }
        $form->hidden('center_id', __('Customer name'));
        $form->text('customer_name', __('Customer name'))->rules('required');

        $form->textarea('address', __('Address'))->rules('required');
        $form->text('phone_number', __('Phone number'))->rules('required');
        $form->date('dob', __('Dob'))->default(date('Y-m-d'))->rules('required');
        $form->radio('gender', __('Gender'))->options(['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other']);
        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->saving(function (Form $form) {
            $staff = $form->staff_id;
            $form->center_id = Employee::find($staff)->center_id;
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });



        return $form;
    }

    public function create_index()
    {
        return Admin::content(function (Content $content) {

            // optional
            $content->header(' Index');
            // $content

            // optional
            $content->description(' Create Index Member');

            // add breadcrumb since v1.5.7
            // $content->breadcrumb(
            //     ['text' => 'Dashboard', 'url' => '/admin'],
            //     ['text' => 'User management', 'url' => '/admin/users'],
            //     ['text' => 'Edit user']
            // );
            $value = new Box('', view('create_index', ['type' => 'create']));



            // Direct rendering view, Since v1.6.12
            $content->body($value->render());
        });
    }
}
