<?php
/*
 * This file is part of placetopay-webservice test.
 *
 * (c) Luis Blanco <luisblanco93@gmail.com>
 *
 */
namespace Luisb\Pse;

use Luisb\Pse\PTPProvider;
use Luisb\Pse\PTPAuthentication;

class SoapService {
    /**
     * Class
     *
     * @var PTPAuthentication
     */
    private $ptpauth;
    /**
     * Class
     *
     * @var PTPProvider
     */
    private $function;
    /**
     *  Get the authentication, if they are null we provide them by default
     *  @param url/path to wsdl
     *  @param login for auth
     *  @param transactional key for auth
     */
    public function __construct( $param = array() ) {
            $this->ptpauth = new PTPAuthentication();
            if ( isset( $param['wsdl'] ) ) {
                $this->ptpauth->setUrl = $param['wsdl'];
            }
            if ( isset( $param['trankey'] ) ) {
                $this->ptpauth->setKey = $param['trankey'];
            }
            if ( isset( $param['login'] ) ) {
                $this->ptpauth->setLogin = $param['login'];
            }
            if ( isset( $param['additional'] ) ) {
                $this->ptpauth->setAdditional = $param['additional'];
            }
    }
    /**
     *  Get the authentication
     *  @return array
     */
    public function getAuth() {
        $key = $this->buildKey();
        $login = $this->ptpauth->getLogin();
        $seed = $this->getValidDate();
        $auth_params = array( "login" => $login, "tranKey" => $key, "seed" => $seed  );
        return $auth_params;
    }
    /**
     *  Get the date for authentication
     *  @return date ISO 8601
     *
     */
    public function getValidDate() {
        return date( 'c' );
    }
    /**
     *   Get the transactional key
     *   @return sha1
     *
     */
    public function buildKey() {
        $seed = $this->getValidDate();
        return sha1( $seed.$this->ptpauth->getKey(), false );
    }
    /**
     *   Get the bank list
     *  @return array
     *
     */
    public function bankList() {
        $this->function = new PTPProvider( $this->getAuth(), $this->ptpauth->getUrl() );
        return $this->function->getBankList();
    }
    /**
     *  Start transaction
     *  @return array
     *
     */
    public function beginTransaction( $formdata ) {
        $this->function = new PTPProvider( $this->getAuth(), $this->ptpauth->getUrl() );
        return $this->function->createTransaction( $formdata );
    }
    /**
     *  Start transaction multicredit
     *  @return array
     *
     */
    public function beginTransactionMulticredit( $formdata ) {
        $this->function = new PTPProvider( $this->getAuth(), $this->ptpauth->getUrl() );
        return $this->function->createTransactionMulticredit( $formdata );
    }
    /**
     *  Get transaction by transaction ID
     *  @return array
     *
     */
    public function findTransaction( $id="" ) {
        $this->function = new PTPProvider( $this->getAuth(), $this->ptpauth->getUrl() );
        return $this->function->getTransactionInformation( $id );
    }
}
