<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Camera;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class ShowallController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $ch = new CheckstatusController();
        $ch->checkstatusAdmin();


        $objs = Camera::orderBy('camera_id','desc')->paginate(10);
        $data['objs'] = $objs;
        return view('showall',$data);
      

    }


    public function create()
    {
        $data['method'] = "post";
        $data['url']    = url('admin/showall');
        return view('CreateCamera',$data);

    }

  
    public function store(Request $request)
    {

        $obj = new Camera();
        $obj->camera_name = $request['name'];
        $obj->camera_server = $request['server']; 
        $obj->camera_ip = $request['ip']; 
        $obj->camera_brand = $request['brand']; 

        $obj->save();
        return redirect(url('admin/showall'));

    }

   
    public function show($camera_id)
    {
        $obj = Camera::find($camera_id);




    }

  
    public function edit($camera_id)
    {

        $obj = Camera::find($camera_id);
        $data['url']    = url('admin/camera/'.$camera_id);
        $data['method'] = "put";
        $data['obj'] = $obj;
        return view('admin/CreateCamera',$data);


      
    }

  
    public function update(Request $request, $camera_id)
    {
       



    }

 
    public function destroy($camera_id)
    {
    
       $obj = Camera::find($camera_id);
       $obj->delete();
       return redirect(url('admin/showall'));
    


    }



    public function GetDeclare($camera_id)
    {
        $data = Camera::find($camera_id);
        return view('declare')->with('data',$data);
    }




    public function PostDeclare(Request $request , $camera_id )
    {

        $obj = Camera::find($camera_id);
        $obj->history_des = $request->history_des;

        $obj->save();

        return redirect(url('admin/showall'));
    }


   public function GetReady($camera_id)
    {
        $obj = Camera::find($camera_id);
        $obj->history_des = "Ready" ;
        $obj->save();

        return redirect(url('admin/showall'));

    }


   public function del(Request $request)
   {
        $delid = $request->delete;

        print_r($delid);

        dd($delid);

        //return redirect('/')->with('success', 'ลบข้อมูลกล้องตัวที่แล้ว');

   }

  

}
