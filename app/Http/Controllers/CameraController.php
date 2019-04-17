<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Camera;
use App\History;
use App\User;
use App\Work;
use App\Work_detail;
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


// ลบกล้องหน้าshowall
 
    public function destroy($camera_id)
    {
    
       $obj = Camera::find($camera_id);
       $obj->delete();
       return redirect(url('admin/showall'));
    


    }


// cctv แจ้งเสีย
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
        $ob->id_post = "2";
        $ob->id_posted = "1"; 
        $ob->save();

        $wo = new Work();
        $wo->id = $request['id']; 
        $wo->camera_id = $camera_id;
        $wo->history_des = $request->history_des;
        $wo->save();

        return redirect(url('admin/showall'));
    }

// คืนสถานะพร้อมใช้งาน
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

// ประวัติ
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


// ประวัติหน้า user
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
      
       
        $cctv =    History::orderBy('history_id','desc')
            ->join('users', 'history.id', '=', 'users.id')
            ->join('camera', 'history.camera_id', '=', 'camera.camera_id')
           
            ->get(array('history.history_id',
                'camera.camera_name',
                'camera.history_des',
                'history.id_post',
                'camera.camera_server',
                'history.history_date',
                'users.name',
                'camera.camera_id',
                'camera.camera_ip',
                'camera.camera_brand',
                'history.id_posted'));






        $jo =    History::orderBy('history_id','desc')
            ->join('users', 'history.id', '=', 'users.id')
            ->join('camera', 'history.camera_id', '=', 'camera.camera_id')
            

            ->get(array('history.history_id',
                'camera.camera_name',
                'camera.history_des',
                'history.id_post',
                'camera.camera_server',
                'history.history_date',
                'users.name',
                'camera.camera_id',
                'camera.camera_ip',
                'camera.camera_brand',
                
                'history.id_posted'));

            return view('report',[ 'jo' => $jo , 'cctv' => $cctv]);
        
         
    }




        public function GetSelect(Request $request , $camera_id )
            {

        $data = Camera::find($camera_id);
        return view('select')->with('data',$data);

            }




// cctv > แจ้ง > admin เลือกช่าง
    public function PostSelect(Request $request , $camera_id )
    {
      
        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = $request->history_des;
        $ob->id = $request['id']; 
        $ob->id_post = "2";
        $ob->id_posted = "1"; 
        $ob->save();

        $wo = new Work();
        $wo->id = $request['id']; 
        $wo->camera_id = $camera_id;
        $wo->history_des = $request->history_des;
        $wo->save();


        $ss = DB::table('history')
            ->where('camera_id', $camera_id)
            ->update(['id_posted' => 1]);

        return redirect(url('admin/report'));


        

      
    }

// หน้า work_user
    public function work_user()
    {

        $objs = Camera::paginate(100);

        $jo =    Work::orderBy('work_id','desc')
            ->join('users', 'work.id', '=', 'users.id')
            ->join('camera', 'work.camera_id', '=', 'camera.camera_id')

            ->get(array('camera.camera_name','camera.history_des','users.id','work.work_date',
                        'camera.camera_server','users.name','camera.camera_id','work.work_pic',
                        'work.work_des','work.work_id',
                        'camera.camera_ip','camera.camera_brand','work.work_com'));



        
            return view('work_user',['objs' => $objs, 'jo' => $jo]);
        
         
    }


// ดูความเคลื่อนไหว

    public function work_report(Request $request , $work_id )
    {


        $data = Work::find($work_id);


         $jo =    Work_detail::orderBy('work_detail_id','desc')
            ->join('work', 'work_detail.work_id', '=', 'work.work_id')
            ->join('camera', 'work.camera_id', '=', 'camera.camera_id')

            ->get(array(
                    'work.work_id',
                    'work.work_date',
                    'work.camera_id',
                    'camera.camera_name',
                    'camera.camera_id',
                    'work.work_des',
                    'work.history_des',
                    'work.id',
                    'work.work_com',
                    'work_detail.work_detail_id',
                    'work_detail.work_id',
                    'work_detail.work_pic',
                    'work_detail.work_des',
                   
                   ));



        return view('work_report',['data' => $data, 'jo' => $jo]);
    }








// ใส่รายละเอียดงานของช่าง แต่ละครั้ง

    public function get_work_report(Request $request , $work_id )
    {
        $ob = new Work_detail();
        $ob->work_id = $work_id; 
        $ob->work_des = $request->work_des;
        $ob->work_pic = $request->work_pic;
        $ob->save();



        $o = new History();
        $o->camera_id = $request->camera_id;
        $o->history_last = "มีการเคื่อนไหว";
        $o->id = auth()->id();
        $o->id_post = "1";
        $o->id_posted = "2"; 
        $o->work_id = $work_id;
        $o->save();





///////////////////////////////////////////////////////////
        return back();

    }


// ส่งงาน admin

    public function work_1(Request $request , $work_id )
    {
        $data = Work::find($work_id);
        $data->work_com = "ช่างซ่อมเสร็จ" ;
        $data->save();


        


        return redirect(url('user/work_user'));
    }


}


