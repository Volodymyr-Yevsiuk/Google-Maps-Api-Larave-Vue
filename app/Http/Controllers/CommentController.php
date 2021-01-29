<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentController extends SiteController
{

    public function store(Request $request) {

        $data = $request->except(['_token', 'comment_post_ID', 'comment_user_ID']);

        $data['marker_id'] = $request->input('comment_post_ID');
        $data['user_id'] = $request->input('comment_user_ID');

        $validator = Validator::make($data, [

            'marker_id' => 'integer|required',
            'text' => 'string|required',
            'name' => 'string|required',
            'email' => 'email|required'

        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $comment = new Comment();

        $comment->fill($data);

        if($comment->save()) {
            return back();
        }   

    }
}
