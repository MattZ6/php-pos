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
            v-bind:titulos="['#','Titulo','Descrição','Concluída','Tipo']"
            v-bind:itens="{{ $listaDados }}"
            criar="#criar"  detalhe="/tasks/" editar="/tasks/"  deletar="/tasks/" token="{{ csrf_token() }}" ordem="asc" ordemCol="0"
            modal="sim"
          ></table-list>
        </panel>
      </page>

        <modal nome="meumodal" titulo="Adicionar">
            {{-- tem que dar um id ao form para relacionar ao button que esta no slot  --}}
                <formulario id="formadd" css="" action="{{route( 'tasks.store'  )}}" method="post" token="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="title">Nome</label>
                        <input type="text" class="form-control" name="title" id="title"  value="{{old('title')}}" placeholder="Título do projeto">
                    </div>

                    <div class="form-group">
                      <label   for="type">Tipo de tarefa</label>
                      <select class="form-control"  name="type" id="type">
                          <option value="1">👾 Bug</option>
                          <option value="2" > ✨ Feature</option>
                          <option value="3" >🔨 Melhoria</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="project_id">Projeto</label>
                      <select class="form-control"  name="project_id" id="project_id">
                          <option>Selecione um projeto</option>

                            @foreach ($projects as $project)
                              <option value="{{ $project->id }}">
                                  {{ $project->name }}
                                </option>
                            @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control" id="description" value="{{old('description')}}" name="description" placeholder="Um pouco sobre a tarefa">
                    </div>

                </formulario>
                            {{-- button no slot deve receber o form com o id  --}}
	 <span slot="addbutton">
      <button form="formadd" class="btn btn-primary" type="submit">Adicionar</button>
   </span>
  </modal>

  <modal nome="editar" titulo="Editar">

      <formulario id="formEdit" v-bind:action="'/tasks/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">

        <div class="form-group">
          <label for="title">Nome</label>
          <input type="text" class="form-control" id="title" name="title" v-model="$store.state.item.title" placeholder="Nome do projeto">
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
        <small style="opacity: 0.5;">TÍTULO</small>
        <p>@{{$store.state.item.title}}</p>

        <small style="opacity: 0.5;">DESCRIÇÃO</small>
        <p>@{{$store.state.item.description}}</p>

        <small style="opacity: 0.5;">PROJETO</small>
        <p>@{{$store.state.item.project_id}}</p>

        <small style="opacity: 0.5;">TIPO</small>
        <p>@{{$store.state.item.type}}</p>
  </modal>
@endsection
