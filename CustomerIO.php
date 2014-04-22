<?php
/**
 * CustomerIO.php
 *
 *
 * @author Carlos Yakimov <carlos.yakimov@crowdsourcedtesting.com>
 * @copyright 2014 http://crowdsourcedtesting.com
 * @license MIT
 * @package CustomerIO
 * @version 1.0
 */
class CustomerIO extends CComponent
{
    public $apiKey;
    public $siteId;

    public function init()
    {
    }

    /**
     * Register a log-in in Customer.io
     * @param  mixed $customer_id You'll want to set this dynamically to the unique id of the user associated with the event
     * @param  array $event_data Event's data
     * @return void
     */
    public function registerLogin($customer_id, $event_data)
    {
        $session = curl_init();
        $customerio_url = 'https://track.customer.io/api/v1/customers/';

        curl_setopt($session, CURLOPT_URL, $customerio_url.$customer_id);
        curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($session, CURLOPT_HTTPGET, 1);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($session, CURLOPT_VERBOSE, 1);
        curl_setopt($session, CURLOPT_POSTFIELDS,http_build_query($event_data));

        curl_setopt($session,CURLOPT_USERPWD,$this->siteId . ":" . $this->apiKey);

        if(Yii::app()->request->isSecureConnection) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

        curl_exec($session);
        curl_close($session);
    }

    /**
     * Register an event in Customer.io
     * @param  mixed $customer_id You'll want to set this dynamically to the unique id of the user associated with the event
     * @param  string $name Event's name
     * @param  array $event_data Event's data
     * @return void
     */
    public function trackEvent($customer_id, $name, $event_data = [])
    {
        $session = curl_init();
        $customerio_url = 'https://track.customer.io/api/v1/customers/'.$customer_id.'/events';

        $data = ['name' => $name, 'data' => $event_data];

        curl_setopt($session, CURLOPT_URL, $customerio_url);
        curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_VERBOSE, 1);
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($session, CURLOPT_POSTFIELDS,http_build_query($data));

        curl_setopt($session,CURLOPT_USERPWD,$this->siteId . ":" . $this->apiKey);

        if(Yii::app()->request->isSecureConnection) curl_setopt($session,CURLOPT_SSL_VERIFYPEER,false);

        curl_exec($session);
        curl_close($session);
    }

}