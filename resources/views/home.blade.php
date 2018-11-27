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
                            <h5 class="card-title"> {{ $post->name }}</h5>
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
                        <div class="input-group">
                            <input id="text" type="text" class="form-control" name="text" value="{{ old('text') }}" required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Postar!') }}
                                </button>
                            </span>     
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
