<?php


namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Support\Facades\Log;

use Error;

use App\Facade\Console;

class TelegramServices
{
    /**
     * request
     *  An API Callback to use Telegram API.
     */
    private function request(string $method, string $path, array $data)
    {
        try {
            $client = new Client();

            $param['json'] = $data;

            return $client->request(
                $method,
                (env('TELEGRAM_API_URI') . env('TELEGRAM_API_KEY') . $path),
                $param
            );
        } catch (RequestException $exception) {
            Log::alert($exception->getResponse()->getBody()->getContents());

            $environment = env('APP_ENV');

            Log::alert("[$environment]" . json_encode($exception->getResponse()->getReasonPhrase()));
        }
    }



    public function sendMessage(string $message): void {

        Console::writeLine($message);
        $this->request(
            'POST',
            '/sendMessage',
            [
                "chat_id" => env('TELEGRAM_MAIN_CHAT_ID'),
                "text" => $message
            ]
        );
    }

    public function sendDocument(string $message): void {
        throw new Error("Belum di implement goblok");
    }

}
