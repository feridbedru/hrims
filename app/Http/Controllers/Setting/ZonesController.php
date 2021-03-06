<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\SystemException;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Exception;

class ZonesController extends Controller
{

    /**
     * Display a listing of the zones.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $zones = Zone::with('regions')->paginate(25);

        return view('settings.zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new zone.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $regions = Region::pluck('name', 'id')->all();

        return view('settings.zones.create', compact('regions'));
    }

    /**
     * Store a new zone in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            Zone::create($data);

            return redirect()->route('zones.zone.index')
                ->with('success_message', 'Zone was successfully added.');
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
     * Show the form for editing the specified zone.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        $regions = Region::pluck('name', 'id')->all();

        return view('settings.zones.edit', compact('zone', 'regions'));
    }

    /**
     * Update the specified zone in the storage.
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

            $zone = Zone::findOrFail($id);
            $zone->update($data);

            return redirect()->route('zones.zone.index')
                ->with('success_message', 'Zone was successfully updated.');
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
     * Remove the specified zone from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $zone = Zone::findOrFail($id);
            $delete = $zone->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Zone deleted successfully";
            } else {
                $success = false;
                $message = "Zone not found";
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
            'region' => 'required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
