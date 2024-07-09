<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    use HasFactory;

    protected $table = 'users'; // Sesuaikan dengan nama tabel yang digunakan (default: users)
    protected $primaryKey = 'id'; // Sesuaikan dengan nama primary key yang digunakan (default: id)
    protected $fillable = [
        // Isi dengan kolom-kolom yang dapat diisi
        'name', 'email', 'password', 'role',
    ];

    // Jika tidak memerlukan timestamp created_at dan updated_at
    public $timestamps = false;
}
