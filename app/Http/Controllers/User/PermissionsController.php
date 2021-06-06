<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use DB;


class PermissionsController extends Controller
{

    /**
     * Display a listing of the permissions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $permissionsObjects = Permission::paginate(25);

        return view('user.permissions.index', compact('permissionsObjects'));
    }

    /**
     * Show the form for creating a new permissions.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('user.permissions.create');
    }

    /**
     * Store a new permissions in the storage.
     *
     * @param App\Http\Requests\PermissionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $name = $request->input('name');
        $description = $request->input('description');
        $display_name = $request->input('display_name');

        $send = array('name' => $name, 'description' => $description, 'display_name' => $display_name);
        DB::table('permissions')->insert($send);
        return redirect()->route('permissions.permissions.index')
            ->with('success_message', 'Permissions was successfully added.');
    }

    /**
     * Display the specified permissions.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $permissions = Permission::findOrFail($id);

        return view('user.permissions.show', compact('permissions'));
    }

    /**
     * Show the form for editing the specified permissions.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $permissions = Permission::findOrFail($id);

        return view('user.permissions.edit', compact('permissions'));
    }

    /**
     * Update the specified permissions in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\PermissionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $name = $request->input('name');
        $description = $request->input('description');
        $display_name = $request->input('display_name');

        DB::table('permissions')
            ->where('id', $id)
            ->update(['name' => $name, 'description' => $description, 'display_name' => $display_name]);
        return redirect()->route('permissions.permissions.index')
            ->with('success_message', 'Permissions was successfully updated.');
    }

    /**
     * Remove the specified permissions from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $permissions = Permission::findOrFail($id);
            $permissions->delete();

            return redirect()->route('permissions.permissions.index')
                ->with('success_message', 'Permissions was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }
}
