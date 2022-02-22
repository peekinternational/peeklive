<?php

namespace Payment;
use Omnipay\Omnipay;
class Payment

{

   /**

    * @return mixed

    */

   public function gateway()

   {

       $gateway = Omnipay::create('PayPal_Express');

       $gateway->setUsername("sb-foj9f10971142@business.example.com");
       $gateway->setPassword("ATT7OcmeF_Q6dHXbAgwfd2ZXTHJPaqAJC6qe7tkzEvMA0otWDE75rUXEdOc3oJeesnvySAPVlWqhQo3T");
       $gateway->setSignature("EIe3bKG715K-e0dl6ZjjuK1pVDoX-4USeupfV9xioTb5ASSf6hvYBv9Fdd1CKTPU-BehSTJzoQu7PYuF");
       $gateway->setTestMode(true);
       return $gateway;

   }

   /**

    * @param array $parameters

    * @return mixed

    */

   public function purchase(array $parameters)

   {

       $response = $this->gateway()
           ->purchase($parameters)
           ->send();

       return $response;

   }

   /**

    * @param array $parameters

    */

   public function complete(array $parameters)

   {

       $response = $this->gateway()
           ->completePurchase($parameters)
           ->send();

       return $response;
   }

   /**

    * @param $amount

    */

   public function formatAmount($amount)

   {
       return number_format($amount, 2, '.', '');
   }

   /**

    * @param $order

    */

   public function getCancelUrl($order = "")

   {
       return $this->route('http://phpstack-275615-1077014.cloudwaysapps.com/cancel.php', $order);
   }

   /**

    * @param $order

    */

   public function getReturnUrl($order = "")

   {

       return $this->route('http://phpstack-275615-1077014.cloudwaysapps.com/return.php', $order);
   }

   public function route($name, $params)

   {
       return $name; // ya change hua hai
   }
}