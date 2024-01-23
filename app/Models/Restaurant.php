<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'piva',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typology()
    {
        return $this->belongsToMany(Typology::class);
    }
}
