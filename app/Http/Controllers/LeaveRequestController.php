<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveRequestController extends Controller
{

    public function show(LeaveRequest $leaveRequest)
    {
        //
    }
    public function index(Request $request)
    {
         try {
        $leave_requests = DB::table('leave_requests as l')
            ->select('l.id', 'e.bio_code as bio_code', 'e.first_name as employee','a.name as leave_type', 'l.request_on', 'l.dates', 'l.days', 'l.reason', 'l.status', 'u.name as approved_by')
            ->leftJoin('employees as e', 'e.id', '=', 'l.employee')
            ->leftJoin('leave_types as a', 'a.id', '=', 'l.type')
            ->leftJoin('users as u', 'u.id', '=', 'l.approved_by');

        $search = $request->search;

        if (!is_null($search)) {
            $leave_requests = $leave_requests
                ->orWhere('l.employee', 'LIKE', '%' . $search . '%')
                ->orWhere('l.type', 'LIKE', '%' . $search . '%')
                ->orWhere('l.request_on', 'LIKE', '%' . $search . '%')
                ->orWhere('l.reason', 'LIKE', '%' . $search . '%');
        }

        $leave_requests = $leave_requests->orderBy('id', 'asc') // created at - orderby, desc
            ->get();

        return response()->json([
            "message" => "leave_requests Data",
            "data" => $leave_requests,
        ], 200);
         } catch (\Throwable $e) {
             return response()->json([
                 "message" => "Oops somthing went wrong please try again",
                 "error" => $e->getMessage(),
             ], 500);
         }

    }

    public function edit($id)
    {
         try {
            $leave_requests = DB::table('leave_requests as l')
            ->select('l.id', 'e.bio_code as bio_code', 'e.first_name as employee','a.name as type', 'l.request_on', 'l.dates', 'l.days', 'l.reason', 'l.status', 'u.name as approved_by')
            ->leftJoin('employees as e', 'e.id', '=', 'l.employee')
            ->leftJoin('leave_types as a', 'a.id', '=', 'l.type')
            ->leftJoin('users as u', 'u.id', '=', 'l.approved_by')
            ->where('l.id', $id)
            ->first();

        return response()->json([
            "message" => "leave_requests Data",
            "data" => $leave_requests,
        ], 200);
         } catch (\Throwable $e) {
             return response()->json([
                 "message" => "Oops somthing went wrong please try again",
                 "error" => $e->getMessage(),
             ], 500);
         }

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
               // 'bio_code' => 'required',
                'employee' => 'required',
                'type' => 'required',
                'request_on' => 'required',
                'dates' => 'required',
                'days' => 'required',
                'reason' => 'required',
                'status' => 'required',
                'approved_by' => 'required'
            ]);

            $leave_request = new LeaveRequest();
           // $leave_request->bio_code = $request->bio_code;
            $leave_request->employee = $request->employee;
            $leave_request->type = $request->type;
            $leave_request->request_on = $request->request_on;
            $leave_request->dates = $request->dates;
            $leave_request->days = $request->days;
            $leave_request->reason = $request->reason;
            $leave_request->status = $request->status;
            $leave_request->approved_by = $request->approved_by;
            $leave_request->created_at = new \DateTime();
            $leave_request->save();

            DB::commit();

            return response()->json([
                "message" => "Leave_request Data",
                "data" => $leave_request,
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'type' => 'required',
                'request_on' => 'required',
                'dates' => 'required',
                'days' => 'required',
                'reason' => 'required',
                'status' => 'required',
                'approved_by' => 'required'
            ]);

            $leave_request = LeaveRequest::find($id);
            $leave_request->employee = $request->employee;
            $leave_request->type = $request->type;
            $leave_request->request_on = $request->request_on;
            $leave_request->dates = $request->dates;
            $leave_request->days = $request->days;
            $leave_request->reason = $request->reason;
            $leave_request->status = $request->status;
            $leave_request->approved_by = $request->approved_by;
            $leave_request->created_at = new \DateTime();
            $leave_request->save();
            DB::commit();

            return response()->json([
                "msg" => "leave_request Data",
                "data" => $leave_request,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $leave_request = LeaveRequest::find($id);
            $leave_request->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

}
