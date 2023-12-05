<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongToMany;

class Apartment extends Model
{
    use HasFactory;

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

}
