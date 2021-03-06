<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeFamily extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_families';

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
                  'name',
                  'sex',
                  'relationship',
                  'date_of_birth',
                  'photo',
                  'file',
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
     * Get the sex for this model.
     *
     * @return App\Models\Sex
     */
    public function sexes()
    {
        return $this->belongsTo(Sex::class,'sex');
    }

    /**
     * Get the relationship for this model.
     *
     * @return App\Models\Relationship
     */
    public function relationships()
    {
        return $this->belongsTo(Relationship::class,'relationship');
    }

}
