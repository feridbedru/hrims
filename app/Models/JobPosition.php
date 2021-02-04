<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_positions';

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
                  'organization_unit',
                  'job_title_category',
                  'job_category',
                  'job_type',
                  'job_description',
                  'position_code',
                  'position_id',
                  'salary',
                  'status'
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
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function organizationUnit()
    {
        return $this->belongsTo('App\Models\OrganizationUnit','organization_unit_id');
    }

    /**
     * Get the jobTitleCategory for this model.
     *
     * @return App\Models\JobTitleCategory
     */
    public function jobTitleCategory()
    {
        return $this->belongsTo('App\Models\JobTitleCategory','job_title_category_id');
    }

    /**
     * Get the jobCategory for this model.
     *
     * @return App\Models\JobCategory
     */
    public function jobCategory()
    {
        return $this->belongsTo('App\Models\JobCategory','job_category_id');
    }

    /**
     * Get the jobType for this model.
     *
     * @return App\Models\JobType
     */
    public function jobType()
    {
        return $this->belongsTo('App\Models\JobType','job_type_id');
    }

    /**
     * Get the salary for this model.
     *
     * @return App\Models\Salary
     */
    public function salary()
    {
        return $this->belongsTo('App\Models\Salary','salary_id');
    }



}
