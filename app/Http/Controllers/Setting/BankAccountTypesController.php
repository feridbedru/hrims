<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\BankAccountType;
use Illuminate\Http\Request;
use Exception;

class BankAccountTypesController extends Controller
{

    /**
     * Display a listing of the bank account types.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $bankAccountTypes = BankAccountType::paginate(25);

        return view('settings.bank_account_types.index', compact('bankAccountTypes'));
    }

    /**
     * Show the form for creating a new bank account type.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('settings.bank_account_types.create');
    }

    /**
     * Store a new bank account type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            BankAccountType::create($data);

            return redirect()->route('bank_account_types.bank_account_type.index')
                ->with('success_message', 'Bank Account Type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified bank account type.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bankAccountType = BankAccountType::findOrFail($id);
        

        return view('settings.bank_account_types.edit', compact('bankAccountType'));
    }

    /**
     * Update the specified bank account type in the storage.
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
            
            $bankAccountType = BankAccountType::findOrFail($id);
            $bankAccountType->update($data);

            return redirect()->route('bank_account_types.bank_account_type.index')
                ->with('success_message', 'Bank Account Type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified bank account type from the storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $bankAccountType = BankAccountType::findOrFail($id);
            $delete = $bankAccountType->delete();
            if ($delete == 1) {
                $success = true;
                $message = "Bank Account Type deleted successfully";
            } else {
                $success = false;
                $message = "Bank Account Type not found";
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
