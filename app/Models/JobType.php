<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobType
 *
 * @package App\Models
 * @version June 22, 2020, 5:43 am UTC
 * @property string $name
 * @property string $description
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\JobType whereDescription($value)
 */
class JobType extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:job_types,name',
    ];
    public $table = 'job_types';
    public $fillable = [
        'name',
        'description',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',
    ];
}
