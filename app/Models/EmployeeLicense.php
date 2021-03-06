<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLicense extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_licenses';

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
                  'title',
                  'type',
                  'issuing_organization',
                  'expiry_date',
                  'file',
                  'status',
                  'created_by',
                  'approved_by',
                  'approved_at',
                  'note'
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
     * Get the licenseType for this model.
     *
     * @return App\Models\LicenseType
     */
    public function types()
    {
        return $this->belongsTo(LicenseType::class,'type');
    }

}
