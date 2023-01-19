<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('project_id')){

            $group = Group::where('project_id', $request->query('project_id'))->with(['tasks', 'project'])->get();
            return Response([
                'message' => "success",
                'status' => true,
                'data' => $group,
            ]);

        }else{

            return Response([
                    'message' => "Group not found",
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
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:50'],
            'accomplished' => ['bail', 'required', 'boolean'],
            'description' => ['bail', 'required', 'string', 'max:1000'],
            'image_url' => ['bail', 'required', 'string'],
            'project_id' => ['bail', 'required', "integer"]
        ]);

        $project = Project::find($details['project_id']);
        if(!empty($project)){

            $group = new Group();
            $group->name = $details['name'];
            $group->accomplished = $details['accomplished'];
            $group->description = $details['description'];
            $group->image_url = $details['image_url'];
            $group->group_tag = Str::random(strlen($details['name']));
            $group->project_id = $details['project_id'];
            $group->save();

            return Response([
                'message' => "success",
                'status' => true,
                'data' => $group,
            ]);
        }else{

            return Response([
                'message' => "Project not be found!",
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
        $result = Group::find($id);

        return Response([
            'message' => "success",
            'status' => true,
            'data' => collect($result)->sortKeys(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);

        $details = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:20'],
            'accomplished' => ['bail', 'required', 'boolean'],
            'description' => ['bail', 'required', 'string', 'max:50'],
            'image_url' => ['bail', 'required', 'string'],
            'project_id' => ['bail', 'required', "integer"]
        ]);

        $group->name = $details['name'];
        $group->accomplished = $details['accomplished'];
        $group->description = $details['description'];
        $group->image_url = $details['image_url'];
        $group->group_tag = $details['group_tag'];
        $group->project_id = Str::random(strlen($details['name']));
        $group->save();

        return Response([
            'message' => "success",
            'status' => true,
            'data' => $group,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Group::find($id)->delete();

        return Response([
            'message' => "success",
            'status' => true,
            'data' => $result,
        ]);
    }
}
