@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner1.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner2.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner3.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner4.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner5.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner6.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner7.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/Banner8.jpg') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/game.png') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/safe.png') }}" class="img-fluid rounded">
            </a>
        </div>
        <div class="col-md-6 col-lg-3 mb-2">
            <a href="{{ route('product.index') }}">
                <img src="{{ asset('/img/submarine.png') }}" class="img-fluid rounded">
            </a>
        </div>
    </div>
@endsection
