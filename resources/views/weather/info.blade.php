@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-md-left">
    <div class="col col-lg-6">
      {{ $city }}
    </div>
  </div>
  <div class="row justify-content-md-left">
    <div class="col col-lg-3">
      Температура
    </div>
    <div class="col col-lg-3">
      {{ $temp }}
    </div>
  </div>
  <div class="row justify-content-md-left">
    <div class="col col-lg-3">
      Ощущается как
    </div>
    <div class="col col-lg-3">
      {{ $feels }}
    </div>
  </div>
  <div class="row justify-content-md-left">
    <div class="col col-lg-3">
      Ветер
    </div>
    <div class="col col-lg-3">
      {{ $wind }}
    </div>
  </div>
  <div class="row justify-content-md-left">
    <div class="col col-lg-3">
      Давление
    </div>
    <div class="col col-lg-3">
      {{ $humidity }}
    </div>
  </div>
</div>

@endsection
