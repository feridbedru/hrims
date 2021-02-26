<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Exception;

class BanksController extends Controller
{

    /**
     * Display a listing of the banks.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $banks = Bank::paginate(25);

        return view('settings.banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new bank.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.banks.create');
    }

    /**
     * Store a new bank in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Bank::create($data);

            return redirect()->route('banks.bank.index')
                ->with('success_message', 'Bank was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified bank.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        

        return view('settings.banks.edit', compact('bank'));
    }

    /**
     * Update the specified bank in the storage.
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
            
            $bank = Bank::findOrFail($id);
            $bank->update($data);

            return redirect()->route('banks.bank.index')
                ->with('success_message', 'Bank was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified bank from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bank = Bank::findOrFail($id);
            $delete = $bank->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Bank deleted successfully";
            } else {
                $success = false;
                $message = "Bank not found";
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
