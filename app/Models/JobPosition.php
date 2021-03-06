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
    public function organizationUnits()
    {
        return $this->belongsTo(OrganizationUnit::class,'organization_unit');
    }

    /**
     * Get the jobTitleCategory for this model.
     *
     * @return App\Models\JobTitleCategory
     */
    public function jobTitleCategories()
    {
        return $this->belongsTo(JobTitleCategory::class,'job_title_category');
    }

    /**
     * Get the jobCategory for this model.
     *
     * @return App\Models\JobCategory
     */
    public function jobCategorys()
    {
        return $this->belongsTo(JobCategory::class,'job_category');
    }

    /**
     * Get the jobType for this model.
     *
     * @return App\Models\JobType
     */
    public function jobTypes()
    {
        return $this->belongsTo(JobType::class,'job_type');
    }

    /**
     * Get the salary for this model.
     *
     * @return App\Models\Salary
     */
    public function salarys()
    {
        return $this->belongsTo(Salary::class,'salary');
    }



}
