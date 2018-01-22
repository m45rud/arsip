<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('indo_date')) {
    function indo_date($str) {
        if (!is_valid_date($str)) return NULL;
        $exp = explode("-", $str);
        return $exp[2] . ' ' . bulan($exp[1]) . ' ' . $exp[0];
    }
}

if (!function_exists('bulan')) {
    function bulan($kode, $type = 'L') {
        $bulan = '';
        switch ($kode) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Mei';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'Nopember';
                break;
            case '12':
                $bulan = 'Desember';
                break;
        }
        if ($type != 'L') {
            return substr($bulan, 0, 3);
        }
        return $bulan;
    }
}
