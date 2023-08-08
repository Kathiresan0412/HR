<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDocument;
use Illuminate\Http\Request;
use DB;

class EmployeeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $documents = DB::table('employee_documents as d')
                ->select('d.id', 'emp.first_name as employee','d.ol_level_al_level_resheets', 'd.goverment_bank_book', 'd.work_experince', 'd.gs_charactet_certificate', 'd.nic')
                ->leftJoin('employees as emp', 'd.employee', '=', 'emp.id');
    
            $search = $request->search;
    
            if (!is_null($search)) {
                $documents = $documents
                    ->where('d.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('d.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('d.goverment_bank_book', 'LIKE', '%' . $search . '%')
                    ->orWhere('d.work_experince', 'LIKE', '%' . $search . '%')
                    ->orWhere('d.nic', 'LIKE', '%' . $search . '%');
            }
            $documents = $documents->orderBy('d.id')->get();
    
            return response()->json([
                "message" => "----AllEmployee documents Data-----",
                "data" => $documents,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
    
            $documents = new EmployeeDocument();
            $documents->employee = $request->employee;
            $documents->ol_level_al_level_resheets = $request->ol_level_al_level_resheets;
            $documents->goverment_bank_book = $request->goverment_bank_book;
            $documents->work_experince = $request->work_experince;
            $documents->gs_charactet_certificate = $request->gs_charactet_certificate;
            $documents->nic = $request->nic;
            $documents->save();
    
            DB::commit();
    
            return response()->json([
                "msg" => "Saved Employee Documents Data",
                "data" => $documents,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeDocument $employeeDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $documents = DB::table('employee_documents as d')
            ->select('d.id', 'emp.first_name as employee','d.ol_level_al_level_resheets', 'd.goverment_bank_book', 'd.work_experince', 'd.gs_charactet_certificate', 'd.nic')
            ->leftJoin('employees as emp', 'd.employee', '=', 'emp.id')
                ->where('d.id', $id)
                ->first();
    
            return response()->json([
                "message" => "Selected employee documents Data",
                "data" => $documents,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
    try {

        $documents = EmployeeDocument::find($id);
        $documents->employee = $request->employee;
        $documents->ol_level_al_level_resheets = $request->ol_level_al_level_resheets;
        $documents->goverment_bank_book = $request->goverment_bank_book;
        $documents->work_experince = $request->work_experince;
        $documents->gs_charactet_certificate = $request->gs_charactet_certificate;
        $documents->nic = $request->nic;
        $documents->save();

        DB::commit();

        return response()->json([
            "msg" => "Updated Employee Documents Data",
            "data" => $documents,
        ], 201);
    } catch (\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg" => "oops something went wrong",
            "error" => $e->getMessage(),
        ], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $documents = EmployeeDocument::find($id);
            $documents->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}

