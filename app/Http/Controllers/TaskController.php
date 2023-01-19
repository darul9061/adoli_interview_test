<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->has('group_id')){

            $task = Task::where('group_id', $request->query('group_id'))->with(['group', 'comments'])->get();
            return Response([
                'message' => "success",
                'status' => true,
                'data' => $task,
            ]);

        }else{

            return Response([
                    'message' => "Task not found",
                    'status' => false,
                ],
                404
            );

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = $request->validate([
            'group_id' => ['bail', 'required', 'integer'],
            'note' => ['bail', 'required', 'String', 'max:1000'],
            'complete' => ['bail', 'required', 'boolean'],
        ]);
        $project = Group::with('project')->find($details['group_id']);


        if(!empty($project)){
            $task = new Task();
            $task->complete = $details['complete'];
            $task->note = $details['note'];
            $task->group_id = $details['group_id'];
            $task->project_id = $project->project? $project->project->id : 0;
            $task->save();

            return Response([
                'message' => "success",
                'status' => true,
                'data' => $task,
            ]);
        
        }else{

            return Response([
                'message' => "Group not found",
                'status' => false,
                'data' => null,
            ], 404);
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
    }
}
