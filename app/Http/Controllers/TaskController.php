<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at','desc')->get();
        return view ('show')->with('tasks',$tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            'title' => 'required',
              'content'=> 'required',
              'image'=> 'mimes:jpeg,png,jpg,bmp|nullable|max:5999'
           ]);
           if($request->hasFile('image')){
               $fileWithExt=$request->file('image')->getClientOriginalName();
               //Get just filename
               $file=pathinfo($fileWithExt, PATHINFO_FILENAME);
               //Get just ext
               $extension=$request->file('image')->getClientOriginalExtension();
               //Filename to Store
               $fileName=$file.'.'.$extension;
               //Upload Image
            //    $path=$request->file('image')->storeAs('public/images',$fileName);
              $path=$request->file('image')->move(public_path('images'), $fileName);
           }else{
               $fileName="noimage.jpg";
           }
        $task = new Task;
        $task->title=$request->input('title');
        $task->content=$request->input('content');
        $task->image=$fileName;
        $task->save();
        return redirect('task')->with('success','Tasks Created Successfully');
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
        $tasks = Task::where('id',$id)->first();
        return view('edit',compact('tasks'));
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
        $this -> validate($request,[
            'title' => 'required',
              'content'=> 'required',
              'image'=> 'mimes:jpeg,png,jpg,bmp|nullable|max:5999'
           ]);
           if($request->hasFile('image')){
               $fileWithExt=$request->file('image')->getClientOriginalName();
               //Get just filename
               $file=pathinfo($fileWithExt, PATHINFO_FILENAME);
               //Get just ext
               $extension=$request->file('image')->getClientOriginalExtension();
               //Filename to Store
               $fileName=$file.'_'.time().'.'.$extension;
               //Upload Image
               $path=$request->file('image')->move(public_path('images'), $fileName);
           }else{
               $fileName="noimage.jpg";
           }
        $task = Task::find($id);
        $task->title=$request->input('title');
        $task->content=$request->input('content');
        if($request->hasFile('image')){
             $task->image=$fileName;
        }
        $task->save();
        return redirect('task')->with('success','Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // echo $id;die;
        $file = Task::find($id);
        $file->delete();

        // $data =Task::where('id',$id)->delete();

        // echo $file->image; die;
        if($file){
            $path = public_path('images/'.$file->image);
            unlink($path);
        }


return redirect('task')->with('success','Task deleted successfully');

    }
}
