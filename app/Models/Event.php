<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'nama',
        'tanggal',
        'tempat',
        'harga',
       'deskripsi_event',
        'poster',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
