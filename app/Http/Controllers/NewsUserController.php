<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;
use App\file;

use App\User;
use App\Http\Controllers\CheckstatusController;

use Illuminate\Support\Facades\Input;

class NewsUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $con = new CheckstatusController();
        $con->checkstatusUser();
        $objs = News::orderBy('news_id','desc')->paginate(10);
        $data['objs'] = $objs;
        return view('allNews_user',$data);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['method'] = "post";
        $data['url']    = url('user/home/');
        return view('createNews',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $userid = Auth::user()->id;


        // object = $request->get(object)
        // user_id = $userid
        // saver
        $obj = new News();
        $obj->news_title = $request['title'];
        $obj->news_des = $request['content']; 

        if (Input::hasFile('image'))
        {
            $file=Input::file('image');
            $file->move(public_path(). '/', $file->getClientOriginalName());
            
            $obj->news_pic = $file->getClientOriginalName();
        }
         
        $obj->save();
        return redirect(url('user/home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($news_id)
    {
        $obj = News::find($news_id);
        //load view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($news_id)
    {

        $obj = News::find($news_id);
        $data['url']    = url('user/home/'.$news_id);
        $data['method'] = "put";
        $data['obj'] = $obj;
        return view('allNews_user',$data);
        //load view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $news_id)
    {
        $obj = News::find($news_id);
        $obj->news_title = $request['title'];
        $obj->news_des = $request['content']; 

        if (Input::hasFile('image'))
        {
            $file=Input::file('image');
            $file->move(public_path(). '/', $file->getClientOriginalName());
            
            $obj->news_pic = $file->getClientOriginalName();
        }
         
        $obj->save();
        return redirect(url('user/home'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($news_id)
    {
        $obj = News::find($news_id);
        $obj->delete();
        return redirect(url('user/home'));

    }

    public function countItem(){
        $sp = Camera::count();
        return $sp;
    }


}


// User

