<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortLinkClick extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $fillable = [
        'short_link_id',
        'ip_address',
    ];

    public function shortLink(): BelongsTo
    {
        return $this->belongsTo(ShortLink::class);
    }
}
