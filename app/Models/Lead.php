<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'message', 'apartment_id'];
    
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
