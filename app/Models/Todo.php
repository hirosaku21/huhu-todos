<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory;

    protected $fillable = [
        'content',
        'category_id',
        'sharing_range',
        'registered_by'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function completed_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function registerd_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registerd_by');
    }
}
