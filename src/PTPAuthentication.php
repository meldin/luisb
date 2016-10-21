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
	 * transactional key for auth.
	 *
	 * @var string
	 */
	private $key = '024h1IlD';
	private $login = '6dd490faf9cb87a9862245da41170ff2';
	private $url = 'https://test.placetopay.com/soap/pse/?wsdl';
	public function __construct(){
		
	}
	/**
	 * get the url/path to wsdl
	 *
	 * @var string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * get the transactional key
	 *
	 * @var string
	 */
	public function getKey() {
		return $this->key;
	}
	/**
	 * get the identifier
	 *
	 * @var string
	 */
	public function getLogin() {
		return $this->login;
	}

}
