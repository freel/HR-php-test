@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
      @guest
        <h5>Для использования функций менеджера необходимо зарегистрироваться и войти</h5>
      @else
        <h5>Добро пожаловать.</h5>
      @endguest
    </div>
</div>
@endsection
