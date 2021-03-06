<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDisability extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_disabilities';

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
                  'type',
                  'description',
                  'medical_certificate',
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
     * Get the disabilityType for this model.
     *
     * @return App\Models\DisabilityType
     */
    public function types()
    {
        return $this->belongsTo(DisabilityType::class,'type');
    }

}
