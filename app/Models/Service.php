<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongToMany;

class Service extends Model
{
    use HasFactory;

    public function apartment(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
