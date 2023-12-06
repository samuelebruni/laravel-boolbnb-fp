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

    protected $fillable = ['name','cover_image','description','latitude','longitude','rooms', 'bedrooms', 'beds', 'bathrooms', 'smokers', 'visible'];
}
