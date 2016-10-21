<?php

/*
 * This file is part of placetopay-webservice test.
 *
 * (c) Luis Blanco <luisblanco93@gmail.com>
 *
 */
namespace Luisb\Pse;

class PTPAuthentication {
	/**
	 * Transactional key for authentication
	 *
	 * @var string
	 */
	private $key = '024h1IlD';
	/**
	 * Identifier provided by PlacetoPay
	 *
	 * @var string
	 */
	private $login = '6dd490faf9cb87a9862245da41170ff2';
	/**
	 * The endpoint
	 *
	 * @var string
	 */
	private $url = 'https://test.placetopay.com/soap/pse/?wsdl';
	/**
	 * Additional data for authentication
	 *
	 * @var string
	 */
	private $additional = [];
	public function __construct(){
		
	}
	/**
	 * Get the endpoint
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}
	/**
	 * Get the transactional key
	 *
	 * @return string
	 */
	public function getKey() {
		return $this->key;
	}
	/**
	 * Get the identifier
	 *
	 * @return string
	 */
	public function getLogin() {
		return $this->login;
	}
	/**
	 * Get the additional data
	 *
	 * @return array
	 */
	public function getAdditional() {
		return $this->additional;
	}

}
