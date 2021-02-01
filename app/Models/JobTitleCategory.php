<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTitleCategory extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_title_categories';

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
                  'name',
                  'description',
                  'job_title_category_id'
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
     * Get the jobTitleCategory for this model.
     *
     * @return App\Models\JobTitleCategory
     */
    public function jobTitleCategory()
    {
        return $this->belongsTo('App\Models\JobTitleCategory','job_title_category_id');
    }



}
