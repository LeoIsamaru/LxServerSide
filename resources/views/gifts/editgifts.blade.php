@extends('layouts.fo')

@section('content')
    <h6 style="text-align: center;">Editar Prenda: {{ $giftInfo->gift_name }}</h6>

    <form method="POST" action="{{ route('gifts.update', $giftInfo->id) }}">
        @method('PUT')
        @csrf

        {{-- ================================ Área Nome da Prenda ================================ --}}
        
        <input type="hidden" name="id" value="{{ $giftInfo->id }}">
        <div class="mb-3">
            <label for="gift_name" class="form-label">Nome da Prenda</label>
            <input value="{{ old('gift_name', $giftInfo->gift_name) }}" required type="text" name="gift_name"
                id="gift_name" class="form-control">
        </div>
        @error('gift_name')
            <p class="text-danger fw-bold">Nome da prenda inválido</p>
        @enderror


        {{-- ================================ Área Valor Previsto ================================ --}}

        <div class="mb-3">
            <label for="estimated_price" class="form-label">Valor Previsto (€)</label>
            <input required type="text" name="estimated_price" id="estimated_price" class="form-control"
                inputmode="decimal" pattern="^\d+(\.\d{1,2})?$"
                title="Usa o ponto como separador decimal, por exemplo 8.50"
                value="{{ old('estimated_price', $giftInfo->estimated_price) }}">
        </div>
        @error('estimated_price')
            <p class="text-danger fw-bold">Valor previsto inválido (usa o ponto, ex.: 8.50)</p>
        @enderror


        {{-- ================================ Área Valor Gasto ================================ --}}

        <div class="mb-3">
            <label for="price_paid" class="form-label">Valor Gasto (€)</label>
            <input required type="text" name="price_paid" id="price_paid" class="form-control"
                inputmode="decimal" pattern="^\d+(\.\d{1,2})?$"
                title="Usa o ponto como separador decimal, por exemplo 10.50"
                value="{{ old('price_paid', $giftInfo->price_paid) }}">
        </div>
        @error('price_paid')
            <p class="text-danger fw-bold">Valor gasto inválido (usa o ponto, ex.: 10.50)</p>
        @enderror


        {{-- ================================ Área Pessoa ================================ --}}

        <div class="mb-3">
            <label for="user_id" class="form-label">Pessoa</label>
            <select name="user_id" id="user_id" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id', $giftInfo->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('user_id')
            <p class="text-danger fw-bold">Pessoa inválida</p>
        @enderror


        {{-- ================================ Botão Atualizar ================================ --}}

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
