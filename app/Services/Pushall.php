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
	  
		curl_setopt_array($ch = curl_init(), [
			CURLOPT_URL => $this->url,
			CURLOPT_POSTFIELDS => $data,
	  		CURLOPT_RETURNTRANSFER => true
		]);
		
		$result = curl_exec($ch); //получить ответ или ошибку
		curl_close($ch);

		return $result;
	}
}
