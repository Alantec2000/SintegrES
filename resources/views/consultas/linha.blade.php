@php
    use App\TextUtils;
@endphp
<tr>
	<td class="align-middle">
		{{$json->razao_social}}
	</td>
	<td class="align-middle">
		{{TextUtils::formatar(TextUtils::CNPJ_MASK, $json->cnpj)}}
	</td>
	<td class="align-middle">
		{{date("d/m/Y H:m:s",strtotime($consulta['created_at']))}}
	</td>
	<td class="align-middle">
		<a class="btn btn-info" href='{{url("consulta/get/{$consulta['id']}")}}'>
			<i class="glyphicons glyphicons-glass"></i>
			Detalhes
		</a>
	</td>
	<td class="align-middle">
		<a class="btn btn-danger" href='{{url("consulta/delete/{$consulta["id"]}")}}'>
			X
		</a>
	</td>
</tr>