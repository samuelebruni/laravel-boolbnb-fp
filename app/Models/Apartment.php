<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{
    use HasFactory;
    /* use SoftDeletes; */

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['name','cover_image','description','latitude','longitude','rooms', 'bedrooms', 'beds', 'bathrooms', 'smokers', 'visible', 'user_id'];
}
