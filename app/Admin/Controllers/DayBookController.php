<?php

namespace App\Admin\Controllers;

use App\Models\DayBook;
use App\Models\Voucher;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use PDF;

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
        $grid->column('View PDF')->display(function () {
            return "<a href ='/admin/viewDayBookReport/$this->id' target='_blank'>View Pdf</a>";
        });

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

    public function viewDayBookReport(HttpRequest $request)
    {
        $dayBook = DayBook::where('id', $request->segment(3))->first();

        if (is_object($dayBook)) {
            // dd($dayBook);
            $vouchers = Voucher::where('date', $dayBook->date)->get();
            $data['daybook'] = $dayBook;
            $data['vouchers'] = $vouchers;
        } else {
            return redirect()->back();
        }

        $pdf = PDF::loadView('day_book',['data' => $data]);

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="your_filename.pdf"',
        ];

        // Return the PDF content as a response
        return response($pdf->output(), 200, $headers);
    }
}
