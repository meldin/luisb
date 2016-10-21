<?php

/*
 * This file is part of placetopay-webservice test.
 *
 * (c) Luis Blanco <luisblanco93@gmail.com>
 *
 */
namespace Luisb\Pse;

use Luisb\Pse\Person;
use Luisb\Pse\Transaction;
use Luisb\Pse\SoapClient;

class Functions {
	/**
	 *
	 *
	 * @var string
	 *
	 */
	private $auth;
	/**
	 *
	 *
	 * @var string
	 *
	 */
	private $wsdl;
	/**
	 *
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
	public function __construct( $param, $wsdl ) {
		$this->auth = $param;
		$this->wsdl = $wsdl;
		$this->client = new \SoapClient( $this->wsdl ); // SoapClient global
	}
	/**
	 *  Get a list of banks
	 *  @return array
	 */
	public function getBankList() {
		return $this->client->getBankList( array( "auth"=>$this->auth ) )->getBankListResult;
	}
	/**
	 *  Create a transaction
	 *  @param array
	 *  @return array
	 *
	 */
	public function createTransaction( $transaction ) {
		return $this->client->createTransaction( array( "auth"=>$this->auth, "transaction"=>$transaction ) )->createTransactionResult;
	}
	/**
	 *  Get transaction informacio by id
	 *  @param string
	 *  @return array
	 */
	public function getTransactionInformation( $id ) {
		return $this->client->getTransactionInformation( array( "auth"=>$this->auth, "transactionID"=>$id ) )->getTransactionInformationResult;
	}

}
