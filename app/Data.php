<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'app';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    public function formatDate() {
        return $this->date->format('F d, Y');
    }

    public function formatBankRole() {
        return self::_toDollar($this->bank_role);
    }

    public function formatWinnings() {
        return self::_toDollar($this->winnings);
    }

    public function formatNetGain() {
        return self::_toDollar($this->net_gain);
    }

    public static function cssClass($number, $posClass = 'text-success', $negClass = 'text-danger') {
        return (self::isGain($number)) ? $posClass : $negClass;
    }

    public static function totalGain() {
        return self::all()->sum('net_gain');
    }

    public static function formateTotalGain() {
        return self::_toDollar(self::totalGain());
    }

    public static function isGain($number) {
        return $number > 0;
    }

    private static function _toDollar($number) {
        return '$' . number_format($number, 2);
    }
}
