<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model {
    protected $table = 'equipment';
    protected $fillable = ['category_id', 'name', 'total_quantity', 'available_quantity', 'specifications'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function loanItems() {
        return $this->hasMany(LoanItem::class);
    }

    public function incidents() {
        return $this->hasMany(Incident::class);
    }
}