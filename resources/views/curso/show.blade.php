@extends('templates.main')

@section('content')


   <div class="card mt-3">
  <div class="card-header">
  <b>{{$curso->nome}}</b> ({{$curso->abreviatura}})

  </div>
  <div class="card-body">
    <h5 class="card-title">Informações do Curso</h5>
    <p class="card-text">
      <b>Duração: </b> {{$curso->duracao}} 
    </p>
    <p class="card-text">
          <b>Eixo: </b> {{$curso->eixo->name}} 
    </p>
    <a href="{{route('curso.index')}}" class="btn btn-primary">
    
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        Voltar
    </a>
  </div>
</div>
  
@endsection