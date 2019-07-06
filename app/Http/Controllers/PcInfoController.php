<?php

namespace App\Http\Controllers;
use App\PcInfo;
use App\BlackList;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Session;

class PcInfoController extends Controller
{

    public function getComputer(){
        
       //$pcinfo   =  PCinfo::distinct()->get(["PCname","PCIP","OSName","Username","LatUpdate"]);
       $pcinfo   =  PcInfo::distinct()->get(["PCname"]);
       return view('computer')->with('pcinfo', $pcinfo);
    }


    public function getComputerDownload(){
        $pcinfo   =  PcInfo::distinct()->get(["PCname"]);
        $file= public_path(). "/download/Computer.txt";
        $headers = array(
            'Content-Type' => 'plain/txt',
            ); 
        $fs = fopen($file, 'w') or die("can't open file"); //Mở tập tin ở chế độ overite
        $str= "PCname\tPCIP\tOSname\tUsername\tLastUpdate\n";
        foreach($pcinfo as $pc)
        {
            $computer = PcInfo::where('PCname',$pc->PCname)->first();
            $string = date('m/d/Y h:m:s', $computer->LatUpdate+strtotime("2000-1-1"));
            $str .=$computer->PCname."\t". $computer->PCIP."\t".$computer->OSName."\t".$computer->Username."\t".$string."\n";
        }
        fwrite($fs, $str);
        fclose($fs);
        return response()->download($file, "Computer.txt", $headers);
    }

   public function getOS($pc_name){
       $pcinfo   =   PcInfo::where('PCname',$pc_name)->first();
       return view('OS',['pcinfo'=>$pcinfo]);
    }

   public function getSoftwareList($pc_id){
       $pcid=pcinfo::find($pc_id);
       $pcinfo   =   PcInfo::where('PCname',$pcid->PCname)->distinct()->get(["Softwarename"]);
       return view('SoftwareList',['pcinfo'=>$pcinfo ,'pcid'=>$pcid ]);
    }

    public function getSoftwareListDownload($pc_id){
        $pc=pcinfo::find($pc_id);
        $pcinfo   =   PcInfo::where('PCname',$pc->PCname)->distinct()->get(["Softwarename"]);
        $file= public_path(). "/download/SoftwareList.txt";
        $headers = array(
            'Content-Type' => 'plain/txt',
            ); 
        $fs = fopen($file, 'w') or die("can't open file"); //Mở tập tin ở chế độ overite
        $str="Softwarename\tPublisher\tInstalled\tSize\tVersion\n";
        foreach($pcinfo as $pc)
        {
            $computer =PcInfo::where('Softwarename',$pc->Softwarename)->first();
            $string = date('m/d/Y ', $computer->Installed+strtotime("2000-1-1"));
            $str .=$computer->Softwarename."\t". $computer->Publisher."\t".$string."\t".$computer->Size."\t".$computer->Version."\n";
        }
        fwrite($fs, $str);
        fclose($fs);
        return response()->download($file, "SoftwareList.txt", $headers);
    }

   public function getAllSoftware(){
    //  $query=( new PcInfo)->scopeBlacklist();  //truy xuất đến PcInfoController function scopeBlacklist
        $query = (new PcInfo)->blacklist();             //Ngoài ra ta còn có thể gọi qua function blacklist() table
        return view('AllSoftware', ['pcinfo' => $query]);
    }

   public function getAllSoftwareDownload(){
        $pcinfo   =  PcInfo::distinct()->get(["Softwarename"]);
        $file= public_path(). "/download/Allprogram.txt";
        $headers = array(
            'Content-Type' => 'plain/txt',
            ); 
        $fs = fopen($file, 'w') or die("can't open file"); //Mở tập tin ở chế độ overite
        $str="Softwarename\tPublisher\tLatUpdate\tPCname\n";
        foreach($pcinfo as $pc)
        {
            $software = PcInfo::where('Softwarename',$pc->Softwarename)->first();
            $string = date('d/m/Y', $software->LatUpdate+strtotime("2000-1-1"));
            $str .=str_replace('?', '-',utf8_decode($software->Softwarename))."\t"
            . $software->Publisher."\t".$string."\t".$software->PCname."\n";
        }
        fwrite($fs, $str);
        fclose($fs);
        return response()->download($file, "Allprogram.txt", $headers);
    }
    
    public function getApply(Request $request)
    {
        $this->validate($request,[
            'checkbox'=>'required',
          ],
          [
            'checkbox.required'=>'Bạn không được để trống checkbox khi Apply',
          ]);
        foreach($request->checkbox as $check)
        {
            $indexid1=strlen($check);       //Đếm tổng số kí tự trong chuỗi
            $indexsf=strpos($check, '/'); //lấy vị trị đầu tiên xuất hiện của tham số thứ 2 : kí tự "/"
            $strid =substr( $check,   $indexsf+1, $indexid1);     //lấy id  
            $strsf=substr( $check,  0, $indexsf);           //lấy name  software
            //  echo $check .  "<br>";
            $blacklist = new BlackList;
            $blacklist->Softwarename =$strsf;
            $blacklist->UserID = $strid;
            $blacklist->LatUpdate =strtotime(date('Y-m-d H:i:s'));
            $blacklist->save();
        }
        Session::flash('success', 'Apply success');
        return redirect('AllSoftware')->with('thongbao','Apply success');
    }

   public function getSoftware($id){
       $pcid=PcInfo::find($id);
       $pcinfo   =   PcInfo::where("Softwarename",$pcid->Softwarename)->distinct()->get(["PCname"]);
       return view('software',['pcinfo'=>$pcinfo, 'pcid'=>$pcid]);
    }

    public function getSoftwareDownload($id){
        $pc=PcInfo::find($id);
        $pcinfo   =   PcInfo::where("Softwarename",$pc->Softwarename)->distinct()->get(["PCname"]);
        $file= public_path(). "/download/Software.txt";
        $headers = array(
            'Content-Type' => 'plain/txt',
            ); 
        $fs = fopen($file, 'w') or die("can't open file"); //Mở tập tin ở chế độ overite
        $str="PCname\tPCIP\tUsername\tInstalled\n";
        foreach($pcinfo as $pc)
        {
            $computer = PcInfo::where('PCname',$pc->PCname)->first();
            $string = date('m/d/Y ', $computer->Installed+strtotime("2000-1-1"));
            $str .=$computer->PCname."\t". $computer->PCIP."\t".$computer->Username."\t".$string."\n";
        }
        fwrite($fs, $str);
        fclose($fs);
        return response()->download($file, "Software.txt", $headers);
    }
}
