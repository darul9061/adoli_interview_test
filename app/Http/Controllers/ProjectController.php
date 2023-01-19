<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);
        
        $data = Project::where('user_id', Auth::user()->id)->get();

        return response(
            array_merge(
                [
                    'message' => "success",
                    'status' => true
                ],
                [
                    'data' => $data,
                ]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("create", Project::class);

        $details = $request->validate([
            'name' => ['required', 'string', 'max:20']
        ]);


        $project = new Project();
        $project->name = $details['name'];
        $project->user_id = $request->user()->id;
        $project->project_tag = Str::random(strlen($details['name']));
        $project->save();

        return response(
            array_merge(
                [
                    'message' => "success",
                    'status' => true
                ],
                [
                    'data' => $project,
                ]
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return response(
            array_merge(
                [
                    'message' => "success",
                    'status' => true
                ],
                [
                    'data' => $project->with(['tasks', 'groups', 'comments'])->get(),
                ]
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        return $project->delete();
    }
}
