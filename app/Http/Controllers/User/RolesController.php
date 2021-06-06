<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;


class RolesController extends Controller
{

    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $rolesObjects = Role::paginate(25);

        return view('user.roles.index', compact('rolesObjects'));
    }

    /**
     * Show the form for creating a new roles.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $permissions = Permission::orderBy('name', 'asc')->get();
        $roles = Role::pluck('name', 'id')->all();
        $selectedPermission = DB::table('permission_role')->pluck('permission_id')->toArray();
        return view('user.roles.create', compact('permissions', 'roles', 'selectedPermission'));
    }

    /**
     * Store a new roles in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        foreach ($request->permission  as $value) {
            $role->attachPermission($value);
        }

        return redirect('/roles')->with('toast_success', 'Role Created Successfully');
    }

    /**
     * Display the specified roles.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $roles = Role::findOrFail($id);
        $selectedPermission = DB::table('permission_role')->where('permission_role.role_id', $id)->pluck('permission_id')->toArray();

        $permissions = Permission::orderBy('name', 'asc')->get();

        return view('user.roles.show', compact('roles', 'selectedPermission', 'permissions'));
    }

    /**
     * Show the form for editing the specified roles.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $roles = Role::findOrFail($id);

        $selectedPermission = DB::table('permission_role')->where('permission_role.role_id', $id)->pluck('permission_id')->toArray();
        return view('user.roles.edit', compact('permissions', 'roles', 'selectedPermission'));
    }

    /**
     * Update the specified roles in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        DB::table('permission_role')->where('role_id', $id)->delete();

        foreach ($request->permission as $value) {
            $role->attachPermission($value);
        }

        return redirect()->route('roles.roles.index')
            ->with('success_message', 'Roles was successfully updated.');
    }

    /**
     * Remove the specified roles from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $roles = Role::findOrFail($id);
            $roles->delete();

            return redirect()->route('roles.roles.index')
                ->with('success_message', 'Roles was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'name' => 'string|min:1|max:255|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'display_name' => 'string|min:1|nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
