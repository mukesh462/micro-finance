<?php

namespace App\Admin\Controllers;

use App\Models\ManageDocument;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DocumentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Manage Document';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ManageDocument());

        $grid->column('id', __('Id'));
        $grid->column('document_name', __('Document name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('update_at', __('Update at'));
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
        $show = new Show(ManageDocument::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('document_name', __('Document name'));
        $show->field('created_at', __('Created at'));
        $show->field('update_at', __('Update at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ManageDocument());

        $form->text('document_name', __('Document name'))->required();
        // $form->datetime('update_at', __('Update at'))->default(date('Y-m-d H:i:s'));
        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
