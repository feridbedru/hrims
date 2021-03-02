<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\OrganizationLocation;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class OrganizationLocationsController extends Controller
{

    /**
     * Display a listing of the organization locations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $organizationLocations = OrganizationLocation::paginate(25);

        return view('settings.organization_locations.index', compact('organizationLocations'));
    }

    /**
     * Show the form for creating a new organization location.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.organization_locations.create');
    }

    /**
     * Store a new organization location in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            OrganizationLocation::create($data);

            return redirect()->route('organization_locations.organization_location.index')
                ->with('success_message', 'Organization Location was successfully added.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified organization location.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $organizationLocation = OrganizationLocation::findOrFail($id);

        return view('settings.organization_locations.edit', compact('organizationLocation'));
    }

    /**
     * Update the specified organization location in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $organizationLocation = OrganizationLocation::findOrFail($id);
            $organizationLocation->update($data);

            return redirect()->route('organization_locations.organization_location.index')
                ->with('success_message', 'Organization Location was successfully updated.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified organization location from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $organizationLocation = OrganizationLocation::findOrFail($id);
            $delete = $organizationLocation->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Organization Location deleted successfully";
            } else {
                $success = false;
                $message = "Organization Location not found";
            }
            //  return response
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
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
            'name' => 'required|string|min:1|max:255',
            'address' => 'string|min:1|nullable',
            'cordinates' => 'string|min:1|nullable',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
