@extends('layouts.fo')

@section('content')
    <h1 style="text-align: center;">Adicionar Prendas</h1>
    <form method="POST" action="{{ route('gifts.store') }}">
        @csrf

        {{-- ================================ Área Nome da Prenda ================================ --}}

        <div class="mb-3">
            <label for="gift_name" class="form-label">Prenda</label>
            <input required type="text" name="gift_name" id="gift_name" class="form-control"
                value="{{ old('gift_name') }}">
        </div>
        @error('gift_name')
            <p class="text-danger fw-bold">Nome inválido</p>
        @enderror


        {{-- ================================ Área Valor Previsto ================================ --}}

        <div class="mb-3">
            <label for="estimated_price" class="form-label">Valor Previsto (€)</label>
            <input required type="text" name="estimated_price" id="estimated_price" class="form-control"
                inputmode="decimal" pattern="^\d+(\.\d{1,2})?$"
                title="Usa o ponto como separador decimal, por exemplo 8.50"
                placeholder="8.00" value="{{ old('estimated_price') }}"> {{-- value=old -> re-escreve o valor em caso de erro, assim não o user não precisa de escrever tudo novamente --}}
        </div>
        @error('estimated_price')
            <p class="text-danger fw-bold">Preço inválido (usa o ponto, ex.: 8.50)</p>
        @enderror


        {{-- ================================ Área Valor Gasto ================================ --}}

        <div class="mb-3">
            <label for="price_paid" class="form-label">Valor Gasto (€)</label>
            <input required type="text" name="price_paid" id="price_paid" class="form-control"
                inputmode="decimal" pattern="^\d+(\.\d{1,2})?$"
                title="Usa o ponto como separador decimal, por exemplo 10.50"
                placeholder="10.00" value="{{ old('price_paid') }}">
        </div>
        @error('price_paid')
            <p class="text-danger fw-bold">Preço inválido (usa o ponto, ex.: 10.50)</p>
        @enderror


        {{-- ================================ Área Pessoa ================================ --}}

        <div class="mb-3">
            <label for="user_id" class="form-label">Pessoa</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="" disabled {{ old('user_id') ? '' : 'selected' }}>Escolhe uma pessoa</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('user_id')
            <p class="text-danger fw-bold">Pessoa inválida</p>
        @enderror


        {{-- ================================ Botão Adicionar ================================ --}}
        
        <div class="text-center my-4">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </form>
@endsection
