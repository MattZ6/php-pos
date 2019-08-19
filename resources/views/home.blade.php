@extends('layouts.app')

@section('content')

<page tamanho="8">
    <panel titulo="Bem-vindo(a)!">

            <div class="row">

              <div class="col-md-6">
                <box qtd={{ $projects }} titulo="Projetos" icone="ion ion-document" url="{{ route('projects.index') }}" cor="orange"></box>
              </div>
              <div class="col-md-6">
                <box qtd={{ $projects }} titulo="Tarefas" icone="ion ion-pricetag" url="{{ route('tasks.index') }}" cor="rebeccapurple"></box>
              </div>
            </div>
          </panel>
</page>
@endsection
