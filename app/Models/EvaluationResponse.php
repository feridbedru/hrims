<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationResponse extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluation_responses';

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
                  'evaluation_id',
                  'result',
                  'employee_id',
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
     * Get the evaluationQuestion for this model.
     *
     * @return App\Models\EvaluationQuestion
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class,'evaluation_id');
    }

    /**
     * Get the employee for this model.
     *
     * @return App\Models\Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    /**
     * Get the evaluatedBy for this model.
     *
     * @return App\Models\User
     */
    public function evaluatedBy()
    {
        return $this->belongsTo(User::class,'evaluated_by');
    }

}
