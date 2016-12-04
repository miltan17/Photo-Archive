<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Collection;
use Auth;
use App\Photo;
use App\User;
use File;
use Validator;
use App\Like;



class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application data with pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $userid = Auth::user()->id;
        $photos = Photo::orderBy('created_at','desc')->where('user_id',$userid)->paginate(8);

        return view('profile', compact('photos'));
    }

    /**
     * Upload a new photo to the authenticated user
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    	$photo = new Photo();
    	$photo->user_id = Auth::user()->id;
    	$photo->title = Input::get('title');

    	if(Input::hasFile('image'))
    	{
    		$file = Input::file('image');
    		

    		$validator = Validator::make(
    			array('image' => $file),
    			array('image' => 'required|mimes:jpg,jpeg,png,bmp,gif'),
    			//array('title'=> Input::get('title')),
    			array('title'=>'required')
    			);
    		if($validator->passes()){
    			$file->move(public_path(). '/img/', $file->getClientOriginalName());
    			$photo->imageName = $file->getClientOriginalName();
    			$photo->save();
    			return redirect()->back()->with('PositiveMessage', 'Photo Upload Succeed ... ');
    		}
    		else{
    			return redirect()->back()->with('NegativeMessage', 'Title or Photo Not found ... ');
    		}
    	}
    	else
    	{
    		return redirect()->back()->with('NegativeMessage', 'Photo Not Found ... ');
    	}
    }



    /**
     * Show a single image in here
     *
     * @return \Illuminate\Http\Response
     */
    public function ViewPhoto($id)
    {
    	$photo = Photo::find($id);

    	return View('photo.details', compact('photo'));
    }


    /**
     * See photos of any single user
     *
     * @return \Illuminate\Http\Response
     */
    public function allPhoto($id)
    {
        $photos = Photo::orderBy('created_at','desc')->where('user_id',$id)->paginate(8);
    	//$photos = User::find($id)->photos;

    	return view('photo.SingleUsers_Photo', compact('photos'));
    }

    /**
     * like or unlike a post
     *
     * @return \Illuminate\Http\Response
     */
    public function likePhoto(Request $request)
    {

    	$photoId = $request['photoId'];
    	$user = Auth::user();
    	$like = $user->likes()->where('photo_id', $photoId)->first();

        //$likes = Like::get()->where('photo_id', $photoId);

    	if($like){
    		$like->delete();
    	}
    	else{
    		$like = new Like();
    		$like->user_id = $user-> id;
    		$like->photo_id = $photoId;
    		$like->save();
    	}
        // Calculate the numbeer of likes in a single photo
        $photos = Photo::find($photoId);
        $count = $photos->likes->count();
    	return response()->json($count);
    }
}
