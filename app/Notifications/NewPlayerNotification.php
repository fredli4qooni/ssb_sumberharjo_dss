<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Player;

class NewPlayerNotification extends Notification
{
    use Queueable;

    public Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Pemain Baru Terdaftar',
            'message' => 'Pemain baru bernama ' . $this->player->name . ' telah ditambahkan ke database.',
            'icon' => 'user-plus',
            'url' => route('pelatih.assessments.index')
        ];
    }
}
