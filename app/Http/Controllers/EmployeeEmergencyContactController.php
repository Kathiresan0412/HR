<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEmergencyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeEmergencyContactController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $empEmergenContacts = DB::table('employee_emergency_contacts as e')
                ->select('e.id', 'em.id as employee', 'e.contact_name', 'e.relationship_to_employee', 'e.mobile_number', 'e.email')
                ->leftJoin('employees as em', 'em.id', '=', 'e.employee');

            $search = $request->search;
            if (!is_null($search)) {
                $empEmergenContacts = $empEmergenContacts
                    ->where('e.contact_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.relationship_to_employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.mobile_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.email', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'relationship_to_employee' => 'e.relationship_to_employee'
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $empEmergenContacts->where($column, '=', $value);
                }
            }

            $empEmergenContacts = $empEmergenContacts->orderBy('e.created_at', 'desc')->get();

            return response()->json([
                "Message" => "All Employee Emergency Contact Data",
                "Data" => $empEmergenContacts,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {

            $empEmergenContact = DB::table('employee_emergency_contacts as e')
                ->select('e.id', 'em.id as employee', 'e.contact_name', 'e.relationship_to_employee', 'e.mobile_number', 'e.email')
                ->leftJoin('employees as em', 'em.id', '=', 'e.employee')
                ->where('e.id', $id)
                ->first();

            return response()->json([
                "Message" => "Employee Emergency Contact Data",
                "Data" => $empEmergenContact,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'contact_name' => 'required',
                'relationship_to_employee' => 'required',
                'mobile_number' => 'required',
                'email' => 'required'
            ]);

            $empEmergenContact = new EmployeeEmergencyContact();
            $empEmergenContact->employee = $request->employee;
            $empEmergenContact->contact_name = $request->contact_name;
            $empEmergenContact->relationship_to_employee = $request->relationship_to_employee;
            $empEmergenContact->mobile_number = $request->mobile_number;
            $empEmergenContact->email = $request->email;
            $empEmergenContact->save();

            DB::commit();

            return response()->json([
                "Message" => "Employee Emergency Contact Data Saved",
                "Data" => $empEmergenContact,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request, EmployeeEmergencyContact $employeeEmergencyContact, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'contact_name' => 'required',
                'relationship_to_employee' => 'required',
                'mobile_number' => 'required',
                'email' => 'required'
            ]);

            $empEmergenContact = EmployeeEmergencyContact::find($id);
            $empEmergenContact->employee = $request->employee;
            $empEmergenContact->contact_name = $request->contact_name;
            $empEmergenContact->relationship_to_employee = $request->relationship_to_employee;
            $empEmergenContact->mobile_number = $request->mobile_number;
            $empEmergenContact->email = $request->email;
            $empEmergenContact->save();

            DB::commit();

            return response()->json([
                "Message" => "Employee Emergency Contact Data Updated",
                "Data" => $empEmergenContact,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $empEmergenContact = EmployeeEmergencyContact::find($id);
            $empEmergenContact->delete();

            return response()->json([
                "Message" => "Employee Emergency Contact Data Deleted"
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Ooops Something went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}