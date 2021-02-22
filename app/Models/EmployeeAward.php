<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAward extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_awards';

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
                  'organization',
                  'description',
                  'attachment',
                  'type',
                  'awarded_on',
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
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }

    /**
     * Get the awardType for this model.
     *
     * @return App\Models\AwardType
     */
    public function awardType()
    {
        return $this->belongsTo('App\Models\AwardType','award_type_id');
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
