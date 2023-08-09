<?php

namespace App\Http\Controllers;

use App\Models\EmployeeBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeBenefitController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $employeeBenefits = DB::table('employee_benefits as eb')
                ->select('eb.id', 'e.first_name as attendees', 'ebt.name as benefit_type', 'eb.enrollment_date', 'eb.coverage_details', 'eb.premiums', 'eb.beneficiary_information')
                ->leftJoin('employees as e', 'e.id', '=', 'eb.attendees')
                ->leftJoin('employee_benefit_types as ebt', 'ebt.id', '=', 'eb.benefit_type');


            $search = $request->search;
            if (!is_null($search)) {
                $employeeBenefits = $employeeBenefits
                    ->where('eb.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('eb.attendees', 'LIKE', '%' . $search . '%')
                    ->orWhere('eb.benefit_type', 'LIKE', '%' . $search . '%')
                    ->orWhere('eb.coverage_details', 'LIKE', '%' . $search . '%')
                    ->orWhere('eb.premiums', 'LIKE', '%' . $search . '%')
                    ->orWhere('eb.beneficiary_information', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'enrollment_date' => 'eb.enrollment_date',
                'coverage_details' => 'eb.coverage_details',
                'attendees' => 'eb.attendees',
                'benefit_type' => 'eb.benefit_type',
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employeeBenefits->where($column, '=', $value);
                }
            }
            $employeeBenefits = $employeeBenefits->orderBy('eb.created_at', 'desc')->get();

            return response()->json([
                "message" => "Employee Benefits Data",
                "data" => $employeeBenefits,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $employeeBenefit = new EmployeeBenefit();
            $employeeBenefit->attendees = $request->attendees;
            $employeeBenefit->benefit_type = $request->benefit_type;
            $employeeBenefit->enrollment_date = $request->enrollment_date;
            $employeeBenefit->coverage_details = $request->coverage_details;
            $employeeBenefit->premiums = $request->premiums;
            $employeeBenefit->beneficiary_information = $request->beneficiary_information;
            $employeeBenefit->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee Benefit Data Saved",
                "data" => $employeeBenefit,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function getOne($id)
    {
        try {

            $employeeBenefit = DB::table('employee_benefits as eb')
                ->select('eb.id', 'e.first_name as attendees', 'ebt.name as benefit_type', 'eb.enrollment_date', 'eb.coverage_details', 'eb.premiums', 'eb.beneficiary_information')
                ->leftJoin('employees as e', 'e.id', '=', 'eb.attendees')
                ->leftJoin('employee_benefit_types as ebt', 'ebt.id', '=', 'eb.benefit_type')
                ->where('eb.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee benefit Data",
                "data" => $employeeBenefit,
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $employeeBenefit = EmployeeBenefit::find($id);
            $employeeBenefit->attendees = $request->attendees;
            $employeeBenefit->benefit_type = $request->benefit_type;
            $employeeBenefit->enrollment_date = $request->enrollment_date;
            $employeeBenefit->coverage_details = $request->coverage_details;
            $employeeBenefit->premiums = $request->premiums;
            $employeeBenefit->beneficiary_information = $request->beneficiary_information;
            $employeeBenefit->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee Benefit Data Updated",
                "data" => $employeeBenefit,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    { {
            try {
                $EEmployeeBenefit = EmployeeBenefit::find($id);
                $EEmployeeBenefit->delete();

                return response()->json([
                    "message" => "Employee Benefit Data Deleted"
                ], 200);

            } catch (\Throwable $e) {
                return response()->json([
                    "message" => "Ooops Something went wrong please try again",
                    "error" => $e->getMessage(),
                ], 500);
            }
        }
    }
}