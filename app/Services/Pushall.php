<?php

namespace App\Services;

class Pushall
{
	private $pushallKey;
	private $pushallId;

	protected  $url = "https://pushall.ru/api.php";

	public function __construct($pushallKey, $pushallId)
	{
		$this->pushallKey = $pushallKey;
		$this->pushallId = $pushallId;
	}

	public function send($title, $text)
	{
		$data = [
		    "type" => "self",
		    "id" => $this->pushallId,
		    "key" => $this->pushallKey,
		    "text" => $text,
		    "title" => $title,
	  	];

	  	// 1. Инициализируются ресурс url
	  	// 2. Устанавливаются опции этому ресурсу
		curl_setopt_array($ch = curl_init(), [
			CURLOPT_URL => $this->url,
			CURLOPT_POSTFIELDS => $data,
	  		CURLOPT_RETURNTRANSFER => true
		]);

		// 3. Выполняется запрос
		$result = curl_exec($ch); //получить ответ или ошибку
		curl_close($ch);

		return $result;

		// С использованием GuzzleHttp
		// $client = new \GuzzleHttp\Client(['base_uri' => $this->url]);

		// return $client->post('', ['form_params' => $data]);
	}
}