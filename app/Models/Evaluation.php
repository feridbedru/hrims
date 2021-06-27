<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluations';

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
                  'title',
                  'description',
                  'time_period',
                  'start_date',
                  'end_date',
                  'evaluation_type_id',
                  'job_category_id',
                  'organization_units_id',
                  'self',
                  'peer', 
                  'team_leader',
                  'unit_leader',
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
     * Get the evaluationType for this model.
     *
     * @return App\Models\EvaluationType
     */
    public function evaluationType()
    {
        return $this->belongsTo(EvaluationType::class,'evaluation_type');
    }

    /**
     * Get the jobCategory for this model.
     *
     * @return App\Models\JobCategory
     */
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class,'job_category');
    }

    /**
     * Get the organizationUnit for this model.
     *
     * @return App\Models\OrganizationUnit
     */
    public function organizationUnit()
    {
        return $this->belongsTo(OrganizationUnit::class,'organization_units_id');
    }

}
