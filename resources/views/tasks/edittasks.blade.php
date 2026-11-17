@extends('layouts.fo')

@section('content')
    <h6>Tarefas da base de dados {{ $taskInfo->name }}</h6>
    <p>{{ $taskInfo->confirmed }}</p>
    <p>{{ $taskInfo->due_at }}</p>
    <p>{{ $taskInfo->user }}</p>
@endsection
