<?php


namespace App\Services;


use Error;

class TelegramServices
{

    public function sendMessage(string $message): void {

    }

    public function sendDocument(string $message): void {
        throw new Error("Belum di implement goblok");
    }

}
