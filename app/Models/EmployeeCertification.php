<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCertification extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_certifications';

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
                  'issued_on',
                  'certification_number',
                  'category',
                  'verification_link',
                  'vendor',
                  'attachment',
                  'expires_on',
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
     * Get the skillCategory for this model.
     *
     * @return App\Models\SkillCategory
     */
    public function skillCategory()
    {
        return $this->belongsTo('App\Models\SkillCategory','skill_category_id');
    }

    /**
     * Get the certificationVendor for this model.
     *
     * @return App\Models\CertificationVendor
     */
    public function certificationVendor()
    {
        return $this->belongsTo('App\Models\CertificationVendor','certification_vendor_id');
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
