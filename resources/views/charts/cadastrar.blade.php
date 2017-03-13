@extends('layouts.layout')

@section('content')
    <h1 class="jumbotron">Cadastrar Produção</h1>
    <form method="post" action="/charts">
    	{{ csrf_field() }}
	    <div class="col-md-5">
			<div class="form-group">	    	
		    	<label for="quantidade">Quantidade</label>
		    	<input type="text" id="quantidade" name="quantidade" class="form-control"/>
		    </div>
	    </div>
	    <div class="col-md-2">
			<div class="form-group">	
				<label>&nbsp;</label>    	
		    	<input type="submit" class="form-control" value="Gravar"/>
		    </div>
	    </div>
    </form>
@endsection

@section('footer')
<script>

</script>
@endsection