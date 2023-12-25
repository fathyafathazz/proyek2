<?php

namespace App\Helpers;

class FormatHelper
{
    public static function formatRupiah($harga)
    {
        return 'Rp ' . number_format($harga, 0, ',', '.');
    }
}