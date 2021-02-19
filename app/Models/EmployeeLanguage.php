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
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }

    /**
     * Get the language for this model.
     *
     * @return App\Models\Language
     */
    public function language()
    {
        return $this->belongsTo('App\Models\Language','language_id');
    }

    /**
     * Get the languageLevel for this model.
     *
     * @return App\Models\LanguageLevel
     */
    public function languageLevel()
    {
        return $this->belongsTo('App\Models\LanguageLevel','language_level_id');
    }

    /**
     * Get the creator for this model.
     *
     * @return App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }



}
