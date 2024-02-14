<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\SubCenter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Role;
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

        $grid->column('id', __('Employee Id'));
        $grid->column('staff_name', __('Employee name'));
        $grid->column('designation', __('Designation'))->display(function ($designation) {
            if ($designation == 1) {
                return "Manager";
            } else {
                return "Field officer";
            }
        });
        $grid->column('doj', __('Date Of Joining'));

        $grid->disableColumnSelector();
        $grid->disableFilter();
        $grid->disableExport();
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
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
        $form->tab('Employee Info', function ($form) {

            $form->text('staff_name', __('Employee name'))->rules('required');

            $form->select('designation', __('Designation'))->options([1 => 'Manager', 2 => 'Field Officer'])->rules(['required']);
            $form->radio('gender', __('Gender'))->options(["Male" => 'Male', "Female" => 'Female'])->default("Male")->rules('required');
            $form->date('dob', __('Date of birth'))->format('DD-MM-YYYY')->rules(['required', 'date', 'before:' . date('d-m-Y')])->attribute(['id' => 'do-date']);
            $form->date('doj', __('Date of Joining'))->format('DD-MM-YYYY')->rules(['required', 'date']);
        })->tab('Login Credentials', function ($form) {
            $states = [
                'on' => ['value' => 1, 'text' => 'On', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => 'Off', 'color' => 'danger'],
            ];
            $form->text('user_name', __('User name'))->rules(function ($form) {
                if (!$id = $form->model()->id) {
                    return 'required|unique:employees,user_name';
                } else {
                    return 'required|unique:employees,user_name,' . $form->model()->id;
                }
            });
            $form->password('password', 'Password')->help('Note! Password must be atleast 8 characters with atleast 1 number and alphabets')->rules(function ($form) {
                // If it is not an edit state, add field unique verification
                return 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).{8,}$/                ';

            });
            $form->switch('status', __('Login Status'))->states($states)->default(1)->rules('required');
        });



        // $main_center = SubCenter::pluck('place_name', 'id');
        // $is_edit = request()->segment(3);
        //    dd($is_edit) ;
        // if ($is_edit == 'create') {
        //     $form->select('center_id', _('Select center'))->options($main_center)->rules('required');
        // } else {
        //     $form->select('center_id', _('Select center'))->options($main_center)->readOnly();
        // }
        // $form->image('image', _('Image'));
        // $form->text('address', _('Address'))->rules('required');
        // $form->text('mobile_no', _('Mobile no'))->rules('required');
        // $form->text('aadhar_no', _('Aadhar no'))->rules('required');
        // $form->text('pan_no', _('Pan no'))->rules('required');
        // $form->decimal('hold_amount', __('Hold amount'));
        $form->tools(function (Form\Tools $tools) {
            // $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        $form->saving(function (Form $form) {
        });
        $form->saved(function (Form $form) {
            $is_edit = request()->segment(3);
            if ($is_edit == 'create') {
                $new = new  Administrator();
                $new->username = trim($form->model()->user_name);
                $hashedPassword = Hash::make($form->model()->password);
                $new->password = $hashedPassword;
                $new->name = trim($form->model()->staff_name);
                $new->employee_id = trim($form->model()->id);
                $new->login_status = trim($form->model()->status);
                $new->save();
                $admin_id = $new->id;
            } else {
                $admin = Administrator::where('employee_id', $form->model()->id)->first();
                if (is_object($admin)) {
                    $admin->username = trim($form->model()->user_name);
                    if (!Hash::needsRehash($form->model()->password)) {
                        // Password is already hashed
                        $hashedPassword = $form->model()->password;
                    } else {
                        // Password is plain text, hash it
                        $hashedPassword = Hash::make($form->model()->password);
                    }
                    $admin->password = $hashedPassword;
                    $admin->name = trim($form->model()->staff_name);
                    $admin->login_status = trim($form->model()->status);
                    $admin->save();
                    $admin_id = $admin->id;
                } else {
                    if (!Hash::needsRehash($form->model()->password)) {
                        // Password is already hashed
                        $hashedPassword = $form->model()->password;
                    } else {
                        // Password is plain text, hash it
                        $hashedPassword = Hash::make($form->model()->password);
                    }
                    $new = new  Administrator();
                    $new->username = trim($form->model()->user_name);
                    $new->password = $hashedPassword;
                    $new->name = trim($form->model()->staff_name);
                    $new->employee_id = $form->model()->id;
                    $new->login_status = $form->model()->status;
                    $new->save();
                    $admin_id = $new->id;
                }
            }
            $role_id = $form->model()->designation == 1 ? 2:3;
            $role = Role::find($role_id);
            $user = Administrator::find($admin_id);
            if ($role && $user) {
                // Attach the user to the role
                // $role->administrators()->detach($user->id);
                $roles = Role::all(); // or however you retrieve your roles
                foreach ($roles as $ro) {
                    $ro->administrators()->wherePivot('user_id', $user->id)->detach();
                }
                $role->administrators()->attach($user->id);
            }
        });

        return $form;
    }
}
