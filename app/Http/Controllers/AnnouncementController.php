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
    public function destroy($id)
    {
        try {
            $announcement = Announcement::find($id);
            $announcement->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function index(Request $request, )
    {

        try {
            $announcement = DB::table('announcements as a')
                ->select('a.id', 'a.date', 'a.attachment', 'a.description', 'a.title');

            $search = $request->search;
            if (!is_null($search)) {
                $announcement = $announcement
                    ->where('a.date', 'LIKE', '%' . $search . '%')
                    ->orWhere('a.description', 'LIKE', '%' . $search . '%')
                    ->orWhere('a.title', 'LIKE', '%' . $search . '%');
            }
            $announcement = $announcement->orderBy('a.id', 'desc')->get();

            return response()->json([
                "message" => "announcement Data",
                "data" => $announcement,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        try {

            $announcement = DB::table('announcements as a')
                ->select('a.id', 'a.date', 'a.attachment', 'a.description', 'a.title')
                ->where('a.id', $id)
                ->first();

            return response()->json([
                "message" => "announcement Data",
                "data" => $announcement,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
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
                "msg" => "announcement Data",
                "data" => $announcement,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
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
                "msg" => "announcement Data",
                "data" => $announcement,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }



}