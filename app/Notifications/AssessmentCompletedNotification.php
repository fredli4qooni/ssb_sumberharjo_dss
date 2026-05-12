<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Player;
    use App\Models\User;

class AssessmentCompletedNotification extends Notification
{
    use Queueable;

    public Player $player;
    public User $coach;

    public function __construct(Player $player, User $coach)
    {
        $this->player = $player;
        $this->coach = $coach;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Penilaian Selesai',
            'message' => 'Coach ' . $this->coach->name . ' baru saja menyelesaikan penilaian untuk ' . $this->player->name . '.',
            'icon' => 'check-circle',
            'url' => route('admin.dashboard')
        ];
    }
}