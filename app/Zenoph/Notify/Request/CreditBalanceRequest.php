<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    namespace App\Zenoph\Notify\Request;

    use App\Zenoph\Notify\Response\CreditBalanceResponse;

    class CreditBalanceRequest extends NotifyRequest {
        public function __construct($authProfile = null) {
            parent::__construct($authProfile);
        }

        public function submit() {
            $this->setRequestResource('account/balance');
            $this->initRequest();
        /*    $dataWriter = $this->createDataWriter();
            $this->_requestData = &$dataWriter->writeCreditBalanceRequest();
        */
            // submit request
            $response = parent::submit();

            // create and return balance response object
            return CreditBalanceResponse::create($response);
        }
    }
