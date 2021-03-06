<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{

    protected $table = 'jadwal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pembuat', 'judul', 'kelas'
    ];

    public function jadwalGambar()
    {
        return $this->hasMany(JadwalGambar::class);
    }

}
