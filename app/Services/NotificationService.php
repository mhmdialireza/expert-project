<?php

namespace App\Services;

use App\Models\Todo;

class NotificationService
{
    public function send(Todo $todo)
    {
        $fcmToken = $todo->user->fcm_token;
        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY');
        $data = json_encode([
            "registration_ids" => [$fcmToken],
            "notification" => [
                "title" => "Todo Reminder: \"$todo->title\"",
                "body" => substr($todo->description, 0, 40) . '...',
                "image" => "https://s2.uupload.ir/files/favicon_(2)_iimk.png",
            ],
        ]);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);

        $todo->reminder_datetime = null;
        $todo->save();
    }
}
