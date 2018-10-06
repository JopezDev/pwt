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
        return $this->date->format('m/d/y H:i');
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
        if($number === 0)
            return '';

        return (self::isGain($number)) ? $posClass : $negClass;
    }

    public static function totalGain() {
        $temp = [];
        self::all()->each(function($stat) use (&$temp) {
            $temp[$stat->date->format('Ymd')][] = $stat->net_gain;
        });

        $sum = 0;
        foreach($temp as $dateGroup)
            $sum += array_last($dateGroup);

        return $sum;
    }

    public static function formatTotalGain() {
        return self::_toDollar(self::totalGain());
    }

    public static function isGain($number) {
        return $number > 0;
    }

    private static function _toDollar($number) {
        return '$' . number_format($number, 2);
    }
}
