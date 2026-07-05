<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['short_link_id', 'ip_address'])]
class LinkClick extends Model
{
    public function shortLink(): BelongsTo
    {
        return $this->belongsTo(ShortLink::class);
    }
}
