<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perkuliahan extends Model
{
    //
    protected $table = "perkuliahan";
    public $timestamps = false;
    protected $fillable = [
        'nim', 'kode_mk', 'nilai'
    ];
    protected $primaryKey = 'id_perkuliahan';
}
