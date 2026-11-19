@extends('layouts.fo')

@section('content')

<h1><a href="{{ route('home') }}">Voltar à Home!</a></h1>



{{-- não precisa do auth aqui --}}
    {{-- @auth --}}
        <h6>Olá {{Auth::user()->name}}!</h6>
    {{-- @endauth --}}


{{-- versão anterior --}}
    {{-- @if (Auth::user() && Auth::user()->email =='admin@gmail.com') --}}


    {{-- update --}}
  @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
    <div class="alert alert-success">
        tens super poderes    </div>


    @endif



{{-- versão anterior --}}
{{-- <div class="alert alert-success" role="alert">
  Conta de Administrador!
</div>

    @endif --}}



@endsection
