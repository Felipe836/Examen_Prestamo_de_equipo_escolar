<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'address', 'role'];

    protected $hidden = ['password', 'remember_token'];

    public function loans() {
        return $this->hasMany(Loan::class);
    }

    public function incidents() {
        return $this->hasMany(Incident::class);
    }

    public function isEncargado(): bool {
        return $this->role === 'encargado';
    }

    public function isSolicitante(): bool {
        return $this->role === 'solicitante';
    }
}