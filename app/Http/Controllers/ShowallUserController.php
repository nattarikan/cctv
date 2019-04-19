<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Camera;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
use App\History;
use App\work_report;
use App\work_repair;
use App\Work_detail;

class ShowallUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $ch = new CheckstatusController();
        $ch->checkstatusUser();


        $objs = Camera::orderBy('camera_id','desc')->paginate(10);
        $data['objs'] = $objs;
        return view('showall_user',$data);
      

    }

    public function GetDeclare($camera_id)
    {
        $data = Camera::find($camera_id);
        return view('declare_user')->with('data',$data);
    }

     public function PostDeclare(Request $request , $camera_id )
    {

        $obj = Camera::find($camera_id);
        $obj->history_des = $request->history_des;
        $obj->save();




        $ob = new History();
        $ob->camera_id = $camera_id;
        $ob->history_last = $request->history_des;
        $ob->id = Auth::user()->id ; 
        $ob->history_do = "CCTV แจ้งเสีย";
        $ob->save();


        // กรุณาเลือกช่างหน้างาน (เพิ่มใน ตาราง 1 ของ admin)

        $new = new work_report();
        $new->report_status = $request->history_des;
        $new->camera_id = $camera_id;
        $new->id = Auth::user()->id ; 
        $new->save(); 




        return redirect(url('user/showall_user'));
    }

}
