<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Grafico;

class ChartsController extends Controller
{
    public function line()
    {
   		return view('charts.line');
    }

    public function graficojsonbar()
    {
    	$graficoPorMes = DB::table('graficos')
					->select(DB::raw('sum(quantidade) as quantidade'), DB::raw('MONTH(created_at) as mes'))
					->groupBy('mes')
					->get();
   		return $graficoPorMes;
    }

    public function graficojsonline($mes)
    {
    	$graficoDiasPorMes = DB::table('graficos')
					->select(DB::raw('quantidade'), DB::raw('DAY(created_at) as dia'), DB::raw('MONTH(created_at) as mes'))
					->where(DB::raw('MONTH(created_at)'), '=', $mes)
					->get();
   		return $graficoDiasPorMes;
    }
}
   

