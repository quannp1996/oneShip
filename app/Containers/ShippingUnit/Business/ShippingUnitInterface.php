<?php 
namespace App\Containers\ShippingUnit\Business;

interface ShippingUnitInterface
{
    public function send();
    public function cancel();
    public function hook();
    public function estimate();
}
?>