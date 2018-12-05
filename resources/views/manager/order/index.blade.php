@extends('layouts.app')

@section('content')
<div class="container">
  <table class="table">
    <thead>
      @foreach ($headers as $header)
        <th>{{ $header }}</th>
      @endforeach
    </thead>
    <tbody>
      @foreach ($orders as $order)
        <tr>
          {{-- Ссылка на редактирование записи --}}
          <td>
            <a href="{{ route('manager.order.edit', $order['id']) }}">{{ $order['id'] }}</a>
          </td>
          <td>
            {{ $order['partner']['name'] }}
          </td>
          {{-- Сумма заказа --}}
          <td>
            {{ $order['products']->pluck('total')->sum() }}
          </td>
          {{-- Состав заказа --}}
          <td>
            {{ $order['products']->pluck('name')->implode(', ') }}
          </td>
          <td>
            {{ $order['status'] }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
{{ $orders->links() }}
</div>
@endsection
