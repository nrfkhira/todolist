<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\Todolists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class taskController extends Controller
{
    //request and get list_id
    public function task(Request $request)
    {
        $user=$request->user();
        $task = task::where('list_id', request()->list_id)->get();
        $list = Todolists::where('id', request()->list_id)->get(); //-->search database for list where id = list_id from request

        //if statement for prohibiting access other task that doesn't belong to the user
        if ($list[0]->user_id != $user->id){
            abort(403);
        }
        else
            return view('task', compact('task','list'));

        //return view('task', compact('task'));
    }

    //save task data by list_id
    public function store(Request $request, $id)
    {

        $list_id = explode('/', $request->url());

        $data = $request->validate([
            'content' => 'required'
        ]);

        $savedata = [
            'content' => $request->content,
            'list_id' => (int)$list_id[4]
        ];

        task::create($savedata);

        return back();
    }

    //view task
    public function index()
    {
        $todolists = task::all();
        return view('dashboard', compact('task'));
    }

    public function destroy(Request $request)
    {
        $list_id = explode('/', $request->url());
        $taskdel = task::findOrFail((int)$list_id[4]);
        $taskdel->delete();
        return back();
    }

 //view edit
 public function taskedit(Request $request)
 {
     $list_id = explode('/', $request->url());
     $task = task::where('id', (int)$list_id[4])->get();
     return view('edittask', compact('task'));
 }

 //edit task
 public function edit(Request $request)
 {
     $data = $request->validate([
         'content' => 'required'
     ]);
     $list_id = explode('/', $request->url());
     $taskedit = task::findOrFail((int)$list_id[4]);
     $taskedit->content = $data['content'];

     $taskedit->save();
     return redirect('dashboard');
 }

    public function logout()
    {
        return redirect('welcome');
    }


}
