<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDisaster extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_disasters';

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
                  'occured_on',
                  'cause',
                  'severity',
                  'description',
                  'attachment',
                  'is_mass',
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
     * Get the disasterCause for this model.
     *
     * @return App\Models\DisasterCause
     */
    public function disasterCause()
    {
        return $this->belongsTo('App\Models\DisasterCause','disaster_cause_id');
    }

    /**
     * Get the disasterSeverity for this model.
     *
     * @return App\Models\DisasterSeverity
     */
    public function disasterSeverity()
    {
        return $this->belongsTo('App\Models\DisasterSeverity','disaster_severity_id');
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
