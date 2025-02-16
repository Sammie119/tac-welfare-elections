<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    namespace App\Zenoph\Notify\Enums;

    class MessageCategory {
        const SMS = 1;
        const VOICE = 2;
        const USSD = 3;

        public static function isDefined($category){
            $reflector = new \ReflectionClass(__CLASS__);
            $constants = $reflector->getConstants();

            foreach ($constants as $constVal){
                if ($category == $constVal)
                    return true;
            }

            return false;
        }
    }
