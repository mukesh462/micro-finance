<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\IndexPage;
use App\Admin\Actions\Post\IndexView;
use App\Models\Center;
use App\Models\Employee;
use App\Models\Index;
use App\Models\IndexMember;
use App\Models\Member;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
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
        $grid = new Grid(new Index());

        $grid->column('id', __('Id'));
        $grid->index_no('Index No');
        $grid->column('index_date', __('Index Date'));
        $grid->index_status('Status')->display(function ($status) {
            if ($status == 1) {
                return "<span class='label label-info'>Index Created</span>";
            } else {
                return "<span class='label label-success'>Index Disbursement</span>";
            }
        });
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            // $actions->disableEdit();

            $actions->add(new IndexPage);
            $actions->add(new IndexView);

            $actions->disableEdit();
            $actions->disableView();
        });

        // $grid->column('plan_id', __('Plan id'));
        // $grid->column('loan_purpose', __('Loan purpose'));
        // $grid->column('plan_amount', __('Plan amount'));
        // $grid->column('staff_id', __('Staff id'));
        // $grid->column('loan_status', __('Loan status'));
        // $grid->column('center_id', __('Center id'));
        // $grid->column('index_id', __('Index id'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->disableExport();
        // $grid->actions(function ($actions) {
        //     $actions->disableDelete();
        //     $actions->add(new ManageDocument);
        //     // $actions->disableEdit();
        //     // $actions->disableView();
        // });
        $grid->disableCreateButton();
        $grid->tools(function ($tools) {
            $tools->append('
                <a href="http://localhost:8000/admin/indexes/create"  class="btn btn-sm btn-success pull-right" title="New">
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
            if ($request->tp == 'employee') {
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
                    $query->where('staff_id', $request->input('data')['id'] ?? 0)->where(DB::raw("LOWER(client_name)"), 'like', '%' . strtolower($request->input('q')) . '%');
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

                $results = $query->skip($offset)->take($perPage)->select('id', "plan_name as text")->get();
            } elseif ($request->tp == 'center') {
                $query = Center::query();
                // dd($request->input('data'));
                if ($request->has('q')) {
                    $query->where(DB::raw("LOWER(center_name)"), 'like', '%' . strtolower($request->input('q')) . '%');
                }

                $total = $query->count();

                $results = $query->skip($offset)->take($perPage)->select('id', DB::raw("CONCAT('00',id,'-',center_name) AS text"))->get();
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
    public function getemployee(Request $request)
    {
        $getEmp = Center::where('id', $request->id)->first();
        // dd(request()->input('id'));
        $data = Employee::find($getEmp->employee_id);
        return response()->json($data);
    }
    function getproduct(Request $request)
    {
        $getEmp = Product::where('id', $request->id)->first();
        // dd(request()->input('id'));

        return response()->json($getEmp);
    }
    public function addIndex(Request $request)
    {


        $dataList = json_decode($request->data);
        if (count($dataList) > 0) {
            $createIndex = new Index();
            $countCheck = Index::where('index_date', date('Y-m-d'))->count();
            $createIndex->index_date = date('Y-m-d');
            $row_id = $countCheck == 0 ? 1 : $countCheck + 1;
            $createIndex->index_no = date('Ymd') . $row_id;
            $createIndex->center_id = $dataList[0]->center;
            $createIndex->save();
            // dd($dataList);
            foreach ($dataList as $key => $value) {
                $createMember = new IndexMember();
                $createMember->member_id = $value->member;
                $createMember->plan_id = $value->plan;
                $createMember->loan_purpose = $value->purpose;
                $createMember->plan_amount = $value->amount;
                $createMember->staff_id = $value->employee_id;
                $createMember->center_id = $value->center;
                $createMember->index_id = $createIndex->id;
                $createMember->save();
            }
        }

        admin_toastr('Index Added Successfully');
        return redirect(admin_url('/indexes'));
    }
    function EditViewIndex($id, Request $request)
    {
        $getIndexMember = IndexMember::where('index_id', $id)->get();

        foreach ($getIndexMember as $key => $value) {
            # code...
            $center = Center::where('id', $value->center_id)->first();
            $getemp = Employee::where('id', $value->center_id)->first();
            $plan = Product::where('id', $value->plan_id)->first();
            $member = Member::where('id', $value->member_id)->first();
            $getIndexMember[$key]['sn'] = $key + 1;

            $getIndexMember[$key]['center_name'] = '00' . $center->id . '-' . $center->center_name;
            $getIndexMember[$key]['product_name'] = $plan->plan_name;
            $getIndexMember[$key]['member_name'] = $member->client_name;
            $getIndexMember[$key]['emp_name'] = $getemp->staff_name;
            $getIndexMember[$key]['purpose'] = $value->loan_purpose;
            $getIndexMember[$key]['amount'] = $value->plan_amount;
            $getIndexMember[$key]['plan'] = $plan->id;
            $getIndexMember[$key]['member'] = $value->member_id;
            $getIndexMember[$key]['staff_id'] = $getemp->id;
            $getIndexMember[$key]['center_id'] = $center->id;
        }
        // return $getIndexMember;
        return Admin::content(function (Content $content) use ($getIndexMember) {

            // optional
            $content->header(' Index');
            // $content

            // optional
            $content->description(' Edit Index Member');

            // add breadcrumb since v1.5.7
            // $content->breadcrumb(
            //     ['text' => 'Dashboard', 'url' => '/admin'],
            //     ['text' => 'User management', 'url' => '/admin/users'],
            //     ['text' => 'Edit user']
            // );



            // Direct rendering view, Since v1.6.12
            $content->body(new Box('', view('create_index', ['data' => $getIndexMember, 'type' => 'edit'])));
        });
    }
    public function editIndex(Request $request)
    {
        $dataList = json_decode($request->data);
        // dd($dataList);
        if (count($dataList) > 0) {
            $ids = [];
            foreach ($dataList as $key => $value) {
                if (isset($value->id)) {
                    array_push($ids, $value->id);
                    $createMember = IndexMember::where('id', $value->id)->first();
                    $createMember->member_id = $value->member;
                    $createMember->plan_id = $value->plan;
                    $createMember->loan_purpose = $value->purpose;
                    $createMember->plan_amount = $value->amount;
                    // $createMember->staff_id = $value->employee_id;
                    // $createMember->center_id = $value->center;
                    $createMember->index_id = $request->index_id;
                    $createMember->save();
                } else {
                    $createMember = new IndexMember();
                    $createMember->member_id = $value->member;
                    $createMember->plan_id = $value->plan;
                    $createMember->loan_purpose = $value->purpose;
                    $createMember->plan_amount = $value->amount;
                    $createMember->staff_id = $value->employee_id;
                    $createMember->center_id = $value->center;
                    $createMember->index_id = $request->index_id;
                    $createMember->save();
                    array_push($ids, $createMember->id);
                }
            }
            IndexMember::whereNotIn('id', $ids)->where('index_id', $request->index_id)->delete();
        } else {
            admin_toastr('Need one member to Edit', 'error');
            return admin_url('/indexes');
        }
        admin_toastr('Index Member Updated');
        return redirect(admin_url('/indexes'));
    }
    function ViewIndex($id)
    {
        $getIndexMember = IndexMember::where('index_id', $id)->get();

        foreach ($getIndexMember as $key => $value) {
            # code...
            $center = Center::where('id', $value->center_id)->first();
            $getemp = Employee::where('id', $value->center_id)->first();
            $plan = Product::where('id', $value->plan_id)->first();
            $member = Member::where('id', $value->member_id)->first();
            $getIndexMember[$key]['sn'] = $key + 1;

            $getIndexMember[$key]['center_name'] = '00' . $center->id . '-' . $center->center_name;
            $getIndexMember[$key]['product_name'] = $plan->plan_name;
            $getIndexMember[$key]['member_name'] = $member->client_name;
            $getIndexMember[$key]['emp_name'] = $getemp->staff_name;
            $getIndexMember[$key]['purpose'] = $value->loan_purpose;
            $getIndexMember[$key]['amount'] = $value->plan_amount;
            $getIndexMember[$key]['plan'] = $plan->id;
            $getIndexMember[$key]['member'] = $value->member_id;
            $getIndexMember[$key]['staff_id'] = $getemp->id;
            $getIndexMember[$key]['center_id'] = $center->id;
        }
        // return $getIndexMember;
        return Admin::content(function (Content $content) use ($getIndexMember) {

            $content->header(' Index');
            $content->description(' View Index Member');


            $content->body(new Box('', view('create_index', ['data' => $getIndexMember, 'type' => 'view'])));
        });
    }
    public function Disbursement()  {
        return Admin::content(function (Content $content)  {

            $content->header(' Loan');
            $content->description('Laon Disbursement');


            $content->body(new Box('', view('loan_dis',['type'=> 'create'])));
        });
    }
    public function editt($id)  {
        return Admin::content(function (Content $content) use ($id) {

            $content->header(' Loan');
            $content->description('Laon Disbursement end');


            $content->body(new Box('', view('loan_dis',['id'=>$id,'type'=>'edit'])));
        });
    }
}
