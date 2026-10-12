<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model {
    protected $fillable = ['loan_id', 'equipment_id', 'user_id', 'damage', 'specifications', 'status'];

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}