<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Camera;
use App\History;
use App\User;
use App\work_report;
use App\work_repair;
use App\Work;
use App\Work_detail;
use DB;
use Auth;
use App\file;


class CameraController extends Controller
{
    private $line_api = "https://notify-api.line.me/api/notify";
    private $token = 'yJB4a6qe86VwqWCM7tcECy8qopVp3hf4RHQ7cX9ijya';

    public function __construct()
    {
        $this->middleware('auth');
    }

//history Admin
    public function index()
    {
        $ch = new CheckstatusController();
        $ch->checkstatusAdmin();


        $objs = Camera::paginate(100);
      
        

        $jo =    History::orderBy('history_id','desc')
            ->join('users', 'history.id', '=', 'users.id')
            ->join('camera', 'history.camera_id', '=', 'camera.camera_id')

            ->get(array('history.history_id','camera.camera_name','camera.history_des',
                        'camera.camera_server','history.history_date','users.name',
                        'camera.camera_ip','camera.camera_brand','history.history_do'));

            return view('camera',['objs' => $objs, 'jo' => $jo]);
        
    }


//ประวัติทั้งหมด User
     public function AllHistoryUser()
    {
        $ch = new CheckstatusController();
        $ch->checkstatusUser();


        $objs = Camera::paginate(100);
      
        

        $jo =    History::orderBy('history_id','desc')
            ->join('users', 'history.id', '=', 'users.id')
            ->join('camera', 'history.camera_id', '=', 'camera.camera_id')

            ->get(array('history.history_id','camera.camera_name','camera.history_des',
                        'camera.camera_server','history.history_date','users.name',
                        'camera.camera_ip','camera.camera_brand','history.history_do'));

            return view('camera_user',['objs' => $objs, 'jo' => $jo]);
        
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

    public function search(Request $request)
    {  


    }


// ลบกล้องหน้าshowall
 
    public function destroy($camera_id)
    {
    
       $obj = Camera::find($camera_id);
       $obj->delete();
       return redirect(url('admin/showall'));
    }






// คืนสถานะพร้อมใช้งาน หน้า showall
   public function GetReady($camera_id)
    {
        $obj = Camera::find($camera_id);
        $obj->history_des = "Ready";
        $obj->save();


        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = "Ready" ;
        $ob->id = "1001";
        $ob->history_do = "Admin คืนสถานะพร้อมใช้งาน";
        $ob->save();
        
        // return redirect(url('admin/showall'));
        return back();
    }


// กดปุ่ม อนุมัติการซ่อม ตารางที่ 2 ของหน้า admin
       public function GetReady_2(Request $request , $work_id , $camera_id)
    {
        

        $obj = Camera::find($camera_id);
        $obj->history_des = "Ready";
        $obj->save();


        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = "Ready" ;
        $ob->id = "1001";
        $ob->history_do = "Admin คืนสถานะพร้อมใช้งาน";
        $ob->save();


        $ba = Work::find($work_id);
        $ba->work_com_admin = "เคยส่งแล้ว";
        $ba->save();
        
        return back ();
       
    }


// ประวัติ เมื่อกด Link
    public function history(Request $request , $camera_id )
    {


     $jo =    History::orderBy('history_id','desc')
        ->join('users', 'history.id', '=', 'users.id')
        ->join('camera', 'history.camera_id', '=', 'camera.camera_id')
        ->get(array('history.history_id','camera.camera_name','camera.history_des','history.history_last',
        'camera.camera_server','history.history_date','users.name','camera.camera_id',
        'camera.camera_ip','camera.camera_brand','history.history_do'));

    
    $id = $camera_id ;
    

    return view('history_by_id',['jo' => $jo , 'id' => $id ]);
        
    }


// ประวัติหน้า user กด Link
    public function historyUser(Request $request , $camera_id )
    {


     $jo =    History::orderBy('history_id','desc')
        ->join('users', 'history.id', '=', 'users.id')
        ->join('camera', 'history.camera_id', '=', 'camera.camera_id')
        ->get(array('history.history_id','camera.camera_name','camera.history_des','history.history_last',
        'camera.camera_server','history.history_date','users.name','camera.camera_id','camera.camera_ip','camera.camera_brand','history.history_do'));
    $id = $camera_id ;
    
        return view('history_ByID_User',['jo' => $jo , 'id' => $id ]);
        
    }
  



// admin แจ้งเสียเอง
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
        $ob->history_do = "Admin แจ้งเสียเอง" ;
        $ob->save(); 



        $wo = new Work();
        $wo->id = $request['id']; 
        $wo->camera_id = $camera_id;
        $wo->history_des = $request->history_des;
        $wo->save();



        $new2 = new work_repair();
        $new2->id = $request['id']; 
        $new2->camera_id = $camera_id;
        $new2->repair_status = $request->history_des;
        $new2->save();

        return redirect(url('admin/showall'));
    }





//หน้าโชว์ 3 ตารางของ admin
   public function report()
    {
      
       // ตาราง 1
        $cctv =    Work_report::orderBy('work_report_id','desc')
            ->join('users', 'work_report.id', '=', 'users.id')
            ->join('camera', 'work_report.camera_id', '=', 'camera.camera_id')
           
            ->get(array('work_report.work_report_id',
                'camera.camera_name',
                'camera.history_des',
                'camera.camera_server',
                'work_report.work_report_date',
                'users.name',
                'camera.camera_id',
                'camera.camera_ip',
                'camera.camera_brand'));


            // ตาราง 2
        $jo =    Work::orderBy('work_id','desc')
            ->join('users', 'work.id', '=', 'users.id')
            ->join('camera', 'work.camera_id', '=', 'camera.camera_id')
        
           
            ->get(array(
                'camera.camera_name',
                'camera.history_des',
                'camera.camera_server',
                'users.name',
                'camera.camera_id',
                'camera.camera_ip',
                'work.work_id',
                'camera.camera_brand',
                'work.work_com',
                'work.work_com_admin',
                'work.work_id',
                'work.work_date',
                'camera.camera_id',
                'work.work_des'

                
            ));

            

           return view('report',[ 'jo'=>$jo ,  'cctv' => $cctv ]);
        
         
    }



// cctv > แจ้ง > admin เลือกช่าง (ตาราง 2 ของ admin)  

    public function GetSelect(Request $request , $camera_id )
    {
        $data = Camera::find($camera_id);
        return view('select')->with('data',$data);
    }





    public function PostSelect(Request $request , $camera_id )
    {
      
        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = $request->history_des;
        $ob->id = $request['id']; 
        $ob->history_do = "Admin เลือกช่าง" ;
        $ob->save();


        $del = DB::table('work_report')
             ->where('camera_id', $camera_id);
        $del->delete(); 


        $wo = new Work();
        $wo->id = $request['id']; 
        $wo->camera_id = $camera_id;
        $wo->history_des = $request->history_des;
        $wo->save();



        // งานที่กำลังทำ


        $new2 = new work_repair();
        $new2->id = $request['id']; 
        $new2->repair_status = $request->history_des;
        $new2->camera_id = $camera_id;
        $new2->save();


        

        $this->check_Appointment($new2->camera_name);

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

// Admin ดู ความเคลื่อนไหว

    public function work_report2(Request $request , $work_id )
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



        return view('work_report2',['data' => $data,'jo' => $jo]);
    }







// ใส่รายละเอียดงานของช่าง แต่ละครั้ง

    public function get_work_report(Request $request , $work_id )
    {
        $ob = new Work_detail();
        $ob->work_id = $work_id; 
        $ob->work_des = $request->work_des;
        $ob->work_pic = $request->work_pic;
        

        


        $ob->save();
        return back();

    }


// ช่างกดส่งงานให้ admin

    public function work_1(Request $request , $work_id )
    {
        $data = Work::find($work_id);
        $data->work_com = "ช่างซ่อมเสร็จ" ;
        $data->save();


        $jo =    Camera::orderBy('camera_id','desc')
            ->join('work_repair', 'camera.camera_id', '=', 'work_repair.camera_id')
            ->join('work', 'camera.camera_id', '=', 'work.camera_id')

            ->get(array('camera.camera_id',   
                        'work_repair.work_repair_id'             
            ));



         return redirect(url('user/work_user'));
    }



//Line Notification
    private function send_notify_message($message_data)
    {
        $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$this->token );

        $ch =   curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->line_api);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
         
        // Check Error
        if(curl_error($ch)) {
            $return_array = array( 'status' => '000: send fail', 'message' => curl_error($ch) );
         } 

         else {
            $return_array = json_decode($result, true);
         }
         
         curl_close($ch);
         return $return_array;
    }

    private function check_Appointment($name) {
        $str = "ชีพแล้ว งานเข้า!!" ;
        //$str = 'ทดสอบข้อความ';    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
        $image_thumbnail_url = '';  // ขนาดสูงสุด 240×240px JPEG
        $image_fullsize_url = '';  // ขนาดสูงสุด 1024×1024px JPEG
        $sticker_package_id = 1;  // Package ID ของสติกเกอร์
        $sticker_id = 410;    // ID ของสติกเกอร์
        $message_data = array(
            'message' => $str,
            'imageThumbnail' => $image_thumbnail_url,
            'imageFullsize' => $image_fullsize_url,
            // 'stickerPackageId' => $sticker_package_id,
            // 'stickerId' => ''
        );
        
        $result = $this->send_notify_message($message_data);
    }





}


