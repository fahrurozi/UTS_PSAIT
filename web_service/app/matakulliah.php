<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class matakulliah extends Model
{
    //
    // protected $primaryKey = null;
    protected $table = "matakuliah";
    public $timestamps = false;
    protected $fillable = [
        'kode_mk', 'nama_mk', 'sks'
    ];
}
