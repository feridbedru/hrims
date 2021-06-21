<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leave_types';

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
                  'job_type_id',
                  'initial',
                  'maximum',
                  'male',
                  'female',
                  'includes_offdays',
                  'is_transferable',
                  'pre_post',
                  'is_active'
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
     * Get the jobType for this model.
     *
     * @return App\Models\JobType
     */
    public function jobType()
    {
        return $this->belongsTo('App\Models\JobType','job_type_id');
    }



}
