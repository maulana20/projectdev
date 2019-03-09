<?php
require_once "XmlRpc/RajaBiller.php";
require_once "Zend/XmlRpc/Client.php";
require_once "Zend/XmlRpc/Request.php";

class RajaBillerModel
{
	public $sessionManager;
	public $uid;
	public $pin;
	public $process;
	
	public function setUid($uid)
	{
		$this->uid = $uid;
	}
	
	public function setPin($pin)
	{
		$this->pin = $pin;
	}
	
	public function getUid()
	{
		return $this->uid;
	}
	
	public function getPin()
	{
		return $this->pin;
	}
	
	public function __construct($url)
	{
		$this->sessionManager = new Xmlrpc_Rajabiller($url, $httpClient = NULL);
	}
	
	public function getDeposit()
	{
		/*$data = array($this->getUid(), $this->getPin());
		$data = array('6281262225225', '123456', '9999', '081218824157', 'S10');
		try {
			$response = $this->sessionManager->getRequest('topUpRequest', $data);
		} catch (Exception $e) {
			echo $e->getMessage() . '\n';
		}*/
		$xml = '<?xml version="1.0"?>
<methodCall>
   <methodName>topUpRequest</methodName>
   <params>
   <param>
<value>
  <struct>
    <member>
      <name>MSISDN</name>
      <value><string>0818111222</string></value>
    </member>
    <member>
      <name>REQUESTID</name>
      <value><string>123456</string></value>
    </member>
    <member>
      <name>PIN</name>
      <value><string>6633</string></value>
    </member>
    <member>
      <name>NOHP</name>
      <value><string>0818111333</string></value>
    </member>
    <member>
      <name>NOM</name>
      <value><string>XR10</string></value>
    </member>
  </struct>
</value>

   </param>
   </params>
</methodCall>';
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$this->process = socket_connect($socket, '103.247.103.70', '6789');
		//$process = fsockopen('https://103.247.103.70', '6789', NULL, NULL, 30);
		//$url = $this->url;
		$request = NULL;
		$request[] = "POST https://103.247.103.70 HTTP/1.0";
		$request[] = 'Connection: close';
		$request[] = 'Content-type: text/xml';
		$request[] = 'Content-length: ' . strlen($xml);
		
		$output = implode($request, "\r\n") . "\r\n\r\n" . $xml . "\r\n";
		//$this->addlog("SEND: " . $output . "\r\n");
		if (fwrite($this->process, $output) === FALSE) {
			//$this->close();
			$getResponse['result'] = 'ERROR';
			$getResponse['reason'] = 'Send process error';
			return $getResponse;
		}
		/*$f = fopen('rajabillerdeposit.txt', 'w');
		fwrite($f, $response);
		fclose($f);*/
	}
}
