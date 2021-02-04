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
                  'parent_id',
                  'job_category_id',
                  'organization_location_id',
                  'reports_to_id',
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
    public function organizationUnit()
    {
        return $this->belongsTo('App\Models\OrganizationUnit','parent_id');
    }
    
    /**
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function organizationUnits()
    {
        return $this->belongsTo('App\Models\OrganizationUnit','reports_to_id');
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
     * Get the organizationLocation for this model.
     *
     * @return App\Models\OrganizationLocation
     */
    public function organizationLocation()
    {
        return $this->belongsTo('App\Models\OrganizationLocation','organization_location_id');
    }

    /**
     * Get the organizationLocation for this model.
     *
     * @return App\Models\OrganizationLocation
     */
    public function chairman()
    {
        return $this->belongsTo('App\Models\User','chairman_id');
    }



}
