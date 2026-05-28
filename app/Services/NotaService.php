<?php
namespace App\Services;


class NotaService{

    public static function generate(){
        $prefix = 'CSR';
        $timestamp = now()->format('Ymd-His');

        return "{$prefix}-{$timestamp}";
    }

}