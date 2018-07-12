@php
    $consultas = isset($consultas_realizadas) ? $consultas_realizadas : [];
@endphp
@extends('base_layout')
@section('content')
    <div  id="consultar_cnpj_wrapper" class="text-center jumbotron">
        <h1 class="display-4">Consulte no Sintegra</h1>
        <hr>
        <div id="consulta_sintegra_wrapper" class="input-group input-group-lg mb-3">

            {!! 
                Form::text('cnpj_empresa','',[
                    "placeholder"=>"00.000.000/0000-00",
                    "id"=>"txt_cnpj_empresa",
                    "required"=>"true",
                    'class'=>"form-control",
                    "aria-describedby"=>"consultar_cnpj",
                    "aria-label"=>"00.000.000/0000-00"
                ])
            !!}
            
            <div class="input-group-append">
                <button id="btn_consultar_cnpj" class="btn btn-primary orange-component">Consultar</button>
            </div>
        </div>
        {!! Form::label(
            "",
            "", [
                'id'=>'cnpj_empresa_error_label',
                'class'=>'label invalid-feedback error_label'
            ])
        !!}
        @include('consultas.content',["consultas_realizadas" => $consultas])
        
    </div>
@endsection
@section('footer')
    {!! Html::script('js/home.js') !!}
@endsection