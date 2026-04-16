<?php

namespace Database\Seeders;

use App\Enums\RsvpStatus;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('status', 'active')->get();

        if ($users->isEmpty()) {
            return;
        }

        $events = Event::factory(8)->create([
            'created_by' => $users->random()->id,
        ]);

        // Add attendees to events
        foreach ($events as $event) {
            $attendees = $users->random(rand(2, min(6, $users->count())));
            foreach ($attendees as $user) {
                EventAttendee::create([
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    'rsvp_status' => fake()->randomElement(RsvpStatus::cases()),
                ]);
            }
        }
    }
}
