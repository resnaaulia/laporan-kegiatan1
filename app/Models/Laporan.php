<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan'; // wajib kalau tabelnya singular

   protected $fillable = [
    'user_id',
    'tanggal',
    'kegiatan',
    'keterangan',
    'file',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
