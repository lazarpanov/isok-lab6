<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name', 'slug',
    ];

    public function blogs(): HasMany {
        return $this->hasMany(Blog::class);
    }
}
