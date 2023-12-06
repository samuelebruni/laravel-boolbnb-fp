<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    /* use SoftDeletes; */

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    protected $fillable = ['name','cover_image','description','latitude','longitude','rooms', 'bedrooms', 'beds', ''];
}
