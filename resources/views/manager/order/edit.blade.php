@extends('layouts.app')

@section('content')
<div class="container">
  <form class="" action="{{ route('manager.order.update', $id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    {{-- Почта клиента --}}
    <div class="form-group">
      <label for="client_email">E-mail клиента</label>
      <input type="text" class="form-control" name="client_email"
      @if (isset( $client_email ))
        value="{{ $client_email }}"
      @endif />
    </div>
    {{-- Партнёр --}}
    <div class="form-group">
      <label for="partner_id">Партнёр</label>
      <select class="form-control" name="partner_id">
        @foreach ($partners as $partner)
          <option value="{{ $partner->id }}"
            @if ($partner->id == $partner_id)
            selected
          @endif>{{ $partner->name }}</option>
        @endforeach
      </select>
      {{-- <input type="text" class="form-control" name="partner"
      @if (isset( $partner_name ))
        value="{{ $partner_name }}"
      @endif /> --}}
    </div>
    {{-- Продукты --}}
    <div class="form-group">
      <h4>Состав заказа</h4>
      <table class="table">
        <head>
          <td>Наименование</td>
          <td>Количество</td>
        </head>
        <body>
          @foreach ($products as $key => $product)
            <tr>
              <td>
                {{ $product->name }}
              </td>
              <td>
                {{ $product->quantity }}
              </td>
            </tr>
          @endforeach
        </body>
      </table>
    </div>
    {{-- Статус заказа --}}
    <div class="form-group">
      <label for="status">Статус заказа</label>
      <select class="form-control" name="status">
        <option value="0"
        @if ($status == 0)
          selected
        @endif
        >Новый</option>
        <option value="10"
        @if ($status == 10)
          selected
        @endif>Подтверждён</option>
        <option value="20"
        @if ($status == 20)
          selected
        @endif>Завершён</option>
      </select>
    </div>
    <h4>Стоимость заказа: <b>{{ $products->pluck('total')->sum() }}</b> &#8381;</h4>
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <input class="btn btn-primary" type="submit" value="Сохранить">
  </form>
</div>
@endsection
