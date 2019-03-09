<?php
require_once "XmlRpc/Versatron.php";

class VersatronModel
{
	public $session;
	
	public function __construct($url)
	{
		$this->session = new Xmlrpc_Versatron($url, $httpClient = NULL);
	}
	
	public function getAnswer($data)
	{
		try {
			$response = $this->session->getRequest('answer', $data);
		} catch (Exception $e) {
			echo $e->getMessage() . '\n';
		}
	}
}
