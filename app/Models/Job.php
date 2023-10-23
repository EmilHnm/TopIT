<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Job extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'id',
        'title',
        'position',
        'bussiness_account_id',
        'description',
        'type',
        'end_date',
    ];


    public function poster() {
        return $this->belongsTo(BussinessAccount::class, 'bussiness_account_id');
    }
}
