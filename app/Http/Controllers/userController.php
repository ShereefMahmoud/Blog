<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('user')->join('user_type', 'user_type.id', '=', 'user_type_id')->select('user.*', 'user_type.type as userType')->get();
        return view('User.index', ['data' => $data, "title" => "Display Users"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('user_type')->get();
        return view('User.create', ["data" => $data, "title" => "Create User"]);
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
        $data = $this->validate($request, [
            "name"        => 'required',
            "email"       => "required|email|unique:user",
            "password"    => "required|min:6",
            "address"     => "required|min:10",
            "gender"      => "required",
            "image"       => "required|image|mimes:png,jpg",
            "user_type_id" => "required|int",
        ]);

        $finalName = uniqid() . "." . $request->image->extension();

        if ($request->image->move(public_path('/userImage'), $finalName)) {
            $data['image'] = $finalName;
        }

        $data['password'] = bcrypt($data['image']);

        // echo strlen($data['password']);
        // exit;

        $op_create = DB::table('user')->insert($data);
        if ($op_create) {
            $message = "Raw Inserted";
        } else {
            $message = "Error in Insert";
        }
        session()->flash("Message", $message);
        return redirect(url("/user"));
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
        $data = DB::table('user')->find($id);
        $userType = DB::table('user_type')->get();
        return view('User.edit', ['data' => $data, "userType" => $userType, "title" => "Edit User"]);
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
        $data = $this->validate($request, [
            "name"        => 'required',
            "email"       => "required|email|unique:user,email," . $id,
            "address"     => "required|min:10",
            "gender"      => "required",
            "image"       => "nullable|image|mimes:png,jpg",
            "user_type_id" => "required|int",
        ]);

        $rawData = DB::table('user')->find($id);

        if ($request->has('image')) {
            $finalName = uniqid() . "." . $request->image->extension();

            if ($request->image->move(public_path('/userImage'), $finalName)) {

                $data['image'] = $finalName;
                unlink(public_path('userImage/' . $rawData->image));
            }
        } else {
            $data['image'] = $rawData->image;
        }

        $op_update = DB::table('user')->where('id', $id)->update($data);
        if ($op_update) {
            $message = "Raw Updated";
        } else {
            $message = "Error in Update";
        }
        session()->flash("Message", $message);
        return redirect(url("/user"));
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
        $rawData = DB::table('user')->find($id);
        $op_delete = DB::table('user')->where('id', $id)->delete();
        if ($op_delete) {
            unlink(public_path('userImage/' . $rawData->image));
            $message = "Raw Deleted";
        } else {
            $message = "Error In Delete";
        }
        session()->flash('Message', $message);
        return redirect(url('/user'));
    }

    public function login()
    {
        return view('index', ["title" => "Login Page"]);
    }

    public function Dologin(Request $request)
    {

        $data = $this->validate($request, [
            "email"   => "required|email",
            "password" => "required|min:6"
        ]);

        // $data['password']=bcrypt($data['password']);
        // return User::where('password',$request->password)->get();

        if (auth()->attempt($request->only('email','password'))) {
            return redirect(url('/'));
        } else {
            // dd($data);
            // exit;
            session()->flash('Message', "Error Try Again");
            return back();
        }
    }
}
