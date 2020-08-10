<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Http\Controllers\BaseController as BaseController;
class PostController extends BaseController
{
    protected function validateThis(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'title' => 'required|max:255',
            'desc' => 'required|max:255',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $posts = Auth::user()->posts;
        return $this->sendResponse($posts, 200);

        //$data = new PostCollection(Post::where('user_id', $id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateThis($request);
        if($validator->fails()){
            return $this->sendError($validator->errors(), 422);
        }

        $post = Post::create($request->all());
        if ($post) {
            return $this->sendResponse($post, 'Post has been Added!', 200);
        } else {
            return $this->sendError('Something went wrong, try again', 200);
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->sendResponse($post, 200);
        } else {
            return $this->sendError('This Post is Not Found', 200);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = $this->validateThis($request, $post->id);

        if($validator->fails()){            
            return $this->sendError($validator->errors(), 422);
        }

        if ($post) {
            $post->update($request->all());
            return $this->sendResponse($post, 'Post has been Updated', 200);
        } else {
            return $this->sendError('This Post is Not Found', 200);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        return response()->json('successfully deleted');  
    }
}
