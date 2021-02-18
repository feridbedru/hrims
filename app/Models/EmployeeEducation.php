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
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }

    /**
     * Get the educationLevel for this model.
     *
     * @return App\Models\EducationLevel
     */
    public function educationLevel()
    {
        return $this->belongsTo('App\Models\EducationLevel','education_level_id');
    }

    /**
     * Get the educationalInstitute for this model.
     *
     * @return App\Models\EducationalInstitute
     */
    public function educationalInstitute()
    {
        return $this->belongsTo('App\Models\EducationalInstitute','educational_institute_id');
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
     * Get the gpaScale for this model.
     *
     * @return App\Models\GpaScale
     */
    public function gpaScale()
    {
        return $this->belongsTo('App\Models\GpaScale','gpa_scale_id');
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

    /**
     * Get the approvedBy for this model.
     *
     * @return App\Models\User
     */
    public function approvedBy()
    {
        return $this->belongsTo('App\Models\User','approved_by');
    }

    /**
     * Set the start_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the end_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the coc_issued_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setCocIssuedDateAttribute($value)
    {
        $this->attributes['coc_issued_date'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Set the approved_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setApprovedAtAttribute($value)
    {
        $this->attributes['approved_at'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get start_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getStartDateAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get end_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEndDateAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get coc_issued_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCocIssuedDateAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get approved_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getApprovedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

}
