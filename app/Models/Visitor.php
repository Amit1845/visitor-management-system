<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'info_visitor';
    protected $primaryKey = 'Serial';

    protected $fillable = [
        'Name', 'Contact', 'Purpose', 'meetingTo', 'Date', 'TimeIN', 'TimeOUT', 'Status', 'Comment'
    ];

    protected $casts = [
        'Date' => 'date',
        'TimeIN' => 'datetime',
        'TimeOUT' => 'datetime',
    ];

    public function getReceiptIdAttribute(): int
    {
        return (int) ($this->receipt_id ?? $this->Serial);
    }
}
