<?php

namespace App\Observers;

use App\Models\News;
use App\Models\User;
use App\Notifications\NewNewsPublished;
use Illuminate\Support\Facades\Notification;

class NewsObserver
{
    public function created(News $news): void
    {
        if ($news->published_at) {
            $this->notifyActiveMembers($news);
        }
    }

    public function updated(News $news): void
    {
        // Notify when a news item is published for the first time
        if ($news->wasChanged('published_at') && $news->published_at && !$news->getOriginal('published_at')) {
            $this->notifyActiveMembers($news);
        }
    }

    private function notifyActiveMembers(News $news): void
    {
        $members = User::where('status', 'active')->get();
        Notification::send($members, new NewNewsPublished($news));
    }
}
