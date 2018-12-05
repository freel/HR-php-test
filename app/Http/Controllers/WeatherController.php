<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{

  /**
   * Делает запрос к API Яндекс погоды
   *
   * @
   *
   * @return json
   */
  public function index()
  {
    // API-key Яндекс погоды
    $api_key = env('WEATHER_API_KEY', false);

    // Создаём контекст запроса
    $context = stream_context_create([
      'http' => [
        'method' => "GET",
        'header' => "X-Yandex-API-Key:" . $api_key
      ]
    ]);

    // Координаты Брянска
    $lat = "53.250000";
    $lon = "34.366670";

    // Язык ответа
    $lang = "ru_RU";

    // Срок прогноза
    $limit = 1;

    // Прогноз по часам
    $hours = false;

    // Информация об осадках
    $extra = false;

    // Формирование адреса запроса
    $api_url = "https://api.weather.yandex.ru/v1/forecast?"
      ."lat=".$lat
      ."&lon=".$lon
      ."&lang=".$lang
      ."&limit=".$limit
      ."&hours=".$hours
      ."&extra=".$extra;

    // Ответ от API в виде ассоциативного массива
    $api_response = json_decode(file_get_contents($api_url, false, $context), true);

    // dd($api_response);
    return view('weather.info',[
      'city' => 'Брянск',
      'temp' => $api_response['fact']['temp'],
      'feels' => $api_response['fact']['feels_like'],
      'wind' => $api_response['fact']['wind_speed'],
      'humidity' => $api_response['fact']['humidity']
    ]);
  }
}
