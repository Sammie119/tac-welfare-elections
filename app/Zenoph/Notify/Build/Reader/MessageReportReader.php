<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    namespace App\Zenoph\Notify\Build\Reader;

    use App\Zenoph\Notify\Utils\MessageUtil;
    use App\Zenoph\Notify\Collections\MessageDestinationsList;
    use App\Zenoph\Notify\Build\Reader\MessageDestinationsReader;

    class MessageReportReader {
        private $_done;
        private $_xmlReader;

        public function __construct() {
            $this->_done = false;
            $this->_xmlReader = null;
        }

        /**
         *
         * @param type $data
         */
        public function setData(&$data){
            if (is_null($data))
                throw new \Exception('Invalid data for reading message report.');

            // It should either be XMLReader or string
            if ($data instanceof \XMLReader === false && !is_string($data))
                throw new \Exception('Invalid data for reading message report.');

            // If string, the xml fragment should be validated
            if (is_string($data)) {
                $this->validateXMLFragment($data);
                $this->_xmlReader = new \XMLReader();
                $this->_xmlReader->XML($data);
            }
        }

        public function read() {
            if (is_null($this->_xmlReader))
                throw new \Exception('Invalid reference to reader for reading next message report.');

            while ($this->_xmlReader->read() && !$this->_done){
                if ($this->_xmlReader->nodeType == \XMLReader::ELEMENT &&
                strtolower($this->_xmlReader->name) == "data"){
                    return $this->readMessageReport($this->_xmlReader);
                }
                else if ($this->_xmlReader->nodeType == \XMLReader::END_ELEMENT &&
                    strtolower($this->_xmlReader->name) == "data"){
                    $this->_done = true;
                }
            }

            // return null at this point
            return null;
        }

        private function readMessageReport($xmlReader){
            $readEnded = false;
            $msgReport = null;

            // we read only when the cursor is currently on message element
            if ($xmlReader->nodeType == \XMLReader::ELEMENT && strtolower($xmlReader->name) === 'data'){
                $dataArr = array();

                // continue reading
                while ($xmlReader->read() && !$readEnded){
                    if ($xmlReader->nodeType == \XMLReader::ELEMENT){
                        $name = strtolower($xmlReader->name);

                        switch ($name){
                            case 'batch':
                                $dataArr['batch'] = $xmlReader->readString();
                                break;

                            case 'category':
                                $xmlDoc = new \SimpleXMLElement($xmlReader->readOuterXml());
                                $dataArr['category'] = MessageUtil::messageCategoryToEnum((string)$xmlReader->readString());
                                break;

                            case 'text':
                                $xmlDoc = new \SimpleXMLElement($xmlReader->readOuterXml());
                                $dataArr['text'] = $xmlReader->readString();
                                break;

                            case 'type':
                                $xmlDoc = new \SimpleXMLElement($xmlReader->readOuterXml());
                                $dataArr['type'] = (int)$xmlReader->readString();
                                break;

                            case 'sender':
                                $xmlDoc = new \SimpleXMLElement($xmlReader->readOuterXml());
                                $dataArr['sender'] = $xmlReader->readString();
                                break;

                            case 'personalised':
                                $xmlDoc = new \SimpleXMLElement($xmlReader->readOuterXml());
                                $dataArr['personalised'] = strtolower($xmlReader->readString()) === 'true';
                                break;

                            case 'delivery':
                                $xmlDoc = new \SimpleXMLElement($xmlReader->readOuterXml());
                                $dataArr['delivery'] = strtolower($xmlReader->readString()) === 'true';
                                break;

                            case 'destinationscount':
                                $dataArr['destsCount'] = (int)$xmlReader->readString();
                                break;

                            case 'destinations':
                                $dataArr['destinations'] = $this->readMessageDestinations($xmlReader);
                                break;
                        }
                    }
                    else if ($xmlReader->nodeType == \XMLReader::END_ELEMENT && strtolower($xmlReader->name) === 'data'){
                        $readEnded = true;
                    }
                }

                if (count($dataArr) > 0)
                    $msgReport = MessageUtil::createReport($dataArr);
            }

            // return message report
            return $msgReport;
        }

        private function &readMessageDestinations($xmlReader){
            // we read when cursor is already on destinations element
            if ($xmlReader->nodeType == \XMLReader::ELEMENT && strtolower($xmlReader->name) === 'destinations'){
                $destsList = new MessageDestinationsList();
                $destsReader = new MessageDestinationsReader();
                $destsReader->setData($xmlReader);

                while (true){
                    $msgDest = $destsReader->getNextItem();

                    if (is_null($msgDest))
                        break;

                    // add to the destinations collection
                    $destsList->add($msgDest);
                }

                // return destinations list
                return $destsList;
            }
        }

        private function validateXMLFragment(&$fragment){

        }
    }
