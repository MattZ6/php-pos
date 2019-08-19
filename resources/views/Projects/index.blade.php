@extends('layouts.app')

@section('content')

<page tamanho="12">
{{-- exibir erros--}}
@if ($errors->all())
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

@foreach ( $errors->all() as $key => $value )
  <li>{{$value}}</li>
@endforeach


    </div>
    @endif


    <panel titulo="Dashboard">
        <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

          <table-list
          v-bind:titulos="['#','Nome','Descrição']"
          v-bind:itens="{{$listaDados}}"
          criar="#criar"  detalhe="/projects/" editar="/projects/"  deletar="/projects/" token="{{ csrf_token() }}" ordem="asc" ordemCol="0"
          modal="sim"

          ></table-list>


        </panel>
      </page>

        <modal nome="meumodal" titulo="Adicionar">
            {{-- tem que dar um id ao form para relacionar ao button que esta no slot  --}}
                <formulario id="formadd" css="" action="{{route( 'projects.store'  )}}" method="post" token="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name"  value="{{old('name')}}" placeholder="Nome do projeto">
                        </div>
                        <div class="form-group">
                          <label for="description">Descrição</label>
                          <input type="text" class="form-control" id="description" value="{{old('description')}}" name="description" placeholder="Um pouco sobre o projeto">
                          </div>

                            </formulario>
                            {{-- button no slot deve receber o form com o id  --}}
	 <span slot="addbutton">
      <button form="formadd" class="btn btn-primary" type="submit">Adicionar</button>
   </span>
  </modal>

  <modal nome="editar" titulo="Editar">

      <formulario id="formEdit" v-bind:action="'/projects/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">

        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome do projeto">
        </div>
        <div class="form-group">
          <label for="description">Descrição</label>
          <input type="text" class="form-control" id="description" name="description" v-model="$store.state.item.description" placeholder="Um pouco sobre o projeto">
        </div>

        </formulario>
          <span slot="addbutton">
         <button form="formEdit" class="btn btn-primary">Editar</button>
        </span>

  </modal>



  <modal nome="detalhe" titulo="Descrição">
      <panel v-bind:titulo="$store.state.item.name">


      <p>@{{$store.state.item.description}}</p>
      </panel>
      </modal>
@endsection
