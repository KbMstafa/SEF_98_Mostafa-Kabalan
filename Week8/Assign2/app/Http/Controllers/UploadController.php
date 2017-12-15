<?php

namespace Instagram\Http\Controllers;

use Instagram\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function index() {
    	return view('upload');
    }

    public function store(request $request) {
    	if ($this->storeDatabase($request) 
    		&& $this->storeStorage($request)) {
    		return view('home');
    	}
    }

    public function storeStorage(request $request) {
    	if ($request->hasFile('image')) {
    		$fileName = $request->image->getClientOriginalName();
    		$request->image->storeAs('public', $fileName);
    		return true;
    	}
    	return false;
    }

    public function storeDatabase(request $request) {

    	if ($request->hasFile('image')) {
    		$fileName = $request->image->getClientOriginalName();
    		/*$request->image->storeAs('public/upload', $fileName);*/

    		$post = new Post();
    		$post->caption = "batata";
    		$post->image_path = $fileName;
    		$post->user_id = 1;
    		if ($post->save()) {
    			return true;
    		}
    		return false;
    	}
    }
}
