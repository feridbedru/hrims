<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeStudyTraining extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_study_trainings';

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
                  'institution',
                  'level',
                  'field',
                  'start_date',
                  'duration',
                  'has_commitment',
                  'total_commitment',
                  'amount',
                  'attachment',
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
     * Get the employee for this model.
     *
     * @return App\Models\Employee
     */
    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee');
    }

    /**
     * Get the commitmentFor for this model.
     *
     * @return App\Models\CommitmentFor
     */
    public function types()
    {
        return $this->belongsTo(CommitmentFor::class,'type');
    }

    /**
     * Get the educationalInstitution for this model.
     *
     * @return App\Models\EducationalInstitution
     */
    public function institutions()
    {
        return $this->belongsTo(EducationalInstitute::class,'institution');
    }

    /**
     * Get the educationalLevel for this model.
     *
     * @return App\Models\EducationalLevel
     */
    public function levels()
    {
        return $this->belongsTo(EducationLevel::class,'level');
    }

    /**
     * Get the educationalField for this model.
     *
     * @return App\Models\EducationalField
     */
    public function fields()
    {
        return $this->belongsTo(EducationalField::class,'field');
    }
}
