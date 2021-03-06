<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salaries';

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
                  'salary_height',
                  'salary_step',
                  'amount'
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
     * Get the salaryHeight for this model.
     *
     * @return App\Models\SalaryHeight
     */
    public function salaryHeights()
    {
        return $this->belongsTo(SalaryHeight::class,'salary_height');
    }

    /**
     * Get the salaryStep for this model.
     *
     * @return App\Models\SalaryStep
     */
    public function salarySteps()
    {
        return $this->belongsTo(SalaryStep::class,'salary_step');
    }



}
