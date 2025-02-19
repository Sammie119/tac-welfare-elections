<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    namespace App\Zenoph\Notify\Collections;

    use App\Zenoph\Notify\Store\MessageDestination;
    use App\Zenoph\Notify\Collections\ObjectStorage;

    class MessageDestinationsList implements \Iterator {
        private $_store = null;

        public function __construct() {
            $this->_store = new ObjectStorage();
        }

        public function add($item){
            if (is_null($item) || $item instanceof MessageDestination === false)
                throw new \Exception('Invalid reference for adding message destinations collection item.');

            // add to list
            $this->_store->attach($item);
        }

        public function &getItems(){
            return $this->_store->getItems();
        }

        public function getCount(){
            return $this->_store->getCount();
        }

        public function current() {
            return $this->_store->current();
        }

        public function next(){
            return $this->_store->next();
        }

        public function key(){
            return $this->_store->key();
        }

        public function rewind() {
            $this->_store->rewind();
        }

        public function valid() {
            return $this->_store->valid();
        }
    }
