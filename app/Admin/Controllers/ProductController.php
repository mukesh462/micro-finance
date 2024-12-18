<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Encore\Admin\Admin;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('plan_name', __('Loan Type'));
        $grid->column('plan_amount', __('Loan amount'));
        $grid->column('interest_amount', __('Interest amount'))->display(function ($interest_amount) {
            if ($this->interest_type == 1) {
                return $interest_amount . " %";
            } else {
                return "Rs " . $interest_amount;
            }
        });
        $grid->column('interest_value', __('Interest Percentage Amount'))->display(function ($interest_value) {
            if ($this->interest_type == 1) {
                return $interest_value;
            } else {
                return "---";
            }
        });
        // $grid->column('plan_type', __('Plan type'));
        // $grid->column('plan_description', __('Plan description'));
        // $grid->column('plan_duration', __('Plan duration'));
        // $grid->column('interest_type', __('Interest type'));
        // $grid->column('plan_status', __('Plan status'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->disableColumnSelector();
        $grid->disableFilter();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        $grid->disableRowSelector();
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        // $show->field('plan_name', __('Plan name'));
        $show->field('plan_amount', __('Plan amount'));
        $show->field('interest_amount', __('Interest amount'));
        $show->field('plan_type', __('Plan type'));
        // $show->field('plan_description', __('Plan description'));
        $show->field('plan_duration', __('Plan duration'));
        $show->field('interest_type', __('Interest type'));
        // $show->field('plan_status', __('Plan status'));
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
        $form = new Form(new Product());
        $form->select('plan_type', __('Loan type'))->required()->options([1 => 'Weekly', 2 => "14 days", 3 => 'Monthly']);
        $form->number('plan_duration', __('Loan duration'))->min(1)->required();

        // $form->text('plan_name', __('Product name'))->rules('required');
        $form->decimal('plan_amount', __('Loan amount'))->rules(['required', 'numeric', 'min:1'])->attribute(['id' => 'loan-amount']);
        // $form->radio('interest_type', __('Interest type'))->required()->options([1 => 'Percentage', 2 => 'Fixed'])->when(1, function (Form $form) {
        //     $form->decimal('interest_amount', __('Interest Value'))->rules(['required', 'numeric', 'min:0.1', 'max:100']);
        // })->when(2, function (Form $form) {
        //     $form->decimal('interest_amount', __('Interest Value'))->rules(['required', 'numeric', 'min:1']);
        // });
        $form->select('interest_type', __('Interest type'))->required()->options([1 => 'Percentage', 2 => 'Fixed'])->attribute(['id' => 'interest-type']);

        $form->decimal('interest_amount', __('Interest Value'))->rules([
            'required',
            'numeric',
            function ($attribute, $value, $fail) {
                // Get the selected interest type
                $interestType = request()->input('interest_type');

                // Validate based on the selected interest type
                if ($interestType == 1) {
                    if ($value < 0.1 || $value > 100) {
                        $fail(__('The interest value must be between 0.1 and 100.'));
                    }
                } elseif ($interestType == 2) {
                    if ($value < 1) {
                        $fail(__('The interest value must be at least 1.'));
                    }
                }
            }
        ])->attribute(['id' => 'interest-amount']);
        $form->decimal('interest_value', __('Interest'))->attribute(['id' => "interest-value"]);

        // $form->text('plan_description', __('Product description'));
        // $form->select('plan_status', __(' status'))->options([1 => 'Active', 2 => 'Inactive'])->default(1);
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
        $form->saved(function (Form $form) {
            $loan = Product::where('id', $form->model()->id)->first();
            if (is_object($loan)) {
                if ($loan->plan_type == 1) {
                    $plan_name = $loan->plan_duration . "-Weeks";
                } else if ($loan->plan_type == 2) {
                    $plan_name = $loan->plan_duration . "-14 days";
                } else {
                    $plan_name = $loan->plan_duration . "-Months";
                }
                $loan->plan_name = $plan_name;
                $loan->save();
            }
        });

        Admin::script('
            $("#interest-value").closest("div.form-group").css("display", "none");

             $("#interest-type").on("change", function() {
        if ($(this).val() == 1) {
            $("#interest-value").closest("div.form-group").css("display", "block");
            $("#interest-value").prop("readonly", true);
            $("#interest-value").val("0");
            $("#interest-amount").val("0");
        } else {
            $("#interest-value").closest("div.form-group").css("display", "none");
            $("#interest-value").prop("readonly", false);
            $("#interest-value").val("0");
            $("#interest-amount").val("0");
        }
    });
 $(".interest-amount").on("input", function() {
        var value = $(this).val();
        if (!/^\d*\.?\d{0,2}$/.test(value)) {
            $(this).val(value.slice(0, -1)); // remove last character if not valid
        }
    });
    $("#interest-amount").on("keyup", function() {

            if($("#interest-type").val() == 1) {

    var interestRate = parseFloat($(this).val());

    var totalAmount = $("#loan-amount").val();
    var calculatedInterest = totalAmount * (interestRate / 100);

    $("#interest-value").val(calculatedInterest.toFixed(2)); // Displaying with two decimal places
    }
});


    $(document).ready(function(){
            if($("#interest-type").val() == 1) {
            $("#interest-value").closest("div.form-group").css("display", "block");
            $("#interest-value").prop("readonly", true);
    }

    })

        ');

        return $form;
    }
}
