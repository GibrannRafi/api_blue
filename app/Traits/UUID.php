<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUID
{
    /**
     * Laravel akan otomatis menjalankan fungsi ini jika format namanya boot[NamaTrait]
     * Hapus parent::boot() agar tidak terjadi infinite loop (memori jebol).
     */
    protected static function bootUUID()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Menonaktifkan auto-increment karena kita menggunakan string UUID.
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Nama fungsi yang benar adalah getKeyType (bukan getTypeKey).
     * Ini penting agar Laravel tahu primary key kamu adalah string.
     */
    public function getKeyType()
    {
        return 'string';
    }
}
