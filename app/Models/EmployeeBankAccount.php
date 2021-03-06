<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBankAccount extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_bank_accounts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'employee',
                  'bank',
                  'account_type',
                  'account_number',
                  'file',
                  'status',
                  'created_by'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the employee for this model.
     *
     * @return App\Models\Employee
     */
    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee');
    }

    /**
     * Get the bank for this model.
     *
     * @return App\Models\Bank
     */
    public function banks()
    {
        return $this->belongsTo(Bank::class,'bank');
    }

    /**
     * Get the bankAccountType for this model.
     *
     * @return App\Models\BankAccountType
     */
    public function types()
    {
        return $this->belongsTo(BankAccountType::class,'account_type');
    }

}
