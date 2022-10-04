<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class atividade extends Model
{
    use HasFactory;
    protected $table='atividades';
    protected $primaryKey='id_atividades';
    public $incrementing = false;
}
