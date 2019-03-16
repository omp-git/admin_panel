<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    protected $fillable = [
        'read', 'reply'
    ];

    public function unreadList()
    {
        return $this->whereRead(false)
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->select(['id', 'name', 'created_at'])->get();
    }
}
