<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property string $name
 * @property string|null $stripe_plan_id
 * @property int $allowed_jobs
 * @property float $amount
 * @property int $is_trial_plan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereAllowedJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereIsTrialPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereStripePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Plan extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'plans';

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'         => 'required|unique:plans,name',
        'amount'       => 'required|numeric|min:1',
        'allowed_jobs' => 'required|numeric|min:1',
    ];
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'stripe_plan_id',
        'allowed_jobs',
        'amount',
        'is_trial_plan'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name'           => 'string',
        'stripe_plan_id' => 'string',
        'allowed_jobs'   => 'integer',
        'amount'         => 'double',
        'is_trial_plan'  => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function activeSubscriptions()
    {
        return $this->hasMany(Subscription::class, 'plan_id', 'id')
            ->Where('ends_at', '=', null);
    }
}
