<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontSetting extends Model
{
    public $table = 'front_settings';
    public $fillable = [
        'key',
        'value',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'value' => 'required',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string',
    ];
}
