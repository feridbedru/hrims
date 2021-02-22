<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDisasterIndeminity extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_disaster_indeminities';

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
                  'disaster',
                  'title',
                  'description',
                  'cost',
                  'file',
                  'created_by'
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
     * Get the employeeDisaster for this model.
     *
     * @return App\Models\EmployeeDisaster
     */
    public function employeeDisaster()
    {
        return $this->belongsTo('App\Models\EmployeeDisaster','employee_disaster_id');
    }

    /**
     * Get the creator for this model.
     *
     * @return App\Models\User
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }



}
