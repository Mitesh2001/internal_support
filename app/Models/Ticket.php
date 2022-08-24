<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Concat;

class Ticket extends Model
{
    use HasFactory;

    public $fillable = [
        'requester_id',
        'user_id',
        'type_id',
        'state_id',
        'agent_id',
        'source_id',
        'priority_id',
        'resolve_by',
        'subject',
        'description',
        'attachment',
        'status'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class,'requester_id');
    }

    public function agent()
    {
        return $this->hasOne(User::class,'id','agent_id');
    }

}
