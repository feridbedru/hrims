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
                  'Type',
                  'institution',
                  'level',
                  'field',
                  'start_date',
                  'duration',
                  'has_commitment',
                  'total_commitment',
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
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }

    /**
     * Get the commitmentFor for this model.
     *
     * @return App\Models\CommitmentFor
     */
    public function commitmentFor()
    {
        return $this->belongsTo('App\Models\CommitmentFor','commitment_for_id');
    }

    /**
     * Get the educationalInstitution for this model.
     *
     * @return App\Models\EducationalInstitution
     */
    public function educationalInstitution()
    {
        return $this->belongsTo('App\Models\EducationalInstitute','educational_institution_id');
    }

    /**
     * Get the educationalLevel for this model.
     *
     * @return App\Models\EducationalLevel
     */
    public function educationalLevel()
    {
        return $this->belongsTo('App\Models\EducationLevel','educational_level_id');
    }

    /**
     * Get the educationalField for this model.
     *
     * @return App\Models\EducationalField
     */
    public function educationalField()
    {
        return $this->belongsTo('App\Models\EducationalField','educational_field_id');
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
