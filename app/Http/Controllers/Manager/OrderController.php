<?php

namespace App\Http\Controllers\Manager;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Partner;

class OrderController extends Controller
{
    /**
     * Отображает список всех заказов
     *
     * @var orders выборка из таблицы заказов, связанных с ними продуктов, партнёров, стоимости продуктов одного вида в корзине
     *   общая стоимость рассчитывается в view manager.order.index
     * @var headers заголовки таблицы
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Все необходимые поля
        $orders = Order::
          select('id', 'status', 'partner_id')
          ->with(['products' => function($query) {
            $query
              ->select('products.id', 'products.name', 'order_products.price', 'order_products.quantity', DB::raw('`order_products`.`price`*`order_products`.`quantity` AS `total`'));
          }])
          ->with(['partner' => function($query) {
              $query
                ->select('partners.id', 'partners.name');
          }])
          ->paginate(40);

        $headers = [
          'id' => 'ID',
          'partner.name' => 'Партнёр',
          'price' => 'Стоимость',
          'list' => 'Состав',
          'status' => 'Статус'];

        return view('manager.order.index', [
          'orders' => $orders,
          'headers' => $headers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @var edit_data данные для отображения в таблице редактирования
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $edit_data = [
          'id' => $order->id,
          'client_email' => $order->client_email,
          'partner_id' => $order->partner_id,
          'partners' => Partner::get(),
          'products' => $order->products()->select('name','quantity', DB::raw('`order_products`.`price`*`order_products`.`quantity` AS `total`'))->get(),
          'partner_name' => $order->partner->name,
          'status' => $order->status,
        ];

        return view('manager.order.edit', $edit_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // Валидация входных данных
        $this->validate($request, [
          'client_email' => 'required|email',
          'partner_id' => 'required|integer',
          'status' => 'required|integer|in:0,10,20'
        ]);

        // Сохранение изменений
        $order->update($request->all());

        return redirect()->route('manager.order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
