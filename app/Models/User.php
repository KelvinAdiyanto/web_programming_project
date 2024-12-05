<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'user';

    /**
     * Get all of the tabungan and transaksi for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tabungan(): HasMany
    {
        return $this->hasMany(Tabungan::class);
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
