<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = "pasien";

    protected $fillable = ['nama', 'tanggalLahir', 'usia', 'jenisKelamin', 'alamat', 'no', 'email'];

    public function registrasi()
    {
        return $this->hasMany(Registrasi::class);
    }

    public function getUsiaAttribute()
    {
        $tanggalLahir = Carbon::parse($this->tanggalLahir); // Ambil tanggal lahir dari kolom
        $usiaTahun = $tanggalLahir->diffInYears(Carbon::now());

        if ($usiaTahun >= 1) {
            return $usiaTahun . ' tahun';
        } else {
            $usiaBulan = $tanggalLahir->diffInMonths(Carbon::now());
            if ($usiaBulan >= 1) {
                return $usiaBulan . ' bulan';
            } else {
                $usiaHari = $tanggalLahir->diffInDays(Carbon::now());
                return $usiaHari . ' hari';
            }
        }
    }
}
