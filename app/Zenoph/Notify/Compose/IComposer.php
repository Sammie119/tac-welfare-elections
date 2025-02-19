<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    namespace App\Zenoph\Notify\Compose;

    interface IComposer {
        function addDestination($phoneNumber, $throwEx = true, $messageId = null);
        function addDestinationsFromTextStream(&$str);
        function addDestinationsFromCollection(&$phoneNumbers, $throwEx = false);
        function getDestinationCountry($phoneNumber);
        function getDefaultDestinationCountry();
        function getDestinations();
        function getDestinationsCount();
        function getDestinationWriteMode($phoneNumber);
        function getDestinationWriteModeById($messageId);
        function destinationExists($phoneNumber);
        function clearDestinations();
        function removeDestination($phoneNumber);
        function removeDestinationById($messageId);
        function updateDestination($prePhoneNumber, $newPhoneNumber);
        function updateDestinationById($messageId, $newPhoneNumber);
        function getCategory();
        function getDefaultTimeZone();
        function getRouteCountries();
        function setDefaultNumberPrefix($dialCode);
        function getDefaultNumberPrefix();
    }
