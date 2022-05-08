<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class articleController extends Controller
{
    //

    public function index()
    {
        //
        $data = DB::table('article')->join('user','user.id','=','user_id')->join('artical_category','artical_category.id','=','article_category_id')->select('article.*','user.name as userName','artical_category.category as articleCategory')->get();

        return response()->json(['data'=>$data , 'Message'=>"data Fetched"],200);
    }


    public function store(Request $request)
    {
        # code...

        $data = $request->all();

        $validator = Validator::make($data, [
            "title"              => "required|min:10",
            "content"            => "required|min:20",
            "image"              => "required|image|mimes:png,jpg",
            "article_category_id" => "required|int",
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json(['errors' => $validator->errors()], 400);
        } else {

            $finalName = uniqid() . "." . $request->image->extension();

            if ($request->image->move(public_path('/articleImage'), $finalName)) {
                $data['image'] = $finalName;
            }

            $data['date'] = time();
            $data['user_id'] = 9;

            $op_create = DB::table('article')->insert($data);
            if ($op_create) {
                $message = "Raw Inserted";
                $code = 201;
            } else {
                $message = "Error in Insert";
                $code = 400;
            }

            return response()->json(['Message' => $message], $code);
        }
    }


    public function destroy($id)
    {
        //
        $rawData = DB::table('article')->find($id);
        $op_delete = DB::table('article')->where('id',$id)->delete();
        if($op_delete){
            unlink(public_path('articleImage/'.$rawData->image));
            $message = "Raw Deleted";
            $code = 200 ;
        }else{
            $message = "Error In Delete";
            $code = 400 ;
        }
        return response()->json(['Message' => $message], $code);
    }
}
