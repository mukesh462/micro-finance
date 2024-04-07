<?php

namespace App\Admin\Controllers;

use App\Models\Center;
use App\Models\CenterOwnerList;
use App\Models\Collection;
use App\Models\Employee;
use App\Models\LoanAccount;
use App\Models\Member;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin as FacadesAdmin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CenterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Center';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Center());

        $grid->column('id', __('Center Id'))->display(function ($id) {
            return "00" . $id;
        });
        $grid->column('center_name', __('Center Name'));
        $grid->column('employee_id', __('Employee Name'))->display(function ($employee_id) {
            $employee = Employee::where('id', $employee_id)->first();
            return $employee->staff_name;
        });
        $grid->column('meeting_date', __('Meeting Date'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->disableBatchActions();
        $grid->disableColumnSelector();
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->like('center_name', 'Center Name');
        });
        $grid->disableExport();
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
        $show = new Show(Center::findOrFail($id));

        $show->field('id', __('Id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Center());
        $checkId = Center::orderBy('id', "desc")->first();
        $employees = Employee::where('status', 1)->pluck('staff_name', 'id');
        //         $form->html('

        //         <label for="employee_id" class="col-sm-2 asterisk control-label">Select Employee</label>

        //             // <div class="col-sm-8" data-select2-id="select2-data-57-c1vq">
        //             <select type="text" class="member-select form-control" id="staff"
        //             placeholder="Select Member">
        //  </select>
        //             // </div>

        //    ');
        // if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {
        // $center = Center::pluck('employee_id')->toArray();
        // $employees = Employee::where('status', 1)->whereNotIn('id', $center)->pluck('staff_name', 'id');
        // } else {
        // $center = Center::whereNot('id', request()->segment(3))->pluck('employee_id')->toArray();
        // $employees = Employee::where('status', 1)->whereNotIn('id', $center)->pluck('staff_name', 'id');
        // }
        $dayNames = array(
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday'
        );
        if (request()->segment(3) == 'create#tab-form-1' || request()->segment(3) == 'create') {
            $form->display('Center Id')->value(is_object($checkId) ? "00" . $checkId->id + 1 : "001");
        } else {
        }
        $form->text('center_name', __('Center Name'))->rules('required');
        $form->radio('center_type', __('Center type'))->rules('required')->options([1 => 'Week', 2 => '14 Days', 3 => 'Month'])->required();
        // $form->text('')
        // ->when(1, function (Form $form) use ($dayNames) {
        //     $form->select('day_in_number', 'Select Day')->options($dayNames)->attribute(['id' => 'day_select']);
        $form->date('meeting_date', __('Next Meeting Date'))->format('DD-MM-YYYY')->rules(['required', 'date'])->attribute(['id' => "date-find"]);
        //     // $form->text('meeting_day', __('Meeting Day'))->attribute(['id' => "dagy-id"])->readonly();
        //     $form->time('meeting_time', __('Meeting Time'))->format('h:mm A')->rules('required');
        // })->when(2, function (Form $form) use ($dayNames) {
        //     $form->select('day_in_number', 'Select day')->options($dayNames)->attribute(['id' => '14-day-select']);
        //     $form->date('meeting_date', __('Next Meeting Date'))->format('DD-MM-YYYY')->rules(['required', 'date'])->attribute(['id' => "14day-id"])->readonly();
        //     // $form->text('meeting_day', __('Meeting Day'))->attribute(['id' => "dagy-id"])->readonly();
        //     $form->time('meeting_time', __('Meeting Time'))->format('h:mm A')->rules('required');
        // })->when(3, function (Form $form) use ($dayNames) {
        //     // $form->select('name', 'Select Day')->options($dayNames)->attribute(['id' => '14-day-select']);
        //     $form->date('meeting_date', __('Next Meeting Date'))->format('DD-MM-YYYY')->rules(['required', 'date'])->minDate(date('DD-MM-YYYY'))->attribute(['id' => "month-id"]);
        // })->required();

        $form->text('meeting_day', __('Meeting Day'))->attribute(['id' => "day-find"])->readonly();
        $form->time('meeting_time', __('Meeting Time'))->format('h:mm A')->rules('required');
        $form->date('formation_date', __('Formation Date'))->format('DD-MM-YYYY')->default(date('d-m-Y'))->rules(['required', 'date']);
        $form->text('center_address', __('Center Address'))->rules('required');
        $form->select('employee_id', __('Select Employee'))->options($employees)->rules('required');


        $form->text('meeting_place', __('Meeting Place'))->rules('required');
        $form->text('mobile_number', 'Mobile Number')->rules('required|regex:/^[0-9]+$/|min:10');
        $form->tools(function (Form\Tools $tools) {
            // $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
            // $tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        $form->saving(function (Form $form) use ($dayNames) {
            // if (($form->model()->id != null) && ($form->model()->employee_id != $form->employee_id)) {

            // } else if ($form->model()->id == null) {

            // }

            if ($form->model()->id == null) {
                // $employee = Employee::where('id', $form->model()->employee_id)->first();
                // if (is_object($employee)) {
                //     $employee->center_id = $form->model()->id;
                //     $employee->save();
                // }
                $centerId = Center::orderBy('id', "desc")->first();
                $newCenter = new CenterOwnerList();
                $newCenter->center_id = is_object($centerId) ? $centerId->id + 1 : 1;
                $newCenter->employee_id = $form->employee_id;
                $newCenter->save();
            } else if ($form->model()->employee_id != $form->employee_id) {
                // $employee = Employee::where('id', $form->model()->employee_id)->first();
                // if (is_object($employee)) {
                //     $employee->center_id = NULL;
                //     $employee->save();
                // }
                // $employee1 = Employee::where('id', $form->employee_id)->first();
                // if (is_object($employee1)) {
                //     $employee1->center_id = $form->model()->id;
                //     $employee1->save();
                // }
                $newCenter = new CenterOwnerList();
                $newCenter->center_id = $form->model()->id;
                $newCenter->employee_id = $form->employee_id;
                $newCenter->save();
            }
        });
        $form->saved(function (Form $form) {
            // $employee = Employee::where('id', $form->model()->employee_id)->first();
            // if (is_object($employee)) {
            //     $employee->center_id = $form->model()->id;
            //     $employee->save();
            // }
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });
        // Admin::css("/select2/dist/css/select2.min.css");
        // Admin::js('/jquery/jquery.min.js');
        // Admin::js('/select2/dist/js/select2.min.js');
        Admin::script('
        function getNextDayDate(selectedDay) {
            // Get the current date
            var currentDate = new Date();

            // Get the current day of the week (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
            var currentDayOfWeek = currentDate.getDay();

            // Calculate the difference in days between the selected day and the current day
            var dayDifference = (selectedDay - currentDayOfWeek + 7) % 7;

            // Add the difference to the current date to get the next occurrence of the selected day
            var nextDayDate = new Date(currentDate.getTime() + dayDifference * 24 * 60 * 60 * 1000);

            // Format the date to DD-MM-YYYY
            var formattedDate = ("0" + nextDayDate.getDate()).slice(-2) + "-" + ("0" + (nextDayDate.getMonth() + 1)).slice(-2) + "-" + nextDayDate.getFullYear();

            return formattedDate;
        }


        // Example usage:
        var selectedDay = 0; // 0 for Sunday
        var nextSundayDate = getNextDayDate(selectedDay);

        // console.log(nextSundayDate.toDateString()); // Output the date of the next Sunday
        $("#day_select").on("change", function () {
            console.log($(this).val(), "ut");
            $("#day-id").val(getNextDayDate($(this).val()))
        })
        $("#day-id").val(nextSundayDate)
        function getDateAfterDays(dayOfWeek) {
            // Get the current date
            var currentDate = new Date();

            // Calculate the difference in days between the selected day and the current day
            var dayDifference = (dayOfWeek - currentDate.getDay() + 7) % 7;

            // Add the difference to the current date to get the next occurrence of the selected day
            var nextDayDate = new Date(currentDate.getTime() + dayDifference * 24 * 60 * 60 * 1000);

            // Add 14 days to the next occurrence of the selected day
            nextDayDate.setDate(nextDayDate.getDate() + 14);

            // Format the date to DD-MM-YYYY
            var formattedDate = ("0" + nextDayDate.getDate()).slice(-2) + "-" + ("0" + (nextDayDate.getMonth() + 1)).slice(-2) + "-" + nextDayDate.getFullYear();

            return formattedDate;
        }

        // Example usage:
        var selectedDay = 0; // 0 for Sunday
        var dateAfter14Days = getDateAfterDays(selectedDay);


        $("#14-day-select").on("change", function () {
            console.log($(this).val(), "ut");
            $("#14day-id").val(getDateAfterDays($(this).val()))
        })
        $("#14day-id").val(dateAfter14Days)

        $("#date-find").on("blur", function () {
            var value = $("#date-find").val();

            var dateParts = value.split("-");
            var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
            var date = new Date(formattedDate);
            var dayNumber = date.getDay();
            var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            $("#day-find").val(daysOfWeek[dayNumber])
        });

        $("#day-id").on("blur", function () {
            var clumn = $(this).val();
            console.log($(this).val(), "value");
            var dateParts = clumn.split("-");
            var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
            var date = new Date(formattedDate);
            var dayNumber = date.getDay();
            $(`#day_select option[value="${dayNumber}"]`).prop("selected", true).change()
        })
     ');
        return $form;
    }

    public function getCenter(Request $request)
    {

        // Retrieve parameters from the request
        $q = $request->input('q', ''); // Search term
        $page = $request->input('page', 1); // Current page number
        $limit = 10; // Number of records per page

        // Calculate the offset
        $offset = ($page - 1) * $limit;

        // Query data with limit and offset
        //  $data = Employee::where('staff_name', 'like', '%' . $q . '%')
        //      ->offset($offset)
        //      ->limit($limit)
        //      ->get();

        //  // Count total records for pagination
        //  $totalCount = Employee::where('column', 'like', '%' . $q . '%')->count();
        // $query = Center::where('center_name', 'like', '%' . $q . '%')->join('employees', 'centers.employee_id', '=', 'employees.center_id')->select('centers.id as centerId', 'centers.center_name', 'employees.id as employeeId', 'employees.staff_name');
        $query = Center::select(DB::raw('CONCAT("00",id, " - ", center_name) as center_name'), 'id')->where('center_name', 'like', '%' . $q . '%');
        $totalCount = $query->count();
        $data = $query->offset(($page - 1) * $limit)->limit($limit)->get();

        // foreach($data as $key=>$value) {
        //     $data[$key]['member'] = Member::select('id','client_name')->where('center_id',$value->centerId)->get();
        // }

        // Prepare response data
        $response = [
            'results' => $data,
            'total_count' => $totalCount
        ];

        // Return JSON response
        return response()->json($response);
    }

    public function getDetails(Request $request)
    {

        // Retrieve parameters from the request
        $id = $request->input('center_id'); // Search term
        $data['employee'] = Employee::select('id', 'staff_name')->where('center_id', $id)->first();
        $data['member'] = Member::select('id', 'client_name')->where('center_id', $id)->get();
        // Prepare response data
        $response = [
            'results' => $data,
        ];
        // Return JSON response
        return response()->json($response);
    }
    public function getLoan(Request $request)
    {

        // Retrieve parameters from the request
        $id = $request->input('member_id'); // Search term
        // $data['employee'] = Employee::select('id', 'staff_name')->where('center_id', $id)->first();
        $data['loan'] =   LoanAccount::select('id', 'loan_no')->where('member_id', $id)->where('loan_status', 0)->get();
        // Prepare response data
        $response = [
            'results' => $data,
        ];
        // Return JSON response
        return response()->json($response);
    }
    public function getLoanDetails(Request $request)
    {
        // Retrieve parameters from the request
        $id = $request->input('loan_id'); // Search term
        // $data['employee'] = Employee::select('id', 'staff_name')->where('center_id', $id)->first();
        $data['loan'] = LoanAccount::where('id', $id)->where('loan_status', 0)->first();
        $data['collection'] = Collection::where('status', 1)->where('loan_id', $id)->first();
        if(is_object($data['collection'])){
            $last = Collection::where('status', 2)->where('loan_id', $id)->latest()->first();
            $data['balance_amount'] = is_object($last) ? $last->due_balance : 0;
            $data['total_amount'] = $data['balance_amount'] + $data['collection']->collection_price + $data['collection']->collection_interest;
            $response = [
                'message'=>'data Found',
                'results' => $data,
           ];
        }else{
            $response = [
                'message'=>'No collection to pay',
                'results' => [],
           ];
        }
        // Prepare response data
        // Return JSON response
        return response()->json($response);
    }
    public function collectionUpdate(Request $request)
    {
        $input = $request->all();
        $loan = LoanAccount::where('id', $input['loan_id'])->where('loan_status', 0)->first();
        $last = Collection::where('status', 2)->where('loan_id', $input['loan_id'])->latest()->first();
        $balance_amount = is_object($last) ? $last->due_balance : 0;
        $collection =  Collection::where('id', $input['collection_id'])->where('loan_id', $input['loan_id'])->where('status', 1)->first();
        if (is_object($collection)) {
            $total_amount =  $balance_amount + $collection->collection_amount;
            if ($input['loan_collected'] > $total_amount) {
                $response['message'] = "Collection amount must be equal to due amount";
                return response()->json($response);
            } else if ($input['loan_collected'] <= $balance_amount && $balance_amount > 0) {
                $loan->outstanding_amount = $loan->outstanding_amount - $input['loan_collected'];
                $loan->save();
                $last->due_balance = $last->due_balance - $input['loan_collected'];
                $last->collected_amount = $last->collected_amount + $input['loan_collected'];
                $last->save();
                $response['message'] = "Collection updated successfully";
                return response()->json($response);
            } else {
                $collected_amount = $input['loan_collected'];
                $loan->outstanding_amount = $loan->outstanding_amount - $input['loan_collected'];
                $loan->save();
                if ($balance_amount > 0) {
                    $collected_amount = $collected_amount - $balance_amount;
                    $last->due_balance = 0;
                    $last->collected_amount = $last->collected_amount + $balance_amount;
                    $last->status = 3;
                    $last->save();
                }else if(is_object($last)){
                    $last->status = 3;
                    $last->save();
                }
                $collection->collected_amount = $collected_amount;
                $collection->due_balance = $collection->collection_amount - $collected_amount;
                $collection->collection_type = $input['collection-type'];
                $collection->status = 2;
                if($loan->outstanding_amount == 0){
                    $collection->status = 3;
                }
                $collection->save();
                $response['message'] = "Collection updated successfully";
                return response()->json($response);
            }
        } else {
            // $total_amount =  $balance_amount;
            // if ($input['loan_collected'] <= $balance_amount && $balance_amount > 0) {
            //     $loan->outstanding_amount = $loan->outstanding_amount - $input['loan_collected'];
            //     $loan->save();
            //     $last->due_balance = $last->due_balance - $balance_amount;
            //     $last->collected_amount = $last->collected_amount + $balance_amount;
            //     $last->save();
            //     $response['message'] = "Collection updated successfully";
            //     return response()->json($response);
            // } else {
                $response['message'] = "Amount already collected";
                return response()->json($response);
            // }
        }
    }

    public function collectionList()
    {
        return FacadesAdmin::content(function (Content $content) {

            // optional
            // $content->header(' Collection');

            // $content->description('Single Member collection');
            // $grid = new Grid(new Collection());
            $grid = new Grid(new Collection());
            $grid->model()->whereIn('status', [2,3]);
            $grid->column('id', __('Id'));
            $grid->column('center_id', __('Center'))->display(function($center_id){
               $center = Center::where('id',$center_id)->first();
               return "00".$center_id."-".$center->center_name;
             });
            $grid->column('member_id', __('Member'))->display(function($member_id){
               $member = Member::where('id',$member_id)->first();
               return is_object($member)?'00'.$member->id.'-'.$member->client_name:"---";
            });
            $grid->column('due_number', __('Collection Week'));
            $grid->column('due_date', __('Due Date'));
            $grid->column('collection_amount', __('Collection Amount'));
            $grid->column('collected_amount', __('Collected Amount'));
            $grid->column('due_balance', __('Due Balance'));
            // $grid->column('collection_type', __('Collection Type'));
            $grid->column('Action')->display(function () {
                if($this->status == 3) {
                    return "<span class='btn btn-success'>Paid</span>";
                }else{
                    return "<a href='/admin/collectionEdit/$this->id'>Edit</a>";
                }
            });



            // $grid->column('updated_at', __('Updated at'));
            $grid->disableBatchActions();
            $grid->disableColumnSelector();
            // $grid->filter(function ($filter) {
            //     // Remove the default id filter
            //     $filter->disableIdFilter();
            //     // $filter->like('center_name', 'Center Name');
            // });
            $grid->disableFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
            $content->body(new Box('Collection List', $grid->render()));
        });
    }

    public function collectionEdit(Request $request) {
        $id = $request->segment('3');
        $collection = Collection::where('id',$id)->where('status',2)->first();
        if(!is_object($collection)) {
            abort(404);
        }
        return FacadesAdmin::content(function (Content $content) use ($collection) {
            $data['collection'] = $collection;
            $data['loan'] = LoanAccount::where('id',$collection->loan_id)->first();
            $data['employee'] = Employee::select('id','staff_name')->where('id', $collection->staff_id)->first();
            $data['Center'] = Center::select('id','center_name')->where('id', $collection->center_id)->first();
            $data['Member'] = Member::select('id','client_name')->where('id', $collection->member_id)->first();
            // optional
            // $content->header('Collection');
            // $content->description('Single Member collection');
            $content->body( new Box('',view('collection_edit',['data'=>$data])));
        });
    }

    public function editCollection(Request $request)
    {
        $input = $request->all();
        $loan = LoanAccount::where('id', $input['loan_id'])->where('loan_status', 0)->first();
        // $last = Collection::where('status', 2)->where('loan_id', $input['loan_id'])->latest()->first();
        // $balance_amount = is_object($last) ? $last->due_balance : 0;
        $collection =  Collection::where('id', $input['collection_id'])->where('loan_id', $input['loan_id'])->where('status', 2)->first();
        if (is_object($collection)) {
            $total_amount = $collection->collection_amount;
            if ($input['loan_collected'] > $total_amount) {
                $response['message'] = "Collection amount must be equal to due amount";
                return response()->json($response);
            }else if($input['loan_collected'] == 0){
                $collected_amount = $input['loan_collected'];
                $loan->outstanding_amount = $loan->outstanding_amount + $collection->collected_amount;
                $loan->save();
                $collection->collected_amount = $collected_amount;
                $collection->due_balance = 0;
                $collection->status = 1;
                $collection->save();
                $last = Collection::where('status', 3)->where('loan_id', $input['loan_id'])->latest()->first();
                $last->status = 2;
                $last->save();
                // $loan->outstanding_amount = $loan->outstanding_amount - $collected_amount;
                // $loan->save();
                $response['message'] = "Collection updated successfully";
                return response()->json($response);
            }else {
                $collected_amount = $input['loan_collected'];
                $loan->outstanding_amount = $loan->outstanding_amount + $collection->collected_amount;
                $loan->save();
                $collection->collected_amount = $collected_amount;
                $collection->due_balance = $collection->collection_amount - $collected_amount;
                $collection->status = 2;
                $loan->outstanding_amount = $loan->outstanding_amount - $collected_amount;
                $loan->save();
                if($loan->outstanding_amount == 0){
                    $collection->status = 3;
                }
                $collection->save();
                $response['message'] = "Collection updated successfully";
                return response()->json($response);
            }
        } else {
            $response['message'] = "Amount already collected";
            return response()->json($response);
        }
    }
    public function getMultipleDetails(Request $request)
    {

        // Retrieve parameters from the request
        $id = $request->input('center_id'); // Search term
        $date = $request->input('date'); // Search term
        $date = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        // $date = "2024-04-28";
        // $id = $request->input('loan_id'); // Search term
        // $data['employee'] = Employee::select('id', 'staff_name')->where('center_id', $id)->first();
        // $data['loan'] = LoanAccount::where('id', $id)->where('loan_status', 0)->first();
        $collections = Collection::where('status', 1)->where('center_id', $id)->where('due_date', $date)->get();
        $loan_outstanding = 0;
        $total_balance = 0;
        $total_amount = 0;
        foreach($collections as $key=>$collection){
            $lasts = Collection::where('loan_id',$collection->loan_id)->where('status','!=',3)->where('center_id', $id)->where('due_date','<', $date)->get();
            $balance_amount = 0;
            if(count($lasts) > 0) {
                foreach($lasts as $last){
                    if($last->status == 2) {
                        $balance_amount =($last->collection_amount - $last->collected_amount) + $balance_amount;
                    }else if($last->status ==1) {
                        $balance_amount = $balance_amount + $last->collection_amount;
                    }
                }
            }
            $collections[$key]['balance_amount'] = $balance_amount;
            $collections[$key]['total_amount'] = $collection->collection_amount + $balance_amount;
            $collections[$key]['member'] = Member::where('id',$collection->member_id)->first();
            $loan = LoanAccount::where('id', $collection->loan_id)->where('loan_status', 0)->first();
            $loan_outstanding = $loan->outstanding_amount + $loan_outstanding;
            $total_balance = $balance_amount + $total_balance;
            $total_amount = $total_amount + $collection->collection_amount;
            $collections[$key]['loan'] = $loan;
        }
        $data['collections'] = $collections;
        $data['total_balance'] = $total_balance;
        $data['total_amount'] = $total_amount;
        $data['total_demand'] = $total_amount + $total_balance;
        $data['loan_outstanding'] = $loan_outstanding;

        // if(is_object($collections)){
        //     $last = Collection::where('status', 2)->where('loan_id', $id)->latest()->first();
        //     $data['balance_amount'] = is_object($last) ? $last->due_balance : 0;
        //     $data['total_amount'] = $data['balance_amount'] + $data['collection']->collection_price + $data['collection']->collection_interest;
            $response = [
                'message'=>'data Found',
                'results' => $data,
           ];
        // }else{
        //     $response = [
        //         'message'=>'No collection to pay',
        //         'results' => [],
        //    ];
        // }
        // Prepare response data
        // Return JSON response
        return response()->json($response);
    }

    public function multipleCollectionUpdate(Request $request)
    {

        // // Retrieve parameters from the request
        $id = $request->input('center'); // Search term
        $collection_id = $request->input('collection'); // Search term
        $date = $request->input('due_date'); // Search term
        $date = Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        // $date = "2024-04-28";
        // for($i=0;$i<count($collection_id);$i++){
            $collections = Collection::whereIn('id',$collection_id)->where('status', 1)->where('center_id', $id)->where('due_date', $date)->get();
            if(count($collections) > 0) {

            foreach($collections as $key=>$collection){
                $lasts = Collection::where('loan_id',$collection->loan_id)->where('status','!=',3)->where('center_id', $id)->where('due_date','<', $date)->get();
                $balance_amount = 0;
                if(count($lasts) > 0) {
                    foreach($lasts as $last){
                        if($last->status == 2) {
                            $balance_amount =($last->collection_amount - $last->collected_amount) + $balance_amount;
                            $last->due_balance = 0;
                            $last->collected_amount = $last->collection_amount;
                            $last->status =3;
                            $last->save();
                        }else if($last->status == 1) {
                            $balance_amount = $balance_amount + $last->collection_amount;
                            $last->due_balance = 0;
                            $last->collected_amount = $last->collection_amount;
                            $last->status =3;
                            $last->save();
                        }
                    }
                }
                $collection->collected_amount = $collection->collection_amount;
                $collection->status = 2;
                // $collections[$key]['balance_amount'] = $balance_amount;
                $total_amount = $collection->collection_amount + $balance_amount;
                // $collections[$key]['member'] = Member::where('id',$collection->member_id)->first();
                $loan = LoanAccount::where('id', $collection->loan_id)->where('loan_status', 0)->first();
                $loan->outstanding_amount = $loan->outstanding_amount - $total_amount;
                $loan->save();
                 if($loan->outstanding_amount == 0){
                    $collection->status = 3;
                }
                $collection->save();
                // $total_balance = $balance_amount + $total_balance;
                // $total_amount = $total_amount + $collection->collection_amount;
                // $collections[$key]['loan'] = $loan;
            }

            $response = [
                'message'=>'Collection Updated',
                'results' => $collections,
           ];
        }
        else{
            $response = [
                'message'=>'No collection to pay',
                'results' => [],
           ];
        }
        // Prepare response data
        // Return JSON response
        return response()->json($response);
    }
}
