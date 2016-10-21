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
     * url/path to wsdl
     *
     * @var string
     */
    private $wsdl;
    /**
     * transactional key
     *
     * @var string
     */
    private $trankey;
    /**
     *  login
     *
     * @var string
     */
    private $login;
    /**
     *  additional data
     *
     * @var array
     */
    private $additional;
    /**
     * Class
     *
     * @var PTPAuthentication
     */
    private $ptpauth;
    /**
     * Class
     *
     * @var Functions
     */
    private $function;
    /**
     *  Validate and set params, if they are null we provide them by default
     *  @param url/path to wsdl
     *  @param login for auth
     *  @param transactional key for auth
     */
    public function __construct( $param = array() ) {
            $ptpauth = new PTPAuthentication();
            if ( isset( $param['wsdl'] ) ) {
                $this->wsdl = $param['wsdl'];
            }else {
                $this->wsdl = $ptpauth->getUrl();
            }
            if ( isset( $param['trankey'] ) ) {
                $this->trankey = $param['trankey'];
            }else {
                $this->trankey = $ptpauth->getKey();
            }
            if ( isset( $param['login'] ) ) {
                $this->login = $param['login'];
            }else {
                $this->login = $ptpauth->getLogin();
            }
            if ( isset( $param['additional'] ) ) {
                $this->additional = $param['additional'];
            }else {
                $this->additional = $ptpauth->getAdditional();
            }
    }

    /**
     *  Get the authentication
     *  @return array     
     */
    public function getAuth() {
        $key = $this->buildKey();
        $login = $this->login;
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
        return sha1( $seed.$this->trankey, false );
    }
    /**
     *   Get the bank list
     *  @return array
     *
     */
    public function bankList(){
        $this->function = new PTPProvider($this->getAuth(),$this->wsdl);
        return $this->function->getBankList();
    }
    /**
     *  Start transaction
     *  @return array
     *
     */
    public function beginTransaction($formdata){
        $this->function = new PTPProvider($this->getAuth(),$this->wsdl);
        return $this->function->createTransaction($formdata);
    }
    /**
     *  Start transaction multicredit
     *  @return array
     *
     */
    public function beginTransactionMulticredit($formdata){
        $this->function = new PTPProvider($this->getAuth(),$this->wsdl);
        return $this->function->createTransactionMulticredit($formdata);
    }
    /**
     *  Get transaction by transaction ID
     *  @return array
     * 
     */
    public function findTransaction($id=""){
        $this->function = new PTPProvider($this->getAuth(),$this->wsdl);
        return $this->function->getTransactionInformation($id);   
    }
}

