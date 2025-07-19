<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Website extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'url'];

    public function subscribers()
    {
        return $this->hasMany(WebsiteSubscriber::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
