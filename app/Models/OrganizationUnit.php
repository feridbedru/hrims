<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationUnit extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organization_units';

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
                  'en_acronym',
                  'am_name',
                  'am_acronym',
                  'parent',
                  'job_category',
                  'location',
                  'reports_to',
                  'is_root_unit',
                  'is_category',
                  'phone_number',
                  'email_address',
                  'web_page'
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
    public function parents()
    {
        return $this->belongsTo(OrganizationUnit::class,'parent');
    }
    
    /**
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function reportsTo()
    {
        return $this->belongsTo(OrganizationUnit::class,'reports_to');
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
     * Get the organizationLocation for this model.
     *
     * @return App\Models\OrganizationLocation
     */
    public function locations()
    {
        return $this->belongsTo(OrganizationLocation::class,'location');
    }

    /**
     * Get the organizationLocation for this model.
     *
     * @return App\Models\OrganizationLocation
     */
    public function chairman()
    {
        return $this->belongsTo(User::class,'chairman');
    }



}
