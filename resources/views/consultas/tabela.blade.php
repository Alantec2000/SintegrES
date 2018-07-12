<table id="tabela_consultas_sintegres" class="table table-bordered table-hover" border="1">
	<thead id="thead_consultas_sintegres" class="thead-dark">
		<th>Empresa</th>
		<th>CNPJ</th>
		<th>Consultada em</th>
		<th>#</th>
		<th>#</th>
	</thead>
	<tbody id="tbody_consultas_sintegres">
		@foreach ($consultas_realizadas as $consulta)
			@include('consultas.linha',['consulta'=>$consulta, "json"=>$consulta['json']])
		@endforeach
	</tbody>
</table>