<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLanguage extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_languages';

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
                  'language',
                  'reading',
                  'writing',
                  'listening',
                  'speaking',
                  'is_prefered',
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
     * Get the language for this model.
     *
     * @return App\Models\Language
     */
    public function languages()
    {
        return $this->belongsTo(Language::class,'language');
    }

    /**
     * Get the languageLevel for this model.
     *
     * @return App\Models\LanguageLevel
     */
    public function languageLevels()
    {
        return $this->belongsTo(LanguageLevel::class,'language_level');
    }
}
