@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Lista de Gráficos</h1>

<div class="row">
    <div class="col-lg-6">
        <a href="/charts/barra">
            <img alt="imagem gráfico de linha" src="{{asset('img/img_graf_barras.jpg')}}" class="img-responsive img-thumbnail" />
            <div class="text-center">Gráfico de Barra</div>
        </a>
    </div>

    <div class="col-lg-6">
        <a href="/charts/linha">
            <img alt="imagem gráfico de linha" src="{{asset('img/img_graf_linhas.jpg')}}" class="img-responsive img-thumbnail" />
            <div class="text-center">Gráfico de Linha</div>
        </a>
    </div>
    </div>
@endsection