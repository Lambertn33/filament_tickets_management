<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'is_visible'
    ];

     /**
     * The tickets that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class, 'label_tickets', 'label_id', 'ticket_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }
}
