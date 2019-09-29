<?php 
namespace App\Contracts;

interface NotificationServicesCaller 
{
    public function sendMessage($username, $text);
}
?>