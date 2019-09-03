<?php

namespace App\Http\Controllers;
use App\Tike;
use Illuminate\Http\Request;

class Photo extends Controller
{
    public function index()
    {
     return view('photo.zc');
    }
    public function add(Request $request)
    {
        $this->validate($request, [
        'nick' => 'required|unique:tike',
        'pwd' => 'required',
        'tel' => 'required',

    ]);

    $model=new Tike();
    $model->nick=$request['nick'];
    $model->pwd=md5($request['pwd']);
    $model->tel=$request['tel'];
    $model->name='sina'.rand(100000,999999);
	    if($model->save())
	    {
         return $this->login();
	    } else {
	    	return "注册失败";
	    }

    }
    public function login()
    {
    	return view('photo.dl');
    }
    public function logindo(Request $request)
    {
    	$this->validate($request, [
        'nick' => 'required',
        'pwd' => 'required',
    ]);
    	 $data=new Tike();      
    	 $res=$data->where('nick',$request['nick'])->where('pwd',$request['pwd'])->first();
    	if($res)
    	{
    		return view('photo.zs',['data'=>$res]);
    	} else {
    		return "登陆失败";
    	}

    }
}
