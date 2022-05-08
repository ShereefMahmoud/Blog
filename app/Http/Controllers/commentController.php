<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Schema\Expect;

class commentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['checkUser','checkAdmin'],['except'=>['create','store']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('comment')->join('user','user.id','=','user_id')->select('comment.*','user.name as publisher_name')->get();
        return view('Comment.index',['data'=>$data , "title"=>"Show All Feedbacks"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('user')->where('user_type_id',2)->get();
        return view("Comment.create",['title'=>" Send Feedback",'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->validate($request,[
            "user_name"  => "required|min:5|max:30",
            "content"    => "required|min:20|max:20000",
            "user_id" => "required|integer",
        ]);
        $data['date']=time();

        $op_create =DB::table('comment')->insert($data);
        if ($op_create) {
            # code...
            "<script>window.alert(' Done Send Feedback '); </script>";
            return redirect(url('/'));

        }else{
            "<script>window.alert(' Error Try Again '); </script>";
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = DB::table('comment')->find($id);
        $user = DB::table('user')->where('id',$data->user_id)->get();
        return view('Comment.show',['data'=>$data , 'user'=>$user , "title"=>"Show Details of Feedbacks"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $op_delete = DB::table('comment')->where('id',$id)->delete();
        if ($op_delete) {
            # code...
            $message = "Raw Deleted";
        }else{
            $message = "Fail To Delete";
        }

        session()->flash('Message',$message);
        return redirect(url("/comment"));
    }
}
