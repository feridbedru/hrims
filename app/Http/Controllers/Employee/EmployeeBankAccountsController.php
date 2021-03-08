<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccountType;
use App\Models\Employee;
use App\Models\EmployeeBankAccount;
use App\Models\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Exception;

class EmployeeBankAccountsController extends Controller
{

    /**
     * Display a listing of the employee bank accounts.
     *
     * @return Illuminate\View\View
     */
    public function index($id)
    {
        $employee_id = $id;
        $employee = Employee::findOrFail($employee_id);
        $employeeBankAccounts = EmployeeBankAccount::where('employee', $employee_id)->with('banks', 'types', 'employees')->paginate(25);

        return view('employees.bank_account.index', compact('employeeBankAccounts','employee'));
    }

    /**
     * Show the form for creating a new employee bank account.
     *
     * @return Illuminate\View\View
     */
    public function create($id)
    {
        $employee = Employee::findOrFail($id);
        $banks = Bank::pluck('name', 'id')->all();
        $bankAccountTypes = BankAccountType::pluck('name', 'id')->all();

        return view('employees.bank_account.create', compact('employee', 'banks', 'bankAccountTypes'));
    }

    /**
     * Approve the specified employee bank address
     *
     * @param int $id
     */
    public function approve($employee,$employeeBankAccounts)
    {
        try {

            $employeeBankAccount = EmployeeBankAccount::findOrFail($employeeBankAccounts);
            $employeeBankAccount->status = 3;
            $employeeBankAccount->approved_by = 1;
            $employeeBankAccount->approved_at = now();
            $employeeBankAccount->save();

            return redirect()->route('employee_bank_accounts.employee_bank_account.index',$employee)
                ->with('success_message', 'Employee Bank Account was successfully approved.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
            return back()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * reject the specified employee bank address
     *
     * @param int $id
     */
    public function reject($employee,$employeeBankAccounts, Request $request)
    {
        try {

            $employeeBankAccount = EmployeeBankAccount::findOrFail($employeeBankAccounts);
            $employeeBankAccount->status = 2;
            $employeeBankAccount->note = $request['note'];
            $employeeBankAccount->save();

            return redirect()->route('employee_bank_accounts.employee_bank_account.index',$employee)
                ->with('success_message', 'Employee Bank Account was successfully rejected.');
        } catch (Exception $exception) {
            $systemException = new SystemException();
            $systemException->function = Route::currentRouteAction();
            $systemException->path = Route::getCurrentRoute()->uri();
            $systemException->request = json_encode($request->all());
            $systemException->message = json_encode([$exception->getMessage()]);
            $systemException->status = 1;
            $systemException->save();
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
    public function store(Request $request,$id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $data = $this->getData($request);
            $data['created_by'] = 1;
            $data['status'] = 1;
            $data['employee'] = $id;
            EmployeeBankAccount::create($data);

            return redirect()->route('employee_bank_accounts.employee_bank_account.index',$employee)
                ->with('success_message', 'Employee Bank Account was successfully added.');
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
     * Show the form for editing the specified employee bank account.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($employee, $employeeBankAccounts)
    {
        $employee = Employee::findOrFail($employee);
        $employeeBankAccount = EmployeeBankAccount::findOrFail($employeeBankAccounts);
        $banks = Bank::pluck('name', 'id')->all();
        $bankAccountTypes = BankAccountType::pluck('name', 'id')->all();

        return view('employees.bank_account.edit', compact('employeeBankAccount', 'employee', 'banks', 'bankAccountTypes'));
    }

    /**
     * Update the specified employee bank account in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($employee, $employeeBankAccounts, Request $request)
    {
        try {

            $data = $this->getData($request);

            $employeeBankAccount = EmployeeBankAccount::findOrFail($employeeBankAccounts);
            $employeeBankAccount->update($data);

            return redirect()->route('employee_bank_accounts.employee_bank_account.index',$employee)
                ->with('success_message', 'Employee Bank Account was successfully updated.');
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
     * Remove the specified employee bank account from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($employee, $employeeBankAccounts)
    {
        try {
            $employeeBankAccount = EmployeeBankAccount::findOrFail($employeeBankAccounts);
            $employeeBankAccount->delete();

            return redirect()->route('employee_bank_accounts.employee_bank_account.index',$employee)
                ->with('success_message', 'Employee Bank Account was successfully deleted.');
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
            'bank' => 'required',
            'account_type' => 'required|numeric|min:0|max:4294967295',
            'account_number' => 'required|numeric',
            'file' => ['file', 'nullable'],
            'status' => 'numeric|min:1|nullable',
            'created_by' => 'nullable',
            'approved_by' => 'nullable',
            'approved_at' => 'nullable',
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
