<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
{

    public function getAll(Request $request)
    {
        try {
            $qualifications = DB::table('qualifications as q')
                ->select('q.id', 'q.name', 'q.description');

                $filterParameters = [
                    'name' => 'q.name', 
                ];

                foreach ($filterParameters as $parameter => $column) {
                    $value = $request->input($parameter);
                    if (isset($value) && $value !== '') {
                        $qualifications->where($column, '=', $value);
                    }
                }
                
            $search = $request->search;
            if (!is_null($search)) {
                $qualifications = $qualifications
                    ->where('q.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('q.description', 'LIKE', '%' . $search . '%');
            }
            $qualifications = $qualifications->orderBy('q.id', 'desc')->get();

            return response()->json([
                "message" => "qualification Data",
                "data" => $qualifications,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {
            $qualification = DB::table('qualifications as q')
                ->select('q.id', 'q.name', 'q.description')
                ->where('q.id', $id)
                ->first();

            return response()->json([
                "message" => "Qualification Data",
                "data" => $qualification,
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
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $qualification = new Qualification();
            $qualification->name = $request->name;
            $qualification->description = $request->description;
            $qualification->save();

            DB::commit();

            return response()->json([
                "msg" => "Qualification Data",
                "data" => $qualification,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function upade(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            
            $qualification = Qualification::find($id);
            $qualification->name = $request->name;
            $qualification->description = $request->description;
            $qualification->save();

            DB::commit();

            return response()->json([
                "msg" => "Qualification Data",
                "data" => $qualification,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }


    public function delete($id)
    {
        try{
            $qualification = Qualification::find($id);
             $qualification->delete();
            return response()->json([
                "message" => "qualification record deleted successfully",
            ], 200);
        }
        catch(\Throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

}