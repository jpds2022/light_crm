<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fluxo_op extends Model
{
    use HasFactory;
    protected $table='fluxo_op';
    protected $primaryKey='id_fluxo_op';
    public $incrementing = false;
}
