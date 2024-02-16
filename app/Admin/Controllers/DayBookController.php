<?php

namespace App\Admin\Controllers;

use App\Models\DayBook;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('opening_balance', __('Opening balance'));
        $grid->column('closing_balance', __('Closing balance'));
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
}
