<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class API {
	
	private $clienteApi;

	public function __construct(){
		$this->clienteApi = new Client();
	}

	////////////// USUARIOS
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

	 public function getUsuarioById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/usuario/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuario/id",$e);         
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
            	$this->StatusCodeHandling("/usuario/all",$e);         
		}

	 }

	 

	 public function crearUsuario($jsonUsuario){
		try{            
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];          
		   $request = new Request('POST', API_URL.'/usuario', $headers, $jsonUsuario);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());            
		   return $respuesta->status_msg;           
	   }catch (RequestException $e){            
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }
	
	}
	public function actualizarUsuario($jsonUsuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/usuario', $headers, $jsonUsuario);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }

	}

	public function desactivarUsuario($usuario){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];	
		   //$request = new Request('PUT', API_URL.'/usuario/', $headers, $jsonUsuario); asi no encuentra la ruta		
		   $request = new Request('PUT', API_URL.'/usuario/desactivar/'.$usuario, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
		//$this->StatusCodeHandling("/usuario/",$e); asi se rompe 
			   $this->StatusCodeHandling("/usuario/",$e);         
	   }

	}
	
	 ////////////// FIN USUARIOS
	 ////////////// EMPLEADOS
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
            	$this->StatusCodeHandling("/empleado/all",$e);         
		}

	 }

	public function getProductosAll(){
		 	try{			
				$headers = [
				  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
				];			
				$request = new Request('GET', API_URL.'/producto/all', $headers);
				$res = $this->clienteApi->sendAsync($request)->wait();
				$respuesta = json_decode($res->getBody(true)->getContents());			
				return $respuesta->data;			
			}catch (RequestException $e){			
	            	$this->StatusCodeHandling("/producto/all",$e);         
			}

		 }
	public function getEmpleadoById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/empleado/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/empleado/id",$e);         
	   }

	}

	public function crearEmpleado($jsonEmpleado){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];		   
		   $request = new Request('POST', API_URL.'/empleado', $headers, $jsonEmpleado);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/empleado/",$e);         
	   }
	}

	public function getProductoById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/producto/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/producto/id",$e);         
	   }

	}

	public function crearProducto($jsonProducto){
			try{			
			   $headers = [
				 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
				 'Content-Type' => 'application/json'
			   ];		   
			   $request = new Request('POST', API_URL.'/producto', $headers, $jsonProducto);
			   $res = $this->clienteApi->sendAsync($request)->wait();
			   $respuesta = json_decode($res->getBody(true)->getContents());			
			   return $respuesta->status_msg;			
		   }catch (RequestException $e){			
				   $this->StatusCodeHandling("/producto/",$e);         
		   }
		}

	public function actualizarProducto($jsonProducto){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/producto', $headers, $jsonProducto);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/producto/",$e);         
	   }

	}

	public function actualizarEmpleado($jsonEmpleado){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/empleado', $headers, $jsonEmpleado);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/empleado/",$e);         
	   }

	}
	
	public function borrarEmpleado($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']			 
		   ];			
		   $request = new Request('DELETE', API_URL.'/empleado/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/empleado/",$e);         
	   }

	}
	////////////// FIN EMPLEADOS
	////////////// FIN MISCELANEAS
	public function getProvincias(){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/misc/provincia/all', $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/empleado/id",$e);         
	   }

	}

	public function getRubrosAll(){
		 	try{			
				$headers = [
				  'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
				];			
				$request = new Request('GET', API_URL.'/rubro/all', $headers);
				$res = $this->clienteApi->sendAsync($request)->wait();
				$respuesta = json_decode($res->getBody(true)->getContents());			
				return $respuesta->data;			
			}catch (RequestException $e){			
	            	$this->StatusCodeHandling("/rubro/all",$e);         
			}

		 }

	public function getRubroById($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']
		   ];			
		   $request = new Request('GET', API_URL.'/rubro/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->data;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/rubro/id",$e);         
	   }

	}

	public function crearRubro($jsonRubro){
			try{			
			   $headers = [
				 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
				 'Content-Type' => 'application/json'
			   ];		   
			   $request = new Request('POST', API_URL.'/rubro', $headers, $jsonRubro);
			   $res = $this->clienteApi->sendAsync($request)->wait();
			   $respuesta = json_decode($res->getBody(true)->getContents());			
			   return $respuesta->status_msg;			
		   }catch (RequestException $e){			
				   $this->StatusCodeHandling("/rubro/",$e);         
		   }
		}

	public function actualizarRubro($jsonRubro){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN'],
			 'Content-Type' => 'application/json'
		   ];			
		   $request = new Request('PUT', API_URL.'/rubro', $headers, $jsonRubro);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/rubro/",$e);         
	   }

	}
		public function borrarrubro($id){
		try{			
		   $headers = [
			 'Authorization' => 'Bearer '.$_SESSION['TISA_TOKEN']			 
		   ];			
		   $request = new Request('DELETE', API_URL.'/rubro/'.$id, $headers);
		   $res = $this->clienteApi->sendAsync($request)->wait();
		   $respuesta = json_decode($res->getBody(true)->getContents());			
		   return $respuesta->status_msg;			
	   }catch (RequestException $e){			
			   $this->StatusCodeHandling("/rubro/",$e);         
	   }

	}

	////////////// FIN MISCELANEAS
	 // arma las excepciones por errores de http status
	 public function StatusCodeHandling($endPoint,$e){	 		
			$response = json_decode($e->getResponse()->getBody(true)->getContents());
			//var_dump($response);
			if(isset($response->status_msg)){
				throw new Exception(" API $endPoint : ".$response->status_msg); 
			}else{
				if($e->getResponse()->getStatusCode()==404){
					throw new Exception(" API $endPoint : No se encuentra la ruta "); 
				}else{
					throw new Exception(" API $endPoint : ".$e->getMessage()); 
				}
				
			}
	 }

}
?>