<?php
require_once 'Zend/Soap/Client.php';
include 'Zend/Soap/Client/DotNet.php';

class SOAP_Vendor extends Zend_SOAP_Client
{
	public function __construct($wsdl = null, $options = null)
	{
		// Use SOAP 1.1 as default
		$this->setSoapVersion(SOAP_1_1);
		
		parent::__construct($wsdl, $options);
	}
	
	public function _doRequest(Zend_Soap_Client_Common $client, $request, $location, $action, $version, $one_way = null)
	{
		$xmlRequest = new DOMDocument('1.0');
		$xmlRequest->loadXML($request);
		
		$this->_setHeaderXml($xmlRequest, 'CompanyCode');
		$this->_setHeaderXml($xmlRequest, 'Signature');
		$this->_setHeaderXml($xmlRequest, 'ContractVersion');
		
		$request = $xmlRequest->saveXML();
		
		$response = parent::_doRequest($client, $request, $location, $action, $version, $one_way);
		$tmpname = explode('/', $action);
		$f = fopen("log/VendorSOAPRequest" . $tmpname[5] . ".xml", "w");
		fwrite($f, $request . "\n");
		fclose($f);
		$f = fopen("log/VendorSOAPResponse" . $tmpname[5] . ".xml", "w");
		fwrite($f, $response . "\n");
		fclose($f);
		
		return $response;
	}
	
	private function _setHeaderXml($xmlRequest, $header)
	{
		$elements = $xmlRequest->getElementsByTagName($header);
		$sign = null;
		foreach ($elements as $element) {
			$sign = $element->nodeValue;
			$element->parentNode->removeChild($element);
		}
		$elements = $xmlRequest->getElementsByTagName('Header');
		
		if ($sign != null) {
			$attr = $xmlRequest->createAttribute('xmlns:h');
			$attr->value = 'http://schemas.navitaire.com/WebServices';
			
			$node = $xmlRequest->createElement('h:Signature', $sign);
			$node->appendChild($attr);
			foreach ($elements as $element) {
				$element->appendChild($node);
			}
			$request = $xmlRequest->saveXML();
		}
	}
}
