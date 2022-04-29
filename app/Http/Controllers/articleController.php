<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class articleController extends Controller
{


    public function __construct()
    {
        $this->middleware(['checkUser','checkPublisher']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if (auth()->user()->user_type_id == 1) {
            # code...
            $data = DB::table('article')->join('user','user.id','=','user_id')->join('artical_category','artical_category.id','=','article_category_id')->select('article.*','user.name as userName','artical_category.category as articleCategory')->get();

        }elseif(auth()->user()->user_type_id == 2){
        $data = DB::table('article')->join('user','user.id','=','user_id')->join('artical_category','artical_category.id','=','article_category_id')->select('article.*','user.name as userName','artical_category.category as articleCategory')->where('user_id',auth()->user()->id)->get();
        }
        return view('Article.index',['data'=>$data , "title"=>"Display Article"]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('user')->get();
        $data_cat=DB::table('artical_category')->get();
        return view('Article.create',["data"=>$data ,"data_category"=>$data_cat , "title"=>"Create Article"]);
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
        $data=$this->validate($request,[
            "title"              => 'required|min:10',
            "content"            => "required|min:100",
            "image"              => "required|image|mimes:png,jpg",
            "article_category_id"=>"required|int",
        ]);

        $finalName = uniqid() . "." . $request->image->extension();

        if($request->image->move(public_path('/articleImage'),$finalName)){
            $data['image'] = $finalName;
        }

        $data['date'] = time();
        $data['user_id']= auth()->user()->id;

        $op_create = DB::table('article')->insert($data);
        if($op_create){
            $message = "Raw Inserted";
        }else{
            $message = "Error in Insert";
        }
        session()->flash("Message",$message);
        return redirect(url("/article"));

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
        $data = DB::table('article')->find($id);
        $data_cat = DB::table('artical_category')->get();
        return view('Article.edit',["data"=>$data,"data_cat"=>$data_cat , "title"=>"Edit User"]);
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
        $data=$this->validate($request,[
            "title"              => 'required|min:10',
            "content"            => "required|min:100",
            "image"              => "nullable|image|mimes:png,jpg",
            "article_category_id"=>"required|int",
        ]);

        $rawData = DB::table('article')->find($id);

        if($request->has('image')){
               $finalName = uniqid() . "." . $request->image->extension();

               if($request->image->move(public_path('/articleImage'),$finalName)){

               $data['image'] = $finalName;
               unlink(public_path('articleImage/'.$rawData->image));
            }

        }else{
            $data['image'] = $rawData->image;
        }

        $data['date'] = time();
        $data['user_id']= auth()->user()->id;


        $op_update = DB::table('article')->where('id',$id)->update($data);
        if($op_update){
            $message = "Raw Updated";
        }else{
            $message = "Error in Update";
        }
        session()->flash("Message",$message);
        return redirect(url("/article"));
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
        $rawData = DB::table('article')->find($id);
        $op_delete = DB::table('article')->where('id',$id)->delete();
        if($op_delete){
            unlink(public_path('articleImage/'.$rawData->image));
            $message = "Raw Deleted";
        }else{
            $message = "Error In Delete";
        }
        session()->flash('Message',$message);
        return redirect(url('/article'));
    }
}
