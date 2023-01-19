<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->has('task_id')){

            $task = Comment::where('task_id', $request->query('task_id'))->with(['task'])->get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = $request->validate([
            'task_id' => ['bail', 'required', 'integer'],
            'message' => ['bail', 'required', 'String', 'max:1000'],
            'image_url' => ['bail', 'required', 'string'],
        ]);
        $task = Task::find($details['task_id']);

        if(!empty($task)){
            $project_id = Group::with('project')->find($task->group_id)->project->id;

            $comment = new Comment();
            $comment->task_id = $details['task_id'];
            $comment->message = $details['message'];
            $comment->image_url = $details['image_url'];
            $comment->user_id = $request->user()->id;
            $comment->group_id = $task->group_id;
            $comment->project_id = $project_id;
            $comment->save();

            return Response([
                'message' => "success",
                'status' => true,
                'data' => $comment,
            ]);
        }else{

            return Response([
                'message' => "Task not be found!",
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
