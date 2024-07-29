<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
      $this->del_answer($id);
        return redirect()->back();
    }
    public function destroyans($id)
    {
      $this->del_answer($id);
      return response()->json("ok"); 
    }
    public function del_answer($id)
    {
        $item = Answer::find($id);
        if (!($item === null)) {
            $oldimagename = $item->file;
            $strgCtrlr = new StorageController();
            $path = $strgCtrlr->path['answers'];
            Storage::delete("public/" . $path . '/' . $oldimagename);
            Answer::find($id)->delete();
        }
        return 1;
    }
    
    
}
