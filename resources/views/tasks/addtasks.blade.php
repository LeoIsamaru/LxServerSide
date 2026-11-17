@extends('layouts.fo')

@section('content')
    <h1>Adicionar tarefa</h1>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input required type="text" name="name" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        @error('name')
            <p>Nome inválido</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Descrição</label>
            <input required type="text" name="description" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        @error('description')
            <p>Descrição inválida</p>
        @enderror



        {{-- minha versão...não 100% pois mostra os user inseridos manualmente (em vez de os ir buscar há tabela) --}}
        {{-- <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">User ID</label> --}}
            {{-- <input required type="text" name="user_id" class="form-control" id="exampleInputPassword1"> --}}

        {{-- <select class="form-select" aria-label="Default select example" name="user_id">
            <option selected>Escolhe o user</option>
            <option value="1">Leo</option>
            <option value="4">Sus</option>
            <option value="6">Joao</option>
            <option value="7">dadas</option>
            <option value="8">Biana</option>
        </select>
        </div>
        @error('user_id')
            <p>User ID inválido</p>
        @enderror --}}






{{-- correcção da Sara --}}
<select name="user_id" class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach


        </select>







        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

