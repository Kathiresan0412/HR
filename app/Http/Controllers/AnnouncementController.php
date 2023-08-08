<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */


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

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $announcement = Announcement::find($id);
            $announcement->delete();
            return response()->json([
                "Message" => "Announcement Data Deleted",

            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Ooops Something went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getAll(Request $request,)
    {

        try {
            $announcements = DB::table('announcements as a')
                ->select('a.id', 'a.date', 'a.attachment', 'a.description', 'a.title');

            $search = $request->search;
            if (!is_null($search)) {
                $announcements = $announcements
                    ->where('a.date', 'LIKE', '%' . $search . '%')
                    ->orWhere('a.description', 'LIKE', '%' . $search . '%')
                    ->orWhere('a.title', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'date' => 'a.date',
                'title' => 'a.title',
                'description' => 'a.description',

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $announcements->where($column, '=', $value);
                }
            }

            $announcements = $announcements->orderBy('a.created_at', 'desc')->get();

            return response()->json([
                "Message" => "All Announcement Data ",
                "Data" => $announcements,
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

            $announcement = DB::table('announcements as a')
                ->select('a.id', 'a.date', 'a.attachment', 'a.description', 'a.title');


            $announcement = $announcement->orderBy('a.created_at', 'desc')
                ->where('a.id', $id)
                ->first();

            return response()->json([
                "Message" => "Announcement Data",
                "Data" => $announcement,
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
            $announcement = new Announcement();
            $announcement->date = $request->date;
            $announcement->attachment = $request->attachment;
            $announcement->description = $request->description;
            $announcement->title = $request->title;
            $announcement->save();

            DB::commit();

            return response()->json([
                "Message" => "Announcement Data Saved",
                "Data" => $announcement,
            ], 200);
        } catch (\Throwable $e) {

            DB::rollback();

            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $announcement = Announcement::find($id);
            $announcement->date = $request->date;
            $announcement->attachment = $request->attachment;
            $announcement->description = $request->description;
            $announcement->title = $request->title;
            $announcement->save();

            DB::commit();

            return response()->json([
                "Message" => "Announcement Data Updated",
                "Data" => $announcement,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}
