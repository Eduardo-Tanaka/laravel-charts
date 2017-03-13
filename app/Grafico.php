<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grafico extends Model
{
	// protected $guarded = []; // aceita tudo menos o que estiver no array
    protected $fillable = ['quantidade']; // aceita somente os campos dentro do array
}
