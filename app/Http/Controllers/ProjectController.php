<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    public function index(Request $request)
    {

        if (! Gate::allows('project_access')) {
            abort(403);
        }
        return view('projects.index');
    }

    public function getProject()
    {
        if (! Gate::allows('project_access')) {
            abort(403);
        }

        $projects = Project::orderBy('id', 'DESC')->get();
        $data = $projects->map(function ($project) {
            return [
                'id'     => $project->id,
                'name'   => $project->name,
                'created_by' => $project->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $project->id,
                    'viewRoute'   => 'project_view',
                    'editRoute'   => 'project_edit',
                    'deleteRoute' => 'project_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createProject(Request $request)
    {
        if (! Gate::allows('project_create')) {
            abort(403);
        }

        $request->validate([
            'project_name' => 'required|string|max:255',
        ]);

        if ($request->id) {

            $project = Project::findOrFail($request->id);
            $project->update([
                'name'        => $request->project_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Project updated successfully.'
            ]);
        } else {

            Project::create([
                'name'        => $request->project_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Project created successfully.'
            ]);
        }
    }

    public function viewProject(Request $request)
    {
        if (! Gate::allows('project_view')) {
            abort(403);
        }

        $project = Project::find($request->id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $project->id,
                'name' => $project->name,
            ]
        ]);
    }

    public function editProject(Request $request)
    {

        if (! Gate::allows('project_edit')) {
            abort(403);
        }

        $id = $request->id;

        $viewproject = Project::where('id', $id)->first();

        if ($viewproject) {
            return response()->json([
                'status' => true,
                'data' => $viewproject
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Project not found'
            ], 400);
        }
    }

    public function deleteProject(Request $request)
    {
        if (! Gate::allows('project_delete')) {
            abort(403);
        }
        try {
            $project = Project::find($request->id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => "Project not found!"
                ], 404);
            }

            $project->delete();
            return response()->json([
                'success' => true,
                'message' => "Project permanently deleted successfully"
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => "Something went wrong while deleting permission",
                'error' => $e->getMessage()
            ], 500);
        }
    }




}
