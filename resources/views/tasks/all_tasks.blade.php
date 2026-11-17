@extends('layouts.fo')

@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

    <h1>Todas as tarefas aqui</h1>
    {{-- <h6>Tarefas sem estarem carregadas na BD</h6>
        <ul>
            @foreach ($tasksWDB as $task)
            <li>{{$task['name']}}-->{{$task['user_id']}}</li>
            @endforeach
        </ul> --}}


    <h6>Tarefas da base de dados</h6>
<table class="table">
<thead>
<tr>
    <th scope="col">#</th>

<th scope="col">Nome</th>
<th scope="col">Estado</th>
<th scope="col">Data de Conclusão</th>
<th scope="col">Utilizador</th>
                <th></th> {{-- //coluna ver/editar --}}
                <th></th> {{-- //coluna apagar --}}
</tr>
</thead>
<tbody>
    @foreach ($getAllTasks as $tasks)
<tr>
<th scope="row">{{$tasks->id}}</th>
<td>{{$tasks->name}}</td>
<td>{{$tasks->description}}</td>
<td>{{$tasks->due_at}}</td>
<td>{{$tasks->user_id}}</td>
        <td><a href="{{route('tasks.edit', $tasks->id)}}" class="btn btn-info">Ver /  Editar</a></td>
        <td><a href="{{route('tasks.delete', $tasks->id )}}" class="btn btn-danger">Apagar</a></td>
</tr>
    @endforeach



</tbody>
</table>

@endsection

{{-- //correcçao da sara --}}

{{-- @extends('layouts.fo')

@section('content')
    <h6>Tarefas da base de dados</h6>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Estado</th>
                <th scope="col">Data de conclusão</th>
                <th scope="col">Utilizador</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $user->due_at }}</td>
                    <td>{{ $user->user_id }}</td>
                </tr>
            @endforeach


        </tbody>
    </table>
@endsection










@endsection --}}
