<?php

namespace App\Admin\Controllers;

use App\Models\Center;
use App\Models\Employee;
use App\Models\Member;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Member';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Member());

        $grid->column('id', __('Id'));

        $grid->column('client_name', __('Member name'));
        $grid->column('center_id', __('Center Name'))->display(function ($center_id) {
            $center = Center::where('id', $center_id)->first();
            return is_object($center) ? "00" . $center_id . "-" . $center->center_name : "---";
        });
        // $grid->column('father_name', __('Father name'));
        // $grid->column('mother_name', __('Mother name'));
        $grid->column('phone_number', __('Mobile'));
        // $grid->column('address', __('Address'));
        // $grid->column('city', __('City'));
        // $grid->column('state', __('State'));
        // $grid->column('pincode', __('Pincode'));
        // $grid->column('country', __('Country'));
        // $grid->column('dob', __('Dob'));
        // $grid->column('age', __('Age'));
        // $grid->column('gender', __('Gender'));
        // $grid->column('community', __('Community'));
        // $grid->column('religion', __('Religion'));
        // $grid->column('marital_status', __('Marital status'));
        // $grid->column('monthly_income', __('Monthly income'));
        // $grid->column('monthly_expenses', __('Monthly expenses'));
        // // $grid->column('smartcard_no', __('Smartcard no'));
        // $grid->column('smartcard_img', __('Smartcard img'));
        // $grid->column('voter_id', __('Voter id'));
        // $grid->column('voterid_img', __('Voterid img'));
        // $grid->column('aadhar_no', __('Aadhar no'));
        // $grid->column('aadhar_img', __('Aadhar img'));
        // $grid->column('pancard_no', __('Pancard no'));
        // $grid->column('pancard_img', __('Pancard img'));
        // $grid->column('home_status', __('Home status'));
        // $grid->column('spouse_name', __('Spouse name'));
        // $grid->column('spouse_occupation', __('Spouse occupation'));
        // $grid->column('nominee_name', __('Nominee name'));
        // $grid->column('nominee_mobile', __('Nominee mobile'));
        // $grid->column('relation_with_client', __('Relation with client'));
        // $grid->column('nominee_dob', __('Nominee dob'));
        // $grid->column('no_of_children', __('No of children'));
        $grid->status('Status')->display(function ($status) {
            if ($status == 1) {
                return "<span class='label label-success'>Active</span>";
            } else {
                return "<span class='label label-danger'>InActive</span>";
            }
        });

        // $grid->column('qualification', __('Qualification'));
        // $grid->column('date_of_joined', __('Date of joined'));
        // $grid->column('bank_name', __('Bank name'));
        // $grid->column('account_number', __('Account number'));
        // $grid->column('ifsc_number', __('Ifsc number'));
        // $grid->column('branch_name', __('Branch name'));
        // $grid->column('photo', __('Photo'));
        // $grid->photo()->display(function ($image) {
        //     if ($image != '') {
        //         $env = getenv('APP_URL') . '/uploads/' . $image;
        //         return "<img src='$env'  width='50' height='50'/>";
        //     } else {
        //         $dummy = "default.jpg";
        //         return '<img src="/uploads/images/' . $dummy . '"  width="50"/>';
        //     }
        // });
        // $grid->column('nominee_pan', __('Nominee pan'));
        // $grid->column('nominee_pan_img', __('Nominee pan img'));
        // $grid->column('nominee_aadhar', __('Nominee aadhar'));
        // $grid->column('nominee_aadhar_img', __('Nominee aadhar img'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $center = Center::select(DB::raw('CONCAT("00",id, " - ", center_name) as center_name'), 'id')
                ->pluck('center_name', 'id');

            $filter->disableIdFilter();
            // Add a column filter
            // $filter->like('currency');
            // $filter->like('client_name', 'Member Name');
            // $filter->like('father_name');
            // $filter->like('address');
            // $filter->like('phone_number');
            // $filter->equal('status', 'Status')->select([1 => 'Active', 0 => 'In Active']);
            $filter->like('center_id', 'Center Name')->select($center);
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
        $show = new Show(Member::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('center_id', __('Center id'));
        $show->field('client_name', __('Client name'));
        $show->field('address', __('Address'));
        $show->field('city', __('City'));
        $show->field('state', __('State'));
        $show->field('pincode', __('Pincode'));
        $show->field('country', __('Country'));
        $show->field('dob', __('Dob'));
        $show->field('age', __('Age'));
        $show->field('gender', __('Gender'));
        $show->field('community', __('Community'));
        $show->field('religion', __('Religion'));
        $show->field('marital_status', __('Marital status'));
        $show->field('monthly_income', __('Monthly income'));
        $show->field('monthly_expenses', __('Monthly expenses'));
        $show->field('smartcard_no', __('Smartcard no'));
        $show->field('smartcard_img', __('Smartcard img'));
        $show->field('voter_id', __('Voter id'));
        $show->field('voterid_img', __('Voterid img'));
        $show->field('aadhar_no', __('Aadhar no'));
        $show->field('aadhar_img', __('Aadhar img'));
        $show->field('pancard_no', __('Pancard no'));
        $show->field('pancard_img', __('Pancard img'));
        $show->field('home_status', __('Home status'));
        $show->field('spouse_name', __('Spouse name'));
        $show->field('spouse_occupation', __('Spouse occupation'));
        $show->field('nominee_name', __('Nominee name'));
        $show->field('nominee_mobile', __('Nominee mobile'));
        $show->field('relation_with_client', __('Relation with client'));
        $show->field('nominee_dob', __('Nominee dob'));
        $show->field('no_of_children', __('No of children'));
        $show->field('father_name', __('Father name'));
        $show->field('mother_name', __('Mother name'));
        $show->field('qualification', __('Qualification'));
        $show->field('date_of_joined', __('Date of joined'));
        $show->field('bank_name', __('Bank name'));
        $show->field('account_number', __('Account number'));
        $show->field('ifsc_number', __('Ifsc number'));
        $show->field('branch_name', __('Branch name'));
        $show->field('photo', __('Photo'));
        $show->field('nominee_pan', __('Nominee pan'));
        $show->field('nominee_pan_img', __('Nominee pan img'));
        $show->field('nominee_aadhar', __('Nominee aadhar'));
        $show->field('nominee_aadhar_img', __('Nominee aadhar img'));
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
        $form = new Form(new Member());

        $form->tab('Member Details', function (Form $form) {

            $checkId = Member::orderbydesc('id')->first();
            // $center = Center::pluck('center_name', 'id')->toArray();
            $center = Center::select(DB::raw('CONCAT("00",id, " - ", center_name) as center_name'), 'id')
                ->pluck('center_name', 'id');
            $staff = Employee::where('status', 1)->pluck('staff_name', 'id');
            // $center = Center::pluck('center_name', 'id')->map(function ($center_name, $id) {
            //     return "00" . $id . ' - ' . $center_name;
            // })->toArray();
            // dd(request()->segment(3));
            if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {

                $form->display('Member ID')->value(is_object($checkId) ? $checkId->id + 1 : 1);
            }
            $form->select('center_id', __('Select Center '))->options($center)->required();
            $form->hidden('staff_id', __('Select Employee '));

            $form->text('client_name', __('Member name'))->rules('required');
            $form->image('photo', __('Photo'))->uniqueName();
            $form->date('dob', __('DOB'))->rules(['required', 'date', 'before_or_equal:' . date('Y-m-d', strtotime('-18 years')), 'after_or_equal:' . date('Y-m-d', strtotime('-60 years'))])->attribute(['id' => 'dob_date'])->format('DD-MM-YYYY');

            // $form->date('dob', __('Dob'))->min(date('Y-m-d', strtotime('-18 years')))->max(date('Y-m-d', strtotime('+58 years')))->default(date('Y-m-d'));
            $form->text('age', __('Age'))->attribute(['id' => 'age'])->readonly()->disable();
            $form->select('gender', __('Gender'))->options(['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other']);


            $form->text('phone_number', __('Mobile'))->rules('required');

            $form->text('address', __('Address'))->rules('required');
            $form->text('city', __('City'));
            $form->text('pincode', __('Pincode'))->attribute(['class' => 'numberic form-control']);
            $form->text('state', __('State'));
            $form->text('country', __('Country'));
            $form->select('community', __('Community'))->options(['BC' => 'BC', 'MBC' => 'MBC', 'SC' => 'SC', 'ST' => 'ST', 'Other' => 'Other', 'Not prefer to say' => 'Not prefer to say'])->default('Not prefer to say')->rules('required');
            $relegion = ['Hindu', 'Muslim', 'Christian', 'Other', 'Not prefer to say'];
            $qualification = ['SSLC', 'HSC', 'UG', 'PG', 'Other'];
            $m_sts = ['Single', 'Married', 'Widow', 'Divorced', 'Other'];
            $home_sts = ['Own', 'Rent', 'Lease'];
            $form->select('religion', __('Religion'))->options(array_combine($relegion, $relegion))->default('Not prefer to say')->rules('required');
            $form->select('qualification', __('Qualification'))->options(array_combine($qualification, $qualification))->default('SSLC')->rules('required');
            $form->select('marital_status', __('Marital status'))->options(array_combine($m_sts, $m_sts))->default('Single')->rules('required');
            $form->text('monthly_income', __('Monthly income'))->attribute(['class' => 'numberic form-control form-control'])->rules('required');
            $form->text('monthly_expenses', __('Monthly expenses'))->attribute(['class' => 'numberic form-control'])->rules('required');
            $form->select('home_status', __('Home status'))->options(array_combine($home_sts, $home_sts))->default('Own')->rules('required');

            $form->date('date_of_joined', __('Date of joined'))->default(date('Y-m-d'))->rules('required');
            $form->select('status', __('Member status'))->options([1 => 'Active', 0 => 'In Active'])->default(1)->rules('required');
        })->tab('Member Family Details', function (Form $form) {
            $form->text('father_name', __('Father Name'))->rules('required');
            $form->text('mother_name', __('Mother Name'))->rules('required');
            $form->text('spouse_name', __('Spouse Name'))->rules('required');
            $form->text('spouse_occupation', __('Spouse Occupation'))->rules('required');
            $form->number('no_of_adult', __('Number of Adult'))->default(0)->rules('required')->attribute(['id' => 'adult'])->min(0)->max(10);
            $form->number('no_of_children', __('Number of children'))->default(0)->rules('required')->attribute(['id' => 'child'])->min(0)->max(10);
            $form->text('total_family_members', __('Total Family Members'))->default(0)->rules('required')->attribute(['id' => 'total_member'])->readonly();
        })->tab('Member Document', function (Form $form) {
            // $form->image('smartcard_img', __('SmartCard Photo'))->rules('required')->uniqueName();
            $form->text('smartcard_no', __('SmartCard No'))->rules('required');
            // $form->image('voterid_img', __('VoterID Photo'))->rules('required')->uniqueName();
            $form->text('voter_id', __('Voter ID'))->rules('required');
            // $form->image('aadhar_img', __('Aadhar Card Photo'))->rules('required')->uniqueName();
            $form->text('aadhar_no', __('Aadhar Card Number'))->rules('required')->attribute(['class' => 'form-control numberic']);
            $form->image('pancard_img', __('PAN Card Photo'))->uniqueName();
            $form->text('pancard_no', __('PAN Card Number'));
        })->tab('Nominee Details', function (Form $form) {
            $form->text('nominee_name', __('Nominee name'))->rules('required');
            $form->text('nominee_mobile', __('Nominee mobile'))->rules('required');
            $client = ['Mother', 'Father', 'Wife', 'Husband', 'Brother', 'Sister', 'Other'];
            $form->select('relation_with_client', __('Relation with Member'))->options(array_combine($client, $client));
            $form->date('nominee_dob', __('Nominee dob'))->default(date('Y-m-d'))->rules(['required', 'date', 'before_or_equal:' . date('Y-m-d', strtotime('-18 years')), 'after_or_equal:' . date('Y-m-d', strtotime('-58 years'))])->format('DD-MM-YYYY');
            // $form->image('nominee_aadhar_img', __('Nominee Aadhar Card'))->rules('required')->uniqueName();
            $form->text('nominee_aadhar', __('Nominee Aadhar Number'))->attribute(['class' => 'numeric form-control'])->rules('required');
            $form->image('nominee_voter_img', __('Nominee voter Photo'))->uniqueName();
            $form->text('nominee_voter_id', __('Nominee voter Number'))->attribute(['class' => 'numeric form-control']);
            // $form->image('nominee_pan_img', __('Nominee PAN Card Photo'))->rules('required')->uniqueName();
            // $form->text('nominee_pan', __('Nominee PAN Card Number'))->rules('required');
            $form->image('nominee_other_img', __('Nominee Other Photo'))->uniqueName();
            $form->text('nominee_other_id', __('Nominee Other Number'));
        })
            ->tab('Bank Details', function (Form $form) {
                $form->text('account_holder_name', __('Account Holder name'));
                $form->text('account_number', __('Account Number'));
                $form->text('bank_name', __('Bank Name'));
                $form->text('ifsc_number', __('IFSC Code'));
                $form->text('branch_name', __('Branch Name'));
            });
        $form->hidden('inactive_time');
        $form->saving(function (Form $form) {
            $agecal = date('Y', strtotime($form->dob));
            $form->age = abs($agecal - date('Y'));
            if ($form->status == 0) {
                $form->inactive_time = date('Y-m-d H:i:s');
            }
            $form->staff_id = Center::find($form->center_id)->employee_id;
        });
        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();

            // disable submit btn
            // $footer->disableSubmit();

            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

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
        Admin::script('
        $(function () {
            $("#dob_date").on("blur", function (e) {
                var dateParts = $(this).val().split("-");
                var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
                const current = new Date(formattedDate).getFullYear() - new Date().getFullYear();
                $("#age").val(Math.abs(current));
            });

            $(".numberic").on("input", function () {
                this.value = this.value.replace(/[^0-9]/g, "");
            });
            // $("#adult").on("input", function () {
            //     this.value = this.value.replace(/[^0-9]/g, "");
            // });
            // $("#child").on("input", function () {
            //     this.value = this.value.replace(/[^0-9]/g, "");
            // });
            $("#adult").on("change",function(){
                this.value = this.value.replace(/[^0-9]/g, "");
                var adult = parseInt($("#adult").val()) 
                var child = parseInt($("#child").val())
                console.log(adult,child)
                var total = adult + child
                $("#total_member").val(total)
            })
            $("#child").on("change",function(){
                this.value = this.value.replace(/[^0-9]/g, "");
                var adult = parseInt($("#adult").val()) 
                var child = parseInt($("#child").val())
                console.log(adult,child)
                var total = adult + child
                $("#total_member").val(total)
            })



        });
        ');



        return $form;
    }
}
