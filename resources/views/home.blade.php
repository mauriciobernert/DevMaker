@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Posts
                    @if ($favs)
                        <a href="{{ route('home') }}"><i class="fas fa-star"></i></a>
                    @else 
                        <a href="{{ route('favs') }}"><i class="far fa-star"></i></a>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($list as $post)

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $post->title }} de {{ $post->name }}</h5>
                            <p class="card-text">
                                    {{ $post->text }}
                            </p>
                            {{-- {{$post->id}} --}}
                            <a href="{{ route('fav', $post->id) }}"><i class="{{$post->is_user?'fas':'far'}} fa-star"></i></a>
                        </div>
                    </div>
                    @empty
                        <p>Ops, não encontramos nenhum post {{$favs?'favorito': ''}}... </p>
                    @endforelse
                    
                </div>
            </div>
            <div class="card">
                <form method="POST" action="{{ route('new') }}">
                    @csrf
                    <div class="card-header">Crie seu post!</div>

                    <div class="card-body">
                        {{-- <div class="input-group"> --}}
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Título</span>
                                </div>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                                    
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Seu texto</span>
                                </div>
                                <textarea id="text" name="text" value="{{ old('text') }}" class="form-control" aria-label="With textarea"></textarea>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary col-md-4 offset-md-4 ">
                                        {{ __('Postar!') }}
                                </button>
                            </div>     
                        {{-- </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
