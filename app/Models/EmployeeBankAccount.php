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
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','id');
    }

    /**
     * Get the bank for this model.
     *
     * @return App\Models\Bank
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank','id');
    }

    /**
     * Get the bankAccountType for this model.
     *
     * @return App\Models\BankAccountType
     */
    public function bankAccountType()
    {
        return $this->belongsTo('App\Models\BankAccountType','bank_account_type_id');
    }

    /**
     * Get the creator for this model.
     *
     * @return App\Models\User
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }

    /**
     * Get the approvedBy for this model.
     *
     * @return App\Models\User
     */
    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User','approved_by');
    }

}
