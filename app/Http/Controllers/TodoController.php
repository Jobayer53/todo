<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use Redirect,Response;
use DataTables;
use Validator;
use Image;

class TodoController extends Controller
{

    function index(Request $request){
        $data = Todo::latest('id')->get();

        return view('todos.index',compact('data'));

    }

    function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'required'

        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=> $validator->errors()->toArray()]);
        }
        else{
            $insertid = Todo::insertGetId([
            'title'=> $request->title,
            'description' => $request->description,


        ]);
        $data = Todo::where('id', $insertid)->first();
        $uploaded_file = $request->image;
        $extention = $uploaded_file->getClientOriginalExtension();
        $file_name = $data->id.'.'.$extention;
        $uploaded_file->move(public_path('uploads/image/'), $file_name);

        Todo::where('id',$data->id)->update([
            'image'=> $file_name
        ]);


        $id = $data->count('id');
        $title = $data->title;
        $description = $data->description;

        return response()->json([
            'id' => $id,
            'title'=> $title,
            'description'=> $description,
        ]);
        }




        // $insertid = Todo::insertGetId([
        //     'title'=> $request->title,
        //     'description' => $request->description,

        // ]);
        // $extention = $request->image->getClientOriginalExtension();
        // $file_name = $insertid.'.'.$extention;
        // Image::make($request->image)->save(public_path('uploads/image/'.$file_name));

        // Todo::where('id',$insertid)->update([
        //     'image'=> $file_name,
        // ]);

        // $data = Todo::where('id', $insertid)->first();
        // $id = $data->count('id');
        // $title = $data->title;
        // $description = $data->description;

        // return response()->json([
        //     'id' => $id,
        //     'title'=> $title,
        //     'description'=> $description,
        // ]);







        // $validate = Validator::make($request->all(), [
        //     'title'=> 'required',
        //     'description'=> 'required',

        // ]);

        // if(!$validate-> passes()){
        //     return response()->json(['status' =>0, 'errors' => $validate ->errors()->toArray()]);
        // }
        // else{



        // }


    }

    function edit($id){
        $data = Todo::find($id);
        return response()->json($data);
    }

    function update(Request $request, $id){

        $data = Todo::where('id', $id)->first();
        $imagePath = null;

        // Check if an image file is provided
        if ($request->hasFile('editimage')) {
            // Handle image upload and update $imagePath with the new path
          //  $imagePath = $request->file('editimage')->store('your_image_directory', 'public');
          $delete_from = public_path('uploads/image/'.$data->image);
            unlink($delete_from);
            $uploaded_file = $request->editimage;
        $extention = $uploaded_file->getClientOriginalExtension();
        $file_name = $data->id.'.'.$extention;
        $uploaded_file->move(public_path('uploads/image/'), $file_name);
        Todo::find($id)->update([

        "image"=> $file_name,

        ]);
        }

        Todo::find($id)->update([
            "title" => $request->input('edittitle'),
        "description" => $request->input('editdescription'),


        ]);


        $editId = $data -> id;
        $title = $data->title;
        $description = $data->description;

        return response()->json([
            'id' => $editId,
            'title'=> $title,
            'description'=> $description,
        ]);
    }

    function destroy($id){
        $data = Todo::where('id', $id)->first();
        $delete_from = public_path('uploads/image/'.$data->image);
        unlink($delete_from);
        Todo::find( $id )->delete();

        $data = Todo::all();

        return view("todos.tablerow",compact("data"))->render();
    }





}

