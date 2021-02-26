<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\AwardType;
use Illuminate\Http\Request;
use Exception;

class AwardTypesController extends Controller
{

    /**
     * Display a listing of the award types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $awardTypes = AwardType::paginate(25);

        return view('settings.award_types.index', compact('awardTypes'));
    }

    /**
     * Show the form for creating a new award type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.award_types.create');
    }

    /**
     * Store a new award type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            AwardType::create($data);

            return redirect()->route('award_types.award_type.index')
                ->with('success_message', 'Award Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified award type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $awardType = AwardType::findOrFail($id);
        

        return view('settings.award_types.edit', compact('awardType'));
    }

    /**
     * Update the specified award type in the storage.
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
            
            $awardType = AwardType::findOrFail($id);
            $awardType->update($data);

            return redirect()->route('award_types.award_type.index')
                ->with('success_message', 'Award Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified award type from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $awardType = AwardType::findOrFail($id);
            $delete = $awardType->delete();

            if ($delete == 1) {
                $success = true;
                $message = "Award Type deleted successfully";
            } else {
                $success = false;
                $message = "Award Type not found";
            }
                    //  return response
                    return response()->json([
                        'success' => $success,
                        'message' => $message,
                    ]);
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
                'name' => 'required|string|min:1|max:255',
            'description' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
