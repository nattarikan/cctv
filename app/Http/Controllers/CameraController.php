<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Camera;
use App\History;
use App\User;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class CameraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $ch = new CheckstatusController();
        $ch->checkstatusAdmin();


        $objs = Camera::paginate(100);
      
        

        $jo =    History::orderBy('history_id','desc')
            ->join('users', 'history.id', '=', 'users.id')
            ->join('camera', 'history.camera_id', '=', 'camera.camera_id')

            ->get(array('history.history_id','camera.camera_name','camera.history_des','history.id_post',
                        'camera.camera_server','history.history_date','users.name',
                        'camera.camera_ip','camera.camera_brand'));

            return view('camera',['objs' => $objs, 'jo' => $jo]);
        
    }


    public function create()
    {
        $data['method'] = "post";
        $data['url']    = url('admin/showall/');
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

        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = $request->history_des;
        $ob->id = $request['id']; 
        $ob->save();

        return redirect(url('admin/showall'));
    }


   public function GetReady($camera_id)
    {
        $obj = Camera::find($camera_id);
        $obj->history_des = "Ready";
        $obj->save();


        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = "Ready" ;
        $ob->id = "1001";
        $ob->id_post = "2";
        $ob->save();
        
        return redirect(url('admin/showall'));

    }


    public function history(Request $request , $camera_id )
    {


     $jo =    History::orderBy('history_id','desc')
        ->join('users', 'history.id', '=', 'users.id')
        ->join('camera', 'history.camera_id', '=', 'camera.camera_id')
        ->get(array('history.history_id','camera.camera_name','camera.history_des','history.history_last',
        'camera.camera_server','history.history_date','users.name','camera.camera_id','history.id_post',
        'camera.camera_ip','camera.camera_brand'));

    
    $id = $camera_id ;
    
    
        return view('history_by_id',['jo' => $jo , 'id' => $id ]);
        
    }
  
    public function historyUser(Request $request , $camera_id )
    {


     $jo =    History::orderBy('history_id','desc')
        ->join('users', 'history.id', '=', 'users.id')
        ->join('camera', 'history.camera_id', '=', 'camera.camera_id')
        ->get(array('history.history_id','camera.camera_name','camera.history_des','history.history_last',
        'camera.camera_server','history.history_date','users.name','camera.camera_id','history.id_post',
        'camera.camera_ip','camera.camera_brand'));

    
    $id = $camera_id ;
    
    
        return view('history_ByID_User',['jo' => $jo , 'id' => $id ]);
        
    }
  


   public function report()
    {
      
        $objs = Camera::paginate(100);

        $jo =    History::orderBy('history_id','desc')
            ->join('users', 'history.id', '=', 'users.id')
            ->join('camera', 'history.camera_id', '=', 'camera.camera_id')

            ->get(array('history.history_id','camera.camera_name','camera.history_des','history.id_post',
                        'camera.camera_server','history.history_date','users.name',
                        'camera.camera_ip','camera.camera_brand'));

            return view('report',['objs' => $objs, 'jo' => $jo]);
        
         
    }




        public function GetSelect(Request $request , $camera_id )
            {

        $data = History::find($camera_id);
        return view('select')->with('data',$data);

            }





    public function PostSelect(Request $request , $history_id )
    {

        echo "$history_id";

        

      
    }





}


