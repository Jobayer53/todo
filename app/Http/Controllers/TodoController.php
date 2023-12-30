<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use Redirect,Response;
use DataTables;

class TodoController extends Controller
{

    function index(Request $request){
        $data = Todo::latest('id')->get();

        return view('todos.index',compact('data'));

    }

    function store(Request $request){

        $insertid = Todo::insertGetId([
            'title'=> $request->title,
            'description' => $request->description,
        ]);

        $data = Todo::where('id', $insertid)->first();
        $id = $data->count('id');
        $title = $data->title;
        $description = $data->description;

        return response()->json([
            'id' => $id,
            'title'=> $title,
            'description'=> $description,
        ]);

    }

    function edit($id){
        $data = Todo::find($id);
        return response()->json($data);
    }

    function update(Request $request, $id){

        Todo::find($id)->update([
            "title"=> $request->edittitle,
            "description"=> $request->editdescription,
        ]);
        $data = Todo::where('id', $id)->first();

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
        Todo::find( $id )->delete();

        $data = Todo::all();

        return view("todos.tablerow",compact("data"))->render();
    }





}

