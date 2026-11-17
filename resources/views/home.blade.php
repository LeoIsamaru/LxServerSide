{{-- @php

@endphp --}}


@extends('layouts.fo')

@section('content')

<img src="{{asset('images/cats.jpg')}}" alt="">


{{-- este if apenas dentro da blade --}}
{{--     @if (isset(  $courseName)) --}} {{-- isset (is set) = se a variavel estiver definida --}}
{{--         <h5>Olá {{$courseName}}</h5>
    @else
        <h5>Olá user</h5>
    @endif  --}}

{{-- em modo ternario: --}}
    <h5>Olá {{isset($courseName)? $courseName : 'user' }}</h5>
<h6>O contacto é o {{$contactInfo['name']}} - {{$contactInfo['contact']}}</h6>

<h5>Alunos da turma</h5>
    <ul>
        @if (isset($students))
            @foreach ($students as $student)
                <li>{{ $student }}</li>
            @endforeach
        @endif
    </ul>

    <h6>O grupo é o {{$cesaeInfo['name']}} , morada {{$cesaeInfo['address']}} e o contacto é {{$cesaeInfo['email']}}</h6>


    <h5>Funcionalidades da nossa app</h5>
    {{-- <ul><a href="/">Welcome Page</a></ul> --}}

    <ul>
        <li><a href="{{ route('welcome') }}">Welcome Page</a></li>{{-- para chamar o nome da rota --}}
        <li><a href="{{ route('users.all') }}">Utilizadores</a></li>
        <li><a href="{{ route('users.add') }}">Adicionar Utilizadores</a></li>
        <li><a href="{{ route('tasks.all') }}">Todas as tarefas</a></li>
        <li><a href="{{ route('tasks.add') }}">Adicionar Tarefas</a></li>
        <li><a href="{{ route('gifts.all') }}">Todas as Prendas</a></li>
        <li><a href="{{ route('gifts.add') }}">Adicionar Prendas</a></li>

    </ul>
@endsection
