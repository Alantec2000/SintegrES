@php
	use App\TextUtils;
@endphp
@extends('base_layout')
@section('content')
	@if (isset($empresa))
		<div id="detalhes_empresa_wrapper" class="card">
			<div id="detalhes_empresa_header" class="card-header">
				<h4>
					<b>Empresa:</b> {{$empresa->json->razao_social}}
				</h4>
			</div>
			<div class="card-body">
				
				<div id="detalhes_empresa_body">
					<div id="detalhes_empresa_informacao_pessoal" class="row">
						<div class="label-detalhe-empresa col-5">
							<span class="label-detalhe-empresa">
								CNPJ:
							</span> 
							{{TextUtils::formatar(TextUtils::CNPJ_MASK, $empresa->json->cnpj)}}
						</div>
						<div class="label-detalhe-empresa col">
							<span class="label-detalhe-empresa">
								Inscrição Estadual: 
							</span>
							{{TextUtils::formatar(TextUtils::INSCRICAO_ESTADUAL_MASK, $empresa->json->inscricao_estadual)}}
						</div>
					</div>
					<hr>
					<div id="detalhes_empresa_localizacao_contato">
						
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">Logradouro:</span> 
								{{$empresa->json->logradouro}}
							</div>
						</div>
						
						<div class="row">
							<div class="col-2">
								<span class="label-detalhe-empresa">
									Número:
								</span>
								{{$empresa->json->numero}}
							</div>
							<div class="col">
								<span class="label-detalhe-empresa">
									Complemento:
								</span>
								{{$empresa->json->complemento}}
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Bairro:
								</span>
								{{$empresa->json->bairro}}
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Município:
								</span>
								{{$empresa->json->municipio}}
							</div>
							<div class="col">
								<span class="label-detalhe-empresa">
									Estado:
								</span>
								{{$empresa->json->uf}}
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									CEP:
								</span>
								{{TextUtils::formatar(TextUtils::CEP_MASK, $empresa->json->cep)}}
							</div>
							<div class="col">
								<span class="label-detalhe-empresa">
									Telefone:
								</span>
								{{$empresa->json->telefone}}
							</div>
						</div>
					</div>
					<hr>
					<div id="detalhes_empresa_informacao_complementar" class="">
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Atividade Econômica:
								</span>
								{{$empresa->json->atividade_economica}}
							</div>
						</div>
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Data de Inicio das Atividades:
								</span>
								{{date('d/m/Y', $empresa->json->data_inicio)}}
							</div>
						</div>
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Situação Cadastral Vigente:
								</span>
								{{$empresa->json->situacao_cadastral}}
							</div>
						</div>
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Data desta Situação Cadastral:
								</span>
								{{date('d/m/Y', $empresa->json->data_situacao_cadastral)}}
							</div>
						</div>
						<div class="row">
							<div class="col">
								<span class="label-detalhe-empresa">
									Regime de Apuração:
								</span>
								{{$empresa->json->regime_apuracao}}
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div id="detalhes_empresa_footer_wrapper">
					<div class="float-right">
						<a href="{{url('/')}}">
							<button id="btn_voltar" class="btn btn-primary">
								Voltar
							</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	@else 
		<h1 class="card">
			<div class="card-body">
				Empresa selecionada não encontrada!
			</div>
		</h1>
	@endif
@endsection