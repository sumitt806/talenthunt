<?php

namespace App;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportedToCandidate extends Model
{
    public $table = 'reported_to_candidates';
    public $fillable = [
        'user_id',
        'candidate_id',
        'note',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id'      => 'integer',
        'candidate_id' => 'integer',
        'note'         => 'string',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
