<?php

/*
 * This file is part of placetopay-webservice test.
 *
 * (c) Luis Blanco <luisblanco93@gmail.com>
 *
 */
namespace Luisb\Pse;

use Luisb\Pse\SoapClient;

class PTPProvider {
	/**
	 * The authentication
	 *
	 * @var string
	 *
	 */
	private $auth;
	/**
	 * The endpoint
	 *
	 * @var string
	 *
	 */
	private $wsdl;
	/**
	 *	Class
	 *	
	 * @var SoapClient
	 *
	 */
	private $client;
	/**
	 * Construct
	 *
	 * @param string
	 * @param string
	 * 
	 * */
	public function __construct( $auth, $wsdl ) {
		$this->auth = $auth;
		$this->wsdl = $wsdl;
		$this->client = new \SoapClient( $this->wsdl ); // SoapClient global
	}
	/**
	 *  Get the bank list
	 *  @return array
	 */
	public function getBankList() {
		return $this->client->getBankList( array( "auth"=>$this->auth ) )->getBankListResult;
	}
	/**
	 *  Create the transaction
	 *  @param array
	 *  @return array
	 *
	 */
	public function createTransaction( $transaction ) {
		return $this->client->createTransaction( array( "auth"=>$this->auth, "transaction"=>$transaction ) )->createTransactionMultiCreditResult;
	}
	/**
	 *  Create the multicredit transaction
	 *  @param array
	 *  @return array
	 *
	 */
	public function createTransactionMulticredit( $transaction ) {
		return $this->client->createTransaction( array( "auth"=>$this->auth, "transaction"=>$transaction ) )->createTransactionResult;
	}
	/**
	 *  Get the transaction information by transactionID
	 *  @param string
	 *  @return array
	 */
	public function getTransactionInformation( $id ) {
		return $this->client->getTransactionInformation( array( "auth"=>$this->auth, "transactionID"=>$id ) )->getTransactionInformationResult;
	}

}
