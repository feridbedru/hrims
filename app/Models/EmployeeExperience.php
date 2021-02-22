<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_experiences';

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
                  'organization_name',
                  'organization_address',
                  'job_position',
                  'level',
                  'salary',
                  'left_reason',
                  'start_date',
                  'end_date',
                  'attachment',
                  'status',
                  'note',
                  'created_by',
                  'approved_by',
                  'approved_at'
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
        return $this->belongsTo('App\Models\Employee','employee_id');
    }

    /**
     * Get the experienceType for this model.
     *
     * @return App\Models\ExperienceType
     */
    public function experienceType()
    {
        return $this->belongsTo('App\Models\ExperienceType','experience_type_id');
    }

    /**
     * Get the leftReason for this model.
     *
     * @return App\Models\LeftReason
     */
    public function leftReason()
    {
        return $this->belongsTo('App\Models\LeftReason','left_reason_id');
    }

    /**
     * Get the creator for this model.
     *
     * @return App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }

    /**
     * Get the approvedBy for this model.
     *
     * @return App\Models\ApprovedBy
     */
    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User','approved_by');
    }

}
