<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OP extends Model
{
    use HasFactory;
    protected $table='ops';
    protected $primaryKey='id_op';
    public $incrementing = false;
}
