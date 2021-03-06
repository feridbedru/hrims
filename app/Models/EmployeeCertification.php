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
    public function employees()
    {
        return $this->belongsTo(Employee::class,'employee');
    }

    /**
     * Get the skillCategory for this model.
     *
     * @return App\Models\SkillCategory
     */
    public function categories()
    {
        return $this->belongsTo(SkillCategory::class,'category');
    }

    /**
     * Get the certificationVendor for this model.
     *
     * @return App\Models\CertificationVendor
     */
    public function vendors()
    {
        return $this->belongsTo(CertificationVendor::class,'vendor');
    }

}
