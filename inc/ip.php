<?php

function whois($url,$ip)
{
	// Соединение с сокетом TCP, ожидающим на сервере "whois.arin.net" по 43 порту
	$sock = fsockopen($url, 43, $errno, $errstr);
	if(!$sock) exit("$errno($errstr)");
	else
	{
		// Записываем строку из переменной $_POST["ip"] в дескриптор сокета
		fputs ($sock, $ip."\r\n");
		// Осуществляем чтение из дескриптора сокета
		$text = "";
		while (!feof($sock))
		{
		  $text .= fgets ($sock, 128);
		}
		// Закрываем соединение
		fclose ($sock);

		// Ищем реферальный сервере
		$pattern = "|ReferralServer: whois://([^\n<:]+)|i";
		preg_match($pattern, $text, $out);
		if(!empty($out[1])) return whois($out[1], $ip);
		else return $text;
	}
}