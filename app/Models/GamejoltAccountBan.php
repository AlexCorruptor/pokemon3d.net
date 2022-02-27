<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class GamejoltAccountBan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;
    use LogsActivity;

    protected $primaryKey = 'uuid';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gamejoltaccount_id', 'banned_by_id', 'reason_id', 'expire_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expire_at' => 'datetime',
    ];

    /**
     * The attributes that should be logged for the user.
     *
     * @return array
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }

    /**
     * Get the gamejolt account associated with the gamejolt account ban.
     */
    public function gamejoltaccount()
    {
        return $this->hasOne(GamejoltAccount::class, 'id', 'gamejoltaccount_id');
    }

    /**
     * Get the reason associated with the gamejolt account ban.
     */
    public function reason()
    {
        return $this->belongsTo(BanReason::class, 'reason_id', 'id');
    }

    /**
     * Get the user associated with the gamejolt account ban.
     */
    public function banned_by()
    {
        return $this->belongsTo(User::class);
    }
}
