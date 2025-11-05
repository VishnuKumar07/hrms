<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;


class PermissionController extends Controller
{
    public function index()
    {

        if (! Gate::allows('permission_access')) {
            abort(403);
        }
        return view('permissions.index');
    }

    public function getPermission()
    {
        if (! Gate::allows('permission_access')) {
            abort(403);
        }
        $permissions = Permission::orderBy('id', 'DESC')->get();
        $data = $permissions->map(function ($permission) {
            return [
                'id'     => $permission->id,
                'name'   => $permission->name,
               'action' => view('components.action-buttons', [
                    'id'          => $permission->id,
                    'viewRoute'   => 'permission_view',
                    'editRoute'   => 'permission_edit',
                    'deleteRoute' => 'permission_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createPermission(Request $request)
    {
        if (! Gate::allows('permission_create')) {
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            'permissionName' => 'required|string|max:255|unique:permissions,name,' . $request->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $permissionId = $request->id;
        $permissionName = $request->permissionName;

        if (!empty($permissionId)) {

            $permission = Permission::find($permissionId);
            if (!$permission) {
                return response()->json([
                    'status' => false,
                    'message' => "Permission not found!",
                ], 404);
            }

            $permission->update([
                'name' => $permissionName
            ]);

            return response()->json([
                'status' => true,
                'message' => "Permission Updated Successfully"
            ], 200);

        } else {

            $insert = Permission::create([
                'name' => $permissionName
            ]);

            return response()->json([
                'status' => true,
                'message' => "Permission Added Successfully"
            ], 200);
        }
    }

    public function viewPermission(Request $request)
    {
        if (! Gate::allows('permission_view')) {
            abort(403);
        }
        $id = $request->id;

        $viewpermission = Permission::where('id', $id)->first();

        if ($viewpermission) {
            return response()->json([
                'status' => true,
                'data' => $viewpermission
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found'
            ], 400);
        }
    }

    public function editPermission(Request $request)
    {
        if (! Gate::allows('permission_edit')) {
            abort(403);
        }
        $id = $request->id;

        $viewpermission = Permission::where('id', $id)->first();

        if ($viewpermission) {
            return response()->json([
                'status' => true,
                'data' => $viewpermission
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Permission not found'
            ], 400);
        }
    }

    public function deletePermission(Request $request)
    {
        if (! Gate::allows('permission_delete')) {
            abort(403);
        }
        try {
            $permission = Permission::find($request->id);

            if (!$permission) {
                return response()->json([
                    'success' => false,
                    'message' => "Permission not found!"
                ], 404);
            }

            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => "Permission permanently deleted successfully"
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
