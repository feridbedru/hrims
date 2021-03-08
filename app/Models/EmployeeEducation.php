<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_educations';

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
                  'level',
                  'institute',
                  'field',
                  'gpa_scale',
                  'gpa',
                  'start_date',
                  'end_date',
                  'file',
                  'has_coc',
                  'coc_issued_date',
                  'coc_file',
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
     * Get the educationLevel for this model.
     *
     * @return App\Models\EducationLevel
     */
    public function levels()
    {
        return $this->belongsTo(EducationLevel::class,'level');
    }

    /**
     * Get the educationalInstitute for this model.
     *
     * @return App\Models\EducationalInstitute
     */
    public function institutes()
    {
        return $this->belongsTo(EducationalInstitute::class,'institute');
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

    /**
     * Get the gpaScale for this model.
     *
     * @return App\Models\GpaScale
     */
    public function gpaScales()
    {
        return $this->belongsTo(GPAScale::class,'gpa_scale');
    }

}
