<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'helps';

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
                  'description',
                  'data',
                  'topic_for',
                  'parent',
                  'language_id',
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
     * Get the help for this model.
     *
     * @return App\Models\Help
     */
    public function help()
    {
        return $this->belongsTo('App\Models\Help','help_id');
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
     * Get the creator for this model.
     *
     * @return App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }



}
