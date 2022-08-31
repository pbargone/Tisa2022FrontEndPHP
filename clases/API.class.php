<?php
session_start();
require_once("config/constantes.php");
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class API {
	
	private $clienteApi;

	public function __construct(){
		$this->clienteApi = new Client();
	}

	public function login($usuario, $password){
	 	try{			
			$headers = ['Content-Type' => 'application/json'];
			$body = '{
						"usuario": "'.$usuario.'",
						"pass": "'.$password.'"
					}';
			$request = new Request('POST', API_URL.'/login', $headers, $body);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$logindata = json_decode($res->getBody(true)->getContents());
			//var_dump($logindata);
			$_SESSION['TISA_TOKEN'] = $logindata->data->token;
			$_SESSION['TISA_USERNAME'] = $usuario;
			return $logindata->data->login_status;
		}catch (RequestException $e){			
            	$this->StatusCodeHandling("login",$e);         
		}

	 }

	public function getUsuariosAll(){
	 	try{			
			$headers = [
			  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
			];			
			$request = new Request('GET', API_URL.'/usuario/all', $headers);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$respuesta = json_decode($res->getBody(true)->getContents());			
			return $respuesta->data;			
		}catch (RequestException $e){			
            	$this->StatusCodeHandling("login",$e);         
		}

	 }

	 public function getEmpleadosAll(){
	 	try{			
			$headers = [
			  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
			];			
			$request = new Request('GET', API_URL.'/empleado/all', $headers);
			$res = $this->clienteApi->sendAsync($request)->wait();
			$respuesta = json_decode($res->getBody(true)->getContents());			
			return $respuesta->data;			
		}catch (RequestException $e){			
            	$this->StatusCodeHandling("login",$e);         
		}

	 }

	 // arma las excepciones por errores de http status
	 public function StatusCodeHandling($endPoint,$e){	 		
			$response = json_decode($e->getResponse()->getBody(true)->getContents());
			//var_dump($response);
			if(isset($response->status_msg)){
				throw new Exception(" API $endPoint : ".$response->status_msg); 
			}else{
				throw new Exception(" API $endPoint : ssss".$e->getMessage()); 
			}
	 }

}
?>