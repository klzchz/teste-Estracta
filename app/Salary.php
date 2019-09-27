<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
       'vigencia',
       'valor_mensal',
       'valor_diario',
       'valor_hora',
       'norma_legal',
       'dou'
    ];
}
