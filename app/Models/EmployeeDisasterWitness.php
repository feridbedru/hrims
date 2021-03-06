<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDisasterWitness extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_disaster_witnesses';

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
                  'name',
                  'phone',
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
    public function disasters()
    {
        return $this->belongsTo(EmployeeDisaster::class,'disaster');
    }

}
