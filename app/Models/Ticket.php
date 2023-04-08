<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    const PRIORITY = ['Low', 'Medium', 'High'];
    const STATUS = ['Open', 'Closed', 'Archived'];

    protected $fillable = [
        'id', 'title', 'description', 'priority', 'status', 'is_resolved', 'comment',
        'assigned_by', 'assigned_to'
    ];

    /**
     * Get the assignedBy that owns the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    /**
     * Get the assignedTo that owns the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
