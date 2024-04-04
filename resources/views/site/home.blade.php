@extends('site.layout')

@section('title', 'Página Home')

@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col sm-12">
            <h1 class="alert alert-info"> Lorem ipsum dolor sit amet consectetur adipisicing elit. </h1>
                <h4>Porro doloribus exercitationem deserunt nostrum aliquam iste ex sed iure ab assumenda optio fugiat,</h4>
                <p class="py-3">
                    perferendis autem earum qui consequuntur nemo fuga aspernatur?
                </p>
                <p>
                    @guest
                        
                    <a href="{{ route('login') }}" class="btn btn-outline-info">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Cadastre-se</a>
                    @endguest

                    @auth
                        
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                    @endauth

                </p>
        </div>
    </div>
</div>
    
@endsection