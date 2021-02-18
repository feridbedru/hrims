<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccountType;
use App\Models\Employee;
use App\Models\EmployeeBankAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class EmployeeBankAccountsController extends Controller
{

    /**
     * Display a listing of the employee bank accounts.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employeeBankAccounts = EmployeeBankAccount::with('employee','bank','bankaccounttype')->paginate(25);

        return view('employee_bank_accounts.index', compact('employeeBankAccounts'));
    }

    /**
     * Show the form for creating a new employee bank account.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $employees = Employee::pluck('en_name','id')->all();
        $banks = Bank::pluck('name','id')->all();
        $bankAccountTypes = BankAccountType::pluck('name','id')->all();
        $creators = User::pluck('name','id')->all();
        
        return view('employee_bank_accounts.create', compact('employees','banks','bankAccountTypes','creators'));
    }

    /**
     * Approve the specified employee bank address
     *
     * @param int $id
     */
    public function approve($id)
    {
        try {
            
            $employeeBankAccount = EmployeeBankAccount::findOrFail($id);
            $employeeBankAccount->status = '3';
            $employeeBankAccount->approved_by = '1';
            $employeeBankAccount->approved_at = now();
            $employeeBankAccount->save();

            return redirect()->route('employee_bank_accounts.employee_bank_account.index')
                ->with('success_message', 'Employee Bank Account was successfully approved.');
        } catch (Exception $exception) {

            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * reject the specified employee bank address
     *
     * @param int $id
     */
    public function reject($id, Request $request)
    {
        try {
            
            $employeeBankAccount = EmployeeBankAccount::findOrFail($id);
            $employeeBankAccount->status = '2';
            $employeeBankAccount->note = '1';
            $employeeBankAccount->save();

            return redirect()->route('employee_bank_accounts.employee_bank_account.index')
                ->with('success_message', 'Employee Bank Account was successfully rejected.');
        } catch (Exception $exception) {

            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Store a new employee bank account in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['created_by'] = 1;
            $data['status'] = 1;
            EmployeeBankAccount::create($data);

            return redirect()->route('employee_bank_accounts.employee_bank_account.index')
                ->with('success_message', 'Employee Bank Account was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified employee bank account.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $employeeBankAccount = EmployeeBankAccount::findOrFail($id);
        $employees = Employee::pluck('en_name','id')->all();
        $banks = Bank::pluck('name','id')->all();
        $bankAccountTypes = BankAccountType::pluck('name','id')->all();

        return view('employee_bank_accounts.edit', compact('employeeBankAccount','employees','banks','bankAccountTypes'));
    }

    /**
     * Update the specified employee bank account in the storage.
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
            
            $employeeBankAccount = EmployeeBankAccount::findOrFail($id);
            $employeeBankAccount->update($data);

            return redirect()->route('employee_bank_accounts.employee_bank_account.index')
                ->with('success_message', 'Employee Bank Account was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee bank account from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employeeBankAccount = EmployeeBankAccount::findOrFail($id);
            $employeeBankAccount->delete();

            return redirect()->route('employee_bank_accounts.employee_bank_account.index')
                ->with('success_message', 'Employee Bank Account was successfully deleted.');
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
                'employee' => 'required',
                'bank' => 'required',
                'account_type' => 'required|numeric|min:0|max:4294967295',
                'account_number' => 'required|numeric',
                'file' => ['file','nullable'], 
                'status' => 'string|min:1|nullable',
                'created_by' => 'required',
                'approved_by' => 'nullable',
                'approved_at' => 'date_format:j/n/Y g:i A|nullable',
                'note' => 'string|min:1|max:1000|nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_file')) {
            $data['file'] = null;
        }
        if ($request->hasFile('file')) {
            $data['file'] = $this->moveFile($request->file('file'));
        }

        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}
