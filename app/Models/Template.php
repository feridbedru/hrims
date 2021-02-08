<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'templates';

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
                  'title',
                  'body',
                  'language',
                  'template_type',
                  'is_active',
                  'code'
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
     * Get the language for this model.
     *
     * @return App\Models\Language
     */
    public function language()
    {
        return $this->belongsTo('App\Models\Language','language_id');
    }

    /**
     * Get the templateType for this model.
     *
     * @return App\Models\TemplateType
     */
    public function templateType()
    {
        return $this->belongsTo('App\Models\TemplateType','template_type_id');
    }



}
