<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAdditionalInfo extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_additional_infos';

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
                  'place_of_birth',
                  'other_phone_number',
                  'nationality',
                  'religion',
                  'blood_group',
                  'tin_number',
                  'pension',
                  'marital_status',
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
     * Get the nationality for this model.
     *
     * @return App\Models\Nationality
     */
    public function nationalities()
    {
        return $this->belongsTo(Nationality::class,'nationality');
    }

    /**
     * Get the religion for this model.
     *
     * @return App\Models\Religion
     */
    public function religions()
    {
        return $this->belongsTo(Religion::class,'religion');
    }

    /**
     * Get the maritalStatus for this model.
     *
     * @return App\Models\MaritalStatus
     */
    public function maritalStatuses()
    {
        return $this->belongsTo(MaritalStatus::class,'marital_status');
    }

}
