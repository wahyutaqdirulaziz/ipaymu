<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kariawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    protected $fillable = [ 'id','name', 'pekerjaan','created_at'];
    public $incrementing = false;
}
