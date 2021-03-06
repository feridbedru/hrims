<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryScale extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salary_scales';

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
                  'name',
                  'description',
                  'job_category',
                  'stair_height',
                  'salary_steps',
                  'is_enabled'
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
     * Get the jobCategory for this model.
     *
     * @return App\Models\JobCategory
     */
    public function jobCategories()
    {
        return $this->belongsTo(JobCategory::class,'job_category');
    }



}
