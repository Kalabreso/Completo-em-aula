@extends('templates.main')

@section('content')

<form action="{{route('curso.store')}}" method="POST">
  @csrf
  <label class="mt-3">Nome</label>
  <input type="text" name="nome" class="form-control "/>
  <label class="mt-3">Abreviatura</label>
  <input type="text" name="abreviatura" class="form-control "/>
  <label class="mt-3">Duração (anos)</label>
  <input type="number" name="tempo" class="form-control "/>
  <select name="eixo" class="form-control mt-2">
    @foreach ($eixos as $item)
    <option selected disabled></option>
    <option value="{{$item->id}}">{{$item->name}}</option>
      @endforeach
  </select>
  <input type="submit" value="Salvar" class="btn btn-danger mt-2">
</form>

@endsection