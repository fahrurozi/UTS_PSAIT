<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    //
    // protected $primaryKey = null;
    protected $table = "mahasiswa";
    public $timestamps = false;
    protected $fillable = [
        'nim', 'nama', 'alamat', 'tanggal_lahir'
    ];
}
