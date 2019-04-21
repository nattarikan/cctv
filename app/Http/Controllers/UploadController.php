


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//เรียกใช้ library Input แล้วสร้าง alias ว่า Input
use Illuminate\Support\Facades\Input as Input;


class UploadController extends Controller {

	public function upload(){

		if(Input::hasFile('file')){

        echo 'Uploaded <br>';
            
        $file = Input::file('file');
        //เอาไฟล์ที่อัพโหลด ไปเก็บไว้ที่ public/uploads/ชื่อไฟล์เดิม
			  $file->move('uploads', $file->getClientOriginalName());
			  echo "<img src='uploads/{$file->getClientOriginalName()}'>";
		}

	}
}