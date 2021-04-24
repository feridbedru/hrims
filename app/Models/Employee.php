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
                  'created_by',
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
     * @return App\Models\Title
     */
    public function titles()
    {
        return $this->belongsTo(Title::class,'title');
    }

    /**
     * Get the sex for this model.
     *
     * @return App\Models\Sex
     */
    public function sexes()
    {
        return $this->belongsTo(Sex::class,'sex');
    }

    /**
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function organizationUnitse()
    {
        return $this->belongsTo(OrganizationUnit::class,'organization_unit');
    }

    /**
     * Get the jobPosition for this model.
     *
     * @return App\Models\JobPosition
     */
    public function jobPositions()
    {
        return $this->belongsTo(JobPosition::class,'job_position');
    }

    /**
     * Get the employeeStatus for this model.
     *
     * @return App\Models\EmployeeStatus
     */
    public function employeeStatuses()
    {
        return $this->belongsTo(EmployeeStatus::class,'status');
    }

}
