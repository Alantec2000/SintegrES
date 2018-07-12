<div id="consulta_cnpj_content" class="card">
    <div class="card-header">
        <h3 class="align-middle">CNPJs Consultados!</h3>
    </div>
    <div class="card-body">
		@if (isset($consultas_realizadas) && sizeof($consultas_realizadas) > 0)
			@include("consultas.tabela",["consultas_realizadas"=>$consultas_realizadas])
		@else
			<h2>Nenhuma consulta realizada até o momento!</h2>
		@endif
    </div>
</div>