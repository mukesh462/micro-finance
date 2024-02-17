<?php

namespace App\Admin\Controllers;

use App\Models\Employee;
use App\Models\IndexMember;
use App\Models\Member;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Index';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new IndexMember());

        $grid->column('id', __('Id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('plan_id', __('Plan id'));
        $grid->column('loan_purpose', __('Loan purpose'));
        $grid->column('plan_amount', __('Plan amount'));
        $grid->column('staff_id', __('Staff id'));
        $grid->column('loan_status', __('Loan status'));
        $grid->column('center_id', __('Center id'));
        $grid->column('index_id', __('Index id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(IndexMember::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('member_id', __('Member id'));
        $show->field('plan_id', __('Plan id'));
        $show->field('loan_purpose', __('Loan purpose'));
        $show->field('plan_amount', __('Plan amount'));
        $show->field('staff_id', __('Staff id'));
        $show->field('loan_status', __('Loan status'));
        $show->field('center_id', __('Center id'));
        $show->field('index_id', __('Index id'));
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
        $form = new Form(new IndexMember());
        $form->hasMany('index', 'Items', function (Form\NestedForm $form) {
            $form->select('staff_id', __('Staff id'))->options(Employee::where('status', 1)->pluck('staff_name', 'id'));
            $form->select('member_id', __('Member '))->options(Member::where('status', 1)->pluck('client_name', 'id'));
            $form->select('plan_id', __('Product Select'))->rules('required')->options(Product::where('plan_status', 1)->pluck('plan_name', 'id')->toArray());
            $form->textarea('loan_purpose', __('Loan purpose'));
            $form->decimal('plan_amount', __('Plan amount'))->default(0.00);
            // $form->number('loan_status', __('Loan status'));
            // $form->number('center_id', __('Center id'));
            // $form->number('index_id', __('Index id'));
        });


        return $form;
    }
    public function getData(Request $request)
    {

        // return $tagged;
        $page = $request->input('page') ?? 1; // Get the requested page or default to 1

        $cacheKey = 'select2_data_' . md5(json_encode($request->all()));

        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($request, $page) {
            $perPage = 10; // Adjust the number of items per page as needed
            $offset = ($page - 1) * $perPage;
            if ($request->tp == 'staff') {
                $query = Employee::query();
                // $query->whereIn('id', $tagged);

                if ($request->has('q')) {
                    $query->where(DB::raw("LOWER(staff_name)"), 'like', '%' . strtolower(strtolower($request->input('q'))) . '%');
                }

                $total = $query->count();

                $results = $query->skip($offset)->take($perPage)->select('id', 'staff_name as text')->get();
            } elseif ($request->tp == 'member') {
                $query = Member::query();
                // dd($request->input('data'));
                if ($request->has('q')) {
                    $query->where('staff_id', $request->input('data')['id'])->where(DB::raw("LOWER(client_name)"), 'like', '%' . strtolower($request->input('q')) . '%');
                }

                $total = $query->count();

                $results = $query->skip($offset)->take($perPage)->select('id', 'client_name as text')->get();
            } else if ($request->tp == 'product') {
                $query = Product::query();
                // dd($request->input('data'));
                if ($request->has('q')) {
                    $query->where(DB::raw("LOWER(plan_name)"), 'like', '%' . strtolower($request->input('q')) . '%');
                }

                $total = $query->count();

                $results = $query->skip($offset)->take($perPage)->select('id', 'plan_name as text')->get();
            } else {
                //     $query = SubCategory::query();
                //     if ($request->has('q')) {
                //         $query->where(DB::raw("LOWER(name)"), 'like', '%' . strtolower($request->input('q')) . '%');
                //     }

                //     $total = $query->count();

                //     $results = $query->skip($offset)->take($perPage)->select('id', 'name as text')->get();
            }


            return [
                'results' => $results,
                'total_count' => $total,
            ];
        });

        return response()->json($data);
    }
}
