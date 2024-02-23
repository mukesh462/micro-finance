<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\TestRow;
use App\Models\Pen;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use PHPUnit\Framework\Attributes\Test;

class PenController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pen';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pen());

        $grid->column('id', __('Id'));
        $grid->column('full_name', __('Full name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->disableCreateButton();

        $grid->actions(function ($action) {
            $action->add(new TestRow);
            $action->disableEdit();
            $action->disableView();
            $action->disableDelete();
        });
        $grid->tools(function ($tools) {
            $tools->append('
                <a href="http://localhost:8000/admin/pens/create" id="pen-create"  class="btn btn-sm btn-success pull-right" title="New">
                    <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;New</span>
                </a>
                <script>
                $(document).ready(function() {
                    $("#pen-create").on("click", function(e) {
                        e.preventDefault();
                        var url = $(this).attr("href");
                        window.location.href = url;
                        setTimeout(function() {
                            location.reload();
                        }, 1000); // 1000 milliseconds = 1 second
                    });
                });
            </script>
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
        $show = new Show(Pen::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('full_name', __('Full name'));
        $show->field('phone_number', __('Phone number'));
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

        $form = new Form(new Pen());

        $form->textarea('full_name', __('Full name'));
        $form->text('phone_number', __('Phone number'));

        return $form;
    }
}
