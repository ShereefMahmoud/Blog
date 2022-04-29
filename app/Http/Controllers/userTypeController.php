<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('user_type')->get();
        return view('userType.index',['data'=>$data , 'title'=>"Show User Type"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('userType.create',["title"=>"Create User Type"]);
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
            'type'=>'required|string|min:3',
        ]);
        $op_create = DB::table('user_type')->insert($data);
        if ($op_create) {
            # code...
            $message = "Raw Inserted";
        }else{
            $message = "Error To Inserted";
        }
        session()->flash('Message',$message);
        return redirect(url('/userType'));
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
        $data = DB::table('user_type')->find($id);
        return view('userType.edit',['data'=>$data , 'title'=>'Edit User Type']);
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
        $data = $this->validate($request,[
            'type'=>'required|string|min:3',
        ]);
        $op_update = DB::table('user_type')->where('id',$id) ->update($data);
        if ($op_update) {
            # code...
            $message = "Raw Updated";
        }else{
            $message = "Error To Update";
        }
        session()->flash('Message',$message);
        return redirect(url('/userType'));
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
        $op_delete = DB::table('user_type')->where('id',$id)->delete();
        if ($op_delete) {
            # code...
            $message = "Raw Deleted";
        }else{
            $message = "Error to Deleted";
        }
        session()->flash('Message',$message);
        return redirect(url('userType'));
    }
}
