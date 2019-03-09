<?php
require_once "SOAP/Vendor.php";

class VendorSOAPModel
{
	public $url;
	public $user_login;
	public $password;
	public $signature;
	public $session_manager;
	public $booking_manager;
	
	public function __construct($url, $user_login, $password)
	{
		$this->url = $url;
		$this->user_login = $user_login;
		$this->password = $password;
	}
	
	public function sessionManager()
	{
		$this->session_manager = new SOAP_Vendor($this->url . '/SessionManager.svc?wsdl');
	}
	
	public function bookingManager()
	{
		$this->booking_manager = new SOAP_Vendor($this->url . '/BookingManager.svc?wsdl');
		$this->booking_manager->addSoapInputHeader(new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'Signature', $this->signature));
		$this->booking_manager->addSoapInputHeader(new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'CompanyCode', 'C0000000000'));
		$this->booking_manager->addSoapInputHeader(new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'ContractVersion', '0'));
	}
	
	public function login()
	{
		$request = array(
			'logonRequestData' => array(
				'DomainCode' => 'EXT',
				'AgentName' => $this->user_login,
				'Password' => $this->password,
			),
		);
		
		try {
			$this->sessionManager();
			$response = $this->session_manager->Logon($request);
		} catch (Exception $e) {
			throw $e;
		}
		
		$this->signature = $response->Signature;
		
		return $response;
	}
	
	public function getAvailability()
	{
		$request = array(
			'TripAvailabilityRequest' => array(
				'AvailabilityRequests' => array(
					'AvailabilityRequest' => array(
						'DepartureStation' => 'CGK',
						'ArrivalStation' => 'SUB',
						'BeginDate' => date('c', strtotime('+ 12 days')),
						'EndDate' => date('c', strtotime('+ 12 days')),
						'CarrierCode' => 'QG',
						'PaxCount' => 1,
						'PaxPriceTypes' => array(
							'PaxPriceType' => array(
								array(
									'PaxType' => 'ADT',
									'PaxDiscountCode' => null
								),
							),
						),
					),
				),
			),
		);
		
		try {
			$this->bookingManager();
			$response = $this->booking_manager->GetAvailability($request);
		} catch (Exception $e) {
			throw $e;
		}
		
		return $response;
	}
}
