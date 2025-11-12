<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
    public static function sendMessage($target, $message)
    {
        $token = env('FONNTE_TOKEN');
        $url = 'https://api.fonnte.com/send';

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->asForm()->post($url, [
            'target' => $target, // nomor tujuan, misal 6281234567890
            'message' => $message,
        ]);

        return $response->json();
    }
}