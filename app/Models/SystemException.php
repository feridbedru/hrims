<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemException extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'system_exceptions';

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
                  'function',
                  'path',
                  'request',
                  'message',
                  'status'
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
    



}
