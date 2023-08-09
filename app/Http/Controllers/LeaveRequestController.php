<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveRequestDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveRequestController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $leaveRequests = DB::table('leave_requests as l')
                ->select('l.id', 'e.bio_code as bio_code', 'e.first_name as employee', 'a.name as type', 'l.request_on', 'l.days', 'l.reason', 'l.status', 'u.name as approved_by')
                ->leftJoin('employees as e', 'e.id', '=', 'l.employee')
                ->leftJoin('leave_types as a', 'a.id', '=', 'l.type')
                ->leftJoin('users as u', 'u.id', '=', 'l.approved_by');
               
            $leaveRequestDates = DB::table('leave_request_dates as ld')
            ->select('ld.date')
            ->where ('ld.leave_request_id','l.id')
            ->get();

            $leaveRequestDate = [];
            foreach ($leaveRequestDates as $leaveDate) {
                array_push($leaveRequestDate, $leaveDate->date);

            }

            $search = $request->search;

            if (!is_null($search)) {
                $leaveRequests = $leaveRequests
                    ->orWhere('l.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.request_on', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.reason', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'status' => 'l.status',
                'type' => 'l.type',
                'request_on' => 'l.request_on',
                'approved_by' => 'l.approved_by'
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $leaveRequests->where($column, '=', $value);
                }
            }

            $leaveRequests = $leaveRequests->orderBy('l.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Leave Request Data",
                "data" => $leaveRequests,$leaveRequestDates,
                "data leave request dates" => $leaveRequestDate
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage()
            ], 500);
        }

    }
    public function getOne($id)
    {
        try {
            $leaveRequest = DB::table('leave_requests as l')
                ->select('l.id', 'e.bio_code as bio_code', 'e.first_name as employee', 'a.name as type', 'l.request_on', 'l.days', 'l.reason', 'l.status', 'u.name as approved_by')
                ->leftJoin('employees as e', 'e.id', '=', 'l.employee')
                ->leftJoin('leave_types as a', 'a.id', '=', 'l.type')
                ->leftJoin('users as u', 'u.id', '=', 'l.approved_by')
                ->where('l.id', $id)
                ->first();
            
                $leaveRequestDates = DB::table('leave_request_dates as ld')
                ->select('ld.date')
                ->where ('ld.leave_request_id',$id)
                ->get();
    
                $leaveRequestDate = [];
                foreach ($leaveRequestDates as $leaveDate) {
                    array_push($leaveRequestDate, $leaveDate->date);
    
                }

            return response()->json([
                "Message" => "Leave Request Data",
                "Data" => $leaveRequest,
                "Data leave request dates" => $leaveRequestDate
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops somthing went wrong please try again",
                "Error" => $e->getMessage()
            ], 500);
        }

    }
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'request_on' => 'required',
                'dates' => 'required',
                'days' => 'required',
                'reason' => 'required',
                'status' => 'required',
                'approved_by' => 'required'
            ]);

            $leaveRequest = new LeaveRequest();
            $leaveRequest->employee = $request->employee;
            $leaveRequest->type = $request->type;
            $leaveRequest->request_on = $request->request_on;
            $leaveRequest->days = $request->days;
            $leaveRequest->reason = $request->reason;
            $leaveRequest->status = $request->status;
            $leaveRequest->approved_by = $request->approved_by;
            $leaveRequest->created_at = new \DateTime();
            $leaveRequest->save();

            $dates = $request->dates;
            foreach($dates as $date){
                $LRD=new LeaveRequestDate();
                $LRD->leave_request_id = $leaveRequest->id;
                $LRD->date = $date;
                $LRD->save();
            }

            DB::commit();

            return response()->json([
                "Message" => "Leave Request Data Saved",
                "Data" => $leaveRequest
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops somthing went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'request_on' => 'required',
                'dates' => 'required',
                'days' => 'required',
                'reason' => 'required',
                'status' => 'required',
                'approved_by' => 'required'
            ]);

            $leaveRequest = LeaveRequest::find($id);
            $leaveRequest->employee = $request->employee;
            $leaveRequest->type = $request->type;
            $leaveRequest->request_on = $request->request_on;
            $leaveRequest->days = $request->days;
            $leaveRequest->reason = $request->reason;
            $leaveRequest->status = $request->status;
            $leaveRequest->approved_by = $request->approved_by;
            $leaveRequest->created_at = new \DateTime();
            $leaveRequest->save();

            $dates = $request->dates;
            foreach($dates as $date){
                $LRD=new LeaveRequestDate();
                $LRD->leave_request_id = $leaveRequest->id;
                $LRD->date = $date;
                $LRD->save();
            }

            DB::commit();

            return response()->json([
                "Message" => "Leave Request Data Updated",
                "Data" => $leaveRequest
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage()
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $leaveRequest = LeaveRequest::find($id);
            $leaveRequest->delete();

            return response()->json([
                "Message" => "Leave Request Data Deleted"
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Ooops Something went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}