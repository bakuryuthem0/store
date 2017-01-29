<?php

class CommentController extends BaseController {
	public function newComment()
	{
		$data  = Input::all();
		$rules = array(
			'comment' => 'required|min:4|max:400'
		);
		$msg  = array();
		$attr = array(
			'comment'	=> Lang::get('lang.comment')
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' 	=> 'danger',
				'msg'	=> $validator->getMessageBag() 
			));	
		}
		$comment = new Comment;
		$comment->item_id = $data['item_id'];
		$comment->user_id = Auth::id();
		$comment->comment = $data['comment'];
		$comment->save();
		return Response::json(array(
			'type' 		=> 'success',
			'comment'	=> $data['comment'],
			'avatar'	=> asset('images/avatars/'.Auth::user()->avatar),
			'username'	=> Auth::user()->name.' '.Auth::user()->lastname,
			'created_at'=> {{ date('F-d',strtotime($comment->created_at)) }},
			'msg'		=> Lang::get('lang.comment_success')
		));
	}
}