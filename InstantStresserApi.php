<?php
/*
 *  Instant-Stresser.com PHP API cURL Example.
 *  
 *  @author  MachiavelSST
 *  @link    https://instant-stresser.com
 *  @contributors 13dev
 *
*/
namespace InstantStresser;

class InstantStresserApi
{
	private $userId;
	private $apiKey;
	private $curlHandler;
	const API_URL = "https://api.instant-stresser.com/";

	/**
	 * InstantStresserApi constructor.
	 * @param $userId
	 * @param $key
	 */
	public function __construct($userId, $key)
	{
		$this->userId = $userId;
		$this->apiKey = $key;

		if(empty($this->userId) || empty($this->apiKey))
		{
			throw new Exception('UserId and API Key must be defined.');
		}
	}
	
	public function __destruct()
	{
		if (!is_null($this->curlHandler))
		{
			curl_close($this->curlHandler);
		}
	}

	/**
	 * @param $host
	 * @param $port
	 * @param $time
	 * @param $method
	 * @param int $slots
	 * @param int $pps
	 * @return string
	 */
	public function startL4($host, $port, $time, $method, $slots = 1, $pps = 100000)
	{
		return $this->send([
			'host' => $host,
			'port' => $port,
			'time' => $time,
			'method' => $method,
			'slots' => $slots,
			'pps' => $pps
		]);
	}

	/**
	 * @param $host
	 * @param $time
	 * @param $method
	 * @param int $slots
	 * @param string $type
	 * @param bool $ratelimit
	 * @return string
	 */
	public function startL7($host, $time, $method, $slots = 1, $type = "GET", $rateLimit = false)
	{
		return $this->send([
			'host' => $host,
			'time' => $time,
			'method' => $method,
			'slots' => $slots,
			'type' => $type,
			'ratelimit' => $rateLimit
		]);
	}

	public function stop($host)
	{
		return $this->send([
			'host' => $host
		], "stop");
	}
	
	/**
 	* @param array $parameters
	* @param string $action
	* @return string
 	*/
	
	private function send(array $parameters = [], $action = 'start')
	{
		$parameters['user'] = $this->userId;
		$parameters['api_key'] = $this->apiKey;
		$parameters = http_build_query($parameters, '', '&');

		if(is_null($this->curlHandler))
		{
			$this->curlHandler = curl_init(self::API_URL . $action);
			curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, TRUE);
			// CURLOPT_SSL_VERIFYPEER only available on PHP >= 7.1
			//curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($this->curlHandler, CURLOPT_ENCODING, '');
			curl_setopt($this->curlHandler, CURLOPT_MAXREDIRS, 10);
			curl_setopt($this->curlHandler, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($this->curlHandler, CURLOPT_POST, 1);
			curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, $parameters);
			curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER , ['cache-control: no-cache', 'content-type: application/x-www-form-urlencoded']);
		}

		switch($response = curl_exec($this->curlHandler))
		{
			case false:
				return curl_error($this->curlHandler);
			break;
			default:
				$response = json_decode($response, true);
				return $response['message'];
			break;
		}
	}
}


?>
