<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory;

    const PRIORITY = ['Low', 'Medium', 'High'];
    const STATUS = ['Open', 'Closed', 'Archived'];

    const LOWPRIORITY = self::PRIORITY[0];
    const MEDIUMPRIORITY = self::PRIORITY[1];
    const HIGHPRIORITY = self::PRIORITY[2];

    const OPENSTATUS = self::STATUS[0];
    const CLOSEDSTATUS = self::STATUS[1];
    const ARCHIVEDSTATUS = self::STATUS[2];

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

    /**
     * The categories that belong to the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_tickets', 'ticket_id', 'category_id');
    }

    /**
     * The labels that belong to the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'label_tickets', 'ticket_id', 'label_id');
    }
}
