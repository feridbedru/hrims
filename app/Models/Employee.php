<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

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
                  'en_name',
                  'am_name',
                  'title',
                  'sex',
                  'date_of_birth',
                  'photo',
                  'phone_number',
                  'organization_unit',
                  'job_position',
                  'employment_id',
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
     * Get the title for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function title()
    {
        return $this->hasMany('App\Models\Title','id');
    }

    /**
     * Get the sex for this model.
     *
     * @return App\Models\Sex
     */
    public function sex()
    {
        return $this->belongsTo('App\Models\Sex','id');
    }

    /**
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function organizationUnit()
    {
        return $this->belongsTo('App\Models\OrganizationUnit','id');
    }

    /**
     * Get the jobPosition for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function jobPosition()
    {
        return $this->hasMany('App\Models\JobPosition','id');
    }

    /**
     * Get the employeeStatus for this model.
     *
     * @return App\Models\EmployeeStatus
     */
    public function employeeStatus()
    {
        return $this->belongsTo('App\Models\EmployeeStatus','id');
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

}
