<?php

namespace App\Http\Controllers;
use App\BlackList;
use App\PcInfo;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() 
    {
        $pcinfo   =  PcInfo::all();
        return view('a')->with('pcinfo', $pcinfo);
    }

    public function a(Request $request)
    {
        foreach($request->checkbox as $check)
        {
            $indexid1=strlen($check);       //Đếm tổng số kí tự trong chuỗi
            $indexsf=strpos($check, '/'); //lấy vị trị đầu tiên xuất hiện của tham số thứ 2 : kí tự "/"
            $strid =substr( $check,   $indexsf+1, $indexid1);     //lấy id  
            $strsf=substr( $check,  0, $indexsf);           //lấy name  software
            //  echo $check .  "<br>";
            $pcinfo = PcInfo::where("Softwarename",$strsf)->get();
            foreach($pcinfo as $pc)
            {
                $blacklist = new BlackList;
                $blacklist->Softwarename = $pc->Softwarename;
                $blacklist->UserID = $strid;
                $blacklist->LatUpdate = $pc->LatUpdate;
                $blacklist->save();
            }
        }
        echo  "success";
        //dd(request()->checkbox);
    }
}
