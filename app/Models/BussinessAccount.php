<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class BussinessAccount extends Model
{
    use HasFactory, AsSource;

    public function root() {
        return $this->belongsTo(User::class);
    }
}
