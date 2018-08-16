<?php
	
	// отключаем кэширование
	ini_set("soap.wsdl_cache_enabled", "0");
	set_time_limit(0);
	
	// CseApi
	class CseApi {
		
		public $login;
		public $password;
		public $url = 'http://web.cse.ru/1c/ws/Web1C.1cws?wsdl';
		
		public $client;
	
		public function __construct($array){
			$this->login = $array['login'];
			$this->password = $array['password'];
			$this->client = new SoapClient($this->url);
		}
		
		// Отслеживание
		public function Tracking($array){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'documents' => Array(
					'Key' => 'Documents',
					'List' => Array(
						Array(
							'Key' => $array['number']
						)
					)
				),
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'DocumentType',
							'ValueType' => 'string',
							'Value' => $array['type']
						)
					)
				)
			);
			
			$params = json_decode(json_encode($params));
			$response = $this->client->Tracking($params);
			$response = json_decode(json_encode($response->return), true);
			
			// Если ошибка
			if(isset($response['Properties']['List']['Value'])){
				return $this->Error($response['Properties']['List']['Value']);
			}
			
			// Если ошибка
			if(isset($response['List']['Properties']['Key']) && $response['List']['Properties']['Key'] == 'Error'){
				return $this->Error($response['List']['Properties']['List']['Value']);
			}
			
			// в норм вид
			$response = $this->KeyValue(Array(
				'array' => $response['List']['List'],
				'key' => 'Key',
				'value' => 'Properties'
			));
			
			foreach($response as $key => $val){
				$response[$key] = $this->KeyValue(Array(
					'array' => $val,
					'key' => 'Key',
					'value' => 'Value'
				));
				$response[$key]['DateTime'] = str_replace('T', ' ', $response[$key]['DateTime']);
			}

			return $response;
		}
		
		// Список географии
		public function GeographyList($id = false){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'Reference',
							'ValueType' => 'string',
							'Value' => 'Geography'
						)
					)
				)
			);
			
			if($id){
				$params['parameters']['List'][] = Array(
					'Key' => 'InGroup',
					'ValueType' => 'string',
					'Value' => $id
				);
			}
			
			$params = json_decode(json_encode($params));
			$response = $this->client->GetReferenceData($params);
			$response = json_decode(json_encode($response->return), true);
			return $this->KeyValue(Array(
				'array' => $response['List'],
				'key' => 'Key',
				'value' => 'Value'
			));
		}
		
		// Список видов груза
		public function TypeOfCargoList(){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'Reference',
							'ValueType' => 'string',
							'Value' => 'TypesOfCargo'
						)
					)
				)
			);
			$params = json_decode(json_encode($params));
			$response = $this->client->GetReferenceData($params);
			$response = json_decode(json_encode($response->return), true);
			return $this->KeyValue(Array(
				'array' => $response['List'],
				'key' => 'Key',
				'value' => 'Value'
			));
		}
		
		// Список срочностей
		public function UrgencyList(){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'Reference',
							'ValueType' => 'string',
							'Value' => 'Urgencies'
						)
					)
				)
			);
			$params = json_decode(json_encode($params));
			$response = $this->client->GetReferenceData($params);
			$response = json_decode(json_encode($response->return), true);
			return $this->KeyValue(Array(
				'array' => $response['List'], 
				'key' => 'Key',
				'value' => 'Value'
			));
		}
		
		// Калькулятор
		public function Calc($array){
			$fields = Array('ipaddress', 'SenderGeography', 'RecipientGeography', 'Urgency', 'TypeOfCargo', 'Weight', 'Qty', 'VolumeWeight', 'Volume', 'deliverytype');
			foreach($fields as $field){
				$array[$field] = (isset($array[$field]) ? $array[$field] : '');
			}
			
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'ipaddress',
							'ValueType' => 'string',
							'Value' => $array['ipaddress']
						)
					)
				),
				'data' => Array(
					'Key' => 'Destinations',
					'List' => Array(
						Array(
							'Key' => 'Destinations',
							'Fields' => Array(
								Array(
									'Key' => 'SenderGeography',
									'ValueType' => 'string',
									'Value' => $array['SenderGeography']
								),
								Array(
									'Key' => 'RecipientGeography',
									'ValueType' => 'string',
									'Value' => $array['RecipientGeography']
								),
								Array(
									'Key' => 'Urgency',
									'ValueType' => 'string',
									'Value' => $array['Urgency']
								),
								Array(
									'Key' => 'TypeOfCargo',
									'ValueType' => 'string',
									'Value' => $array['TypeOfCargo']
								),
								Array(
									'Key' => 'Weight',
									'ValueType' => 'float',
									'Value' => $array['Weight']
								),
								Array(
									'Key' => 'Qty',
									'ValueType' => 'float',
									'Value' => $array['Qty']
								),
								Array(
									'Key' => 'VolumeWeight',
									'ValueType' => 'float',
									'Value' => $array['VolumeWeight']
								),
								Array(
									'Key' => 'Volume',
									'ValueType' => 'float',
									'Value' => $array['Volume']
								),
								Array(
									'Key' => 'deliverytype',
									'ValueType' => 'string',
									'Value' => $array['deliverytype']
								)
							)
						)
					)
				)
			);
			$params = json_decode(json_encode($params));
			$response = $this->client->Calc($params);
			$response = json_decode(json_encode($response->return), true);

			// Если ошибка
			if(isset($response['List']['Properties']['Key']) && $response['List']['Properties']['Key'] == 'Error'){
				return $this->Error($response['List']['Properties']['List']['Value']);
			}
			
			// Если ошибка
			if(isset($response['Properties']['List']['Value'])){
				return $this->Error($response['Properties']['List']['Value']);
			}
			
			if(!isset($response['List']['List'])){
				return print_r($response);
			}
			
			$response = $response['List']['List'];
			$response = $this->KeyValue(Array(
				'array' => $response[0]['Fields'],
				'key' => 'Key',
				'value' => 'Value'
			));
			
			/* в нормальный вид Калькулятора */
			// Валюта
			$Currency = $this->Currency($response['Currency']);
			$response['Currency'] = $Currency['FullName'];
			
			// Дополнительная ифа о срочности
			$Urgency = $this->Urgency($response['Urgency']);
			$response['Urgency'] = $Urgency;
			
			return $response;
		}
	
		// Валюта
		public function Currency($string){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'Reference',
							'ValueType' => 'string',
							'Value' => 'Currencies'
						)
					)
				)
			);
			$params = json_decode(json_encode($params));
			$response = $this->client->GetReferenceData($params);
			$response = json_decode(json_encode($response->return), true);
			$response = $this->KeyValue(Array(
				'array' => $response['List'],
				'key' => 'Key',
				'value' => 'Fields'
			));
			foreach($response as $key => $val){
				if($key == $string) return $this->KeyValue(Array(
					'array' => $val,
					'key' => 'Key',
					'value' => 'Value'
				));
			}
		}
		
		// Срочность
		public function Urgency($string){
			$response = $this->UrgencyList();
			foreach($response as $key => $val){
				if($key == $string) return $val;
			}
		}
		
		// Тариф
		public function Tariff($string){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'Reference',
							'ValueType' => 'string',
							'Value' => 'Services'
						)
					)
				)
			);
			$params = json_decode(json_encode($params));
			$response = $this->client->GetReferenceData($params);
			$response = json_decode(json_encode($response->return), true);
			$response = $this->KeyValue(Array(
				'array' => $response['List'], 
				'key' => 'Key',
				'value' => 'Value'
			));
			foreach($response as $key => $val){
				if($key == $string) return $val;
			}
		}
		
		// Ошибка
		public function Error($string){
			$params = Array(
				'login' => $this->login,
				'password' => $this->password,
				'parameters' => Array(
					'Key' => 'parameters',
					'List' => Array(
						Array(
							'Key' => 'Reference',
							'ValueType' => 'string',
							'Value' => 'ErrorCodes'
						),
						Array(
							'Key' => 'Search',
							'ValueType' => 'string',
							'Value' => $string
						)
					)
				)
			);
			$params = json_decode(json_encode($params));
			$response = $this->client->GetReferenceData($params);
			$response = json_decode(json_encode($response->return), true);
			return $response['List']['Value'];
		}
		
		// Key => Value
		public function KeyValue($array){
			$new_array = Array();
			if(!is_array($array['array'])) return $new_array;
			if(!isset($array['array'][$array['key']])){
				foreach($array['array'] as $val){
					$new_array[$val[$array['key']]] = $val[$array['value']];
				}
			}else{
				$new_array[$array['array'][$array['key']]] = $array['array'][$array['value']];
			}
			return $new_array;
		}
		
	}
	
?>
