<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Post extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';    

    protected $fillable = ['title', 'description'];

    protected $dispatchesEvents = [
        'created' => \App\Events\PostCreated::class,
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
