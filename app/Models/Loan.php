<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model {
    protected $fillable = ['folio', 'user_id', 'date_entrega', 'date_final', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(LoanItem::class);
    }

    public function incidents() {
        return $this->hasMany(Incident::class);
    }
}