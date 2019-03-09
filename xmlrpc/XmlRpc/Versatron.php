<?php
require_once "Zend/XmlRpc/Client.php";
require_once "Zend/XmlRpc/Request.php";
require_once "Zend/Http/Client.php";
require_once "Zend/XmlRpc/Value/Struct.php";

class Xmlrpc_Versatron extends Zend_XmlRpc_Client
{
	public function __construct($server, Zend_Http_Client $httpClient = null)
	{
		$config = array(
				'adapter' => 'Zend_Http_Client_Adapter_Curl',
				'curloptions' => array(
					CURLOPT_SSL_VERIFYPEER => false,
					),
				);
		$httpClient = new Zend_Http_Client($server, $config);
		
		parent::__construct($server, $httpClient);
	}
	
	public function doRequest($request, $response = null)
	{
		$xmlRequest = new DOMDocument('1.0');
		$xmlRequest->loadXML($request);
		$result = $xmlRequest->saveXML();
		$body = stristr($result, '<methodName>');
		$body = stristr($body, '>');
		$matches = substr($body, 1, strpos($body, '</methodName>', 1)-1);
		$method = explode('.', $matches);
		
		$response = parent::doRequest($request, $response);
		
		$f = fopen("log/VersatronXmlrpcRequest". $method[0] . ".xml", "w");
		fwrite($f, $request . "\n");
		fclose($f);
		
		$f = fopen("log/VersatronXmlrpcResponse". $method[0] . ".xml", "w");
		fwrite($f, $response . "\n");
		fclose($f);
		
		return $response;
	}
	
	public function getRequest($method, $data = array())
	{
		$test = new Zend_XmlRpc_Value_Struct($data);
		$client = new Zend_XmlRpc_Client('http://ritsdev/xmlrpc/');
		$request = new Zend_XmlRpc_Request();
		$request->setMethod($method);
		$request->setParams($test);
		
		return $this->doRequest($request, $response = NULL);
	}
}
