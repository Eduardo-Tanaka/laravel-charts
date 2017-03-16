<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Grafico;

class ChartsController extends Controller
{
	public function index() 
	{
		return view('charts.index');
	}

    public function barra()
    {
   		return view('charts.barra');
    }

    public function linha()
    {
   		return view('charts.linha');
    }

    public function cadastrar()
    {
   		return view('charts.cadastrar');
    }

    public function gravar()
    {
    	//dd(request()->all());
    	//dd(request('dia'));

    	Grafico::Create([
    		'quantidade' => request('quantidade')
    	]);

   		return redirect('/charts/index');
    }

    public function show($mes)
    {
   		return view('charts.show', ['mes' => $mes]);
    }

    public function edit($id, $value)
    {
    	//dd($id, $quantidade);

   		DB::table('graficos')
	        ->where('id', $id)
	        ->update(['quantidade' => $value]);
	    return $value;
    }

    public function graficojsonbar()
    {
    	$graficoPorMes = DB::table('graficos')
					->select(DB::raw('sum(quantidade) as quantidade'), DB::raw('MONTH(created_at) as mes'))
					->groupBy('mes')
					->orderBy('mes')
					->get();
   		return $graficoPorMes;
    }

    public function graficojsonline($mes)
    {
    	$graficoDiasPorMes = DB::table('graficos')
					->select(DB::raw('id'), DB::raw('quantidade'), DB::raw('DAY(created_at) as dia'), DB::raw('MONTH(created_at) as mes'))
					->where(DB::raw('MONTH(created_at)'), '=', $mes)
					->orderBy('dia')
					->get();
   		return $graficoDiasPorMes;
    }
}
   

