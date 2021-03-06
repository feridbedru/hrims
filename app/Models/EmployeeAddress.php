<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_addresses';

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
                  'employee',
                  'type',
                  'address',
                  'house_number',
                  'woreda',
                  'status',
                  'created_by',
                  'approved_by',
                  'approved_at',
                  'note'
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
     * Get the employee for this model.
     *
     * @return App\Models\Employee
     */
    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee');
    }

    /**
     * Get the addressType for this model.
     *
     * @return App\Models\AddressType
     */
    public function types()
    {
        return $this->belongsTo(AddressType::class,'type');
    }

    /**
     * Get the woreda for this model.
     *
     * @return App\Models\Woreda
     */
    public function woredas()
    {
        return $this->belongsTo(Woreda::class,'woreda');
    }

}
