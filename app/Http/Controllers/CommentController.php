<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\commentRequest;
use App\Http\Requests\commentUpdate;
class CommentController extends Controller
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
    public function store(commentRequest $request)
    {
        $user =Auth::user();
        $validatedData= $request->validated();
        $create=Comment::create([
            'comment'=>$validatedData['comment'],
            'user_id'=>$user->id,
            
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=Auth::user();
        $show=Comment::where('user_id',$user->id)->find($id);
        if(! $show){
            return response()->json(['msg','error']);
        }
        return response()->json([$show]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( commentUpdate $request, Comment $id)
    {
        $user= Auth::user();
        $update= Comment::where('user_id',$user->id)->find($id);
        if(! $update){
            return response()->json(['msg','error']);
        }
        $update->update($request->all());
        return response()->json([$update]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $user= Auth::user();
    $delete= Comment::where('user_id',$user->id)->find($id);
    if(! $delete){
        return response()->json(['msg','error']);
    }
    $delete->delete();
    return response()->json(['msg','deleted successfully']);
    }
}
