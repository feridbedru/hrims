<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evaluation_questions';

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
                  'criteria',
                  'weight',
                  'order',
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
     * Get the evaluation for this model.
     *
     * @return App\Models\Evaluation
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class,'evaluation_id');
    }



}
