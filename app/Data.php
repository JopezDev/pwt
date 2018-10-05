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
        return $this->_toDollar($this->bank_role);
    }

    public function formatWinnings() {
        return $this->_toDollar($this->winnings);
    }

    public function formatNetGain() {
        return $this->_toDollar($this->net_gain);
    }

    private function _toDollar($number) {
        return '$' . number_format($number, 2);
    }


}
