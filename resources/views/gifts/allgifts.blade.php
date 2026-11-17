@extends('layouts.fo')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- Funcional
    <h1>Todas as Prendas aqui</h1>
    <h6>Prendas sem estarem carregadas na BD</h6>
        <ul>
            @foreach ($giftsWDB as $gift)
            <li>{{$gift['gift_name']}}-->{{$gift['user_id']}}</li>
            @endforeach
        </ul> --}}

    <h1 style="text-align: center;">Prendas da base de dados</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Prenda</th>
                <th scope="col" class="text-center">Valor Previsto (€)</th>
                <th scope="col" class="text-center">Valor Gasto (€)</th>
                <th scope="col" class="text-center">Diferença (€)</th>
                <th scope="col" class="text-center">Pessoa</th>
                <th scope="col" class="text-center" colspan="2"> Opções</th> {{-- coluna ver/editar + coluna apagar juntas --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($gifts as $gift)
                {{-- Calculo feito no backend da pagina --}}
                @php
                    $diff = $gift->estimated_price - $gift->price_paid;
                @endphp
                <tr>
                    <th scope="row" class="text-center">{{ $gift->id }}</th>
                    <td class="text-center">{{ $gift->gift_name }}</td>
                    <td class="text-center">{{ $gift->estimated_price }}</td>
                    <td class="text-center">{{ $gift->price_paid }}</td>
                    <td class="text-center {{ $diff >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($diff, 2, ',', '.') }}</td>
                    <td class="text-center">{{ $gift->user_name }}</td>
                    <td><a href="{{ route('gifts.edit', $gift->id) }}" class="btn btn-info">Ver/Editar</a></td>
                    <td><a href="{{ route('gifts.delete', $gift->id) }}" class="btn btn-danger">Apagar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center my-4">
        <a href="{{ route('gifts.add') }}" class="btn btn-warning btn-lg">Adicionar Prenda</a>
    </div>
@endsection
