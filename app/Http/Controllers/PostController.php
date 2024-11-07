<?php

namespace App\Http\Controllers;

use App;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\can;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index()
    {$user =Auth::user();
        $posts=Post::where('user_id' ,$user->id)->get();
            return response()->json([$posts]);
        
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

    
    public function store(can $request)
    {
        $user=Auth::user();
        $validatedData=$request->validated();
        $post=Post::create([
            'title' =>$validatedData['title'],
            'post' =>$validatedData['post'],
            'user_id' =>$user->id,
        ]);
        return response()->json([$post]);
    
    }

    /**
     * Display the specified resource.
     */

    public function show( string $id)
    {
        $user=Auth::user();
        $post=post::where('user_id',$user->id)->find($id);
        if(! $user){
            return response()->json(['msg'.'error']);
        }
        return response()->json([$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update( Request $request, string $id)
    {
        $user =Auth::user();
        $updatePost=Post::where('user_id',$user->id)->find($id);
        if(!$updatePost){
        return response()->json(['msg'.'error']);
        }
$user->update($request->all());
        return response()->json([$updatePost]);
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Request $request)
    {
        $user=Auth::user();
        $post=Post::where('user_id'.$user->id);
        if(!$user){
            return response()->json(['msg'.'error']);
        }
        $post->delete();
            return response()->json(['msg'.'successfully deleted']);
    }
}
