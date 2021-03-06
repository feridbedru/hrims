<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryHeight extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salary_heights';

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
                  'salary_scale',
                  'level',
                  'initial_salary',
                  'maximum_salary'
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
     * Get the salaryScale for this model.
     *
     * @return App\Models\SalaryScale
     */
    public function salaryScales()
    {
        return $this->belongsTo(SalaryScale::class,'salary_scale');
    }



}
