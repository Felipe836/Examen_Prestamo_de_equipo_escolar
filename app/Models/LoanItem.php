<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model {
    protected $fillable = ['loan_id', 'equipment_id', 'quantity'];

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }
}