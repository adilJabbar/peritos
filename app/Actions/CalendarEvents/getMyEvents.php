<?php

namespace App\Actions\CalendarEvents;

use App\Models\ContactAttempt;
use App\Models\User;
use App\Models\VisitAppointment;

class getMyEvents
{
    public function handle(User $user)
    {
        $events = [];
        $visitsQuery = VisitAppointment::with(['technician', 'expedient'])
            ->where('technician_id', $user->id)
            ->get();

        foreach ($visitsQuery as $visit){
            array_push($events, [
                'id' => $visit->id,
                'title' => $visit->expedient->full_code,
                'start' => $visit->localize('date_time'),
                'color' => 'rgb(219, 39, 119)', //pink-600
                'url' => route('expedient.edit', $visit->expedient_id) . '?showSubmenu=management',
                'extendedProps' => [
                    'state' => $visit->expedient->address->city,
                    'address' => $visit->expedient->address->address,
                    'full_address' => $visit->expedient->address->full_address,
                    'icon' => '<svg class="w-4 h-4 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                            </svg>'
                ]
            ]);
        }

        $contactsQuery = ContactAttempt::with(['user', 'expedient'])
            ->where('user_id', $user->id)
            ->where('attempt_type', 'phone')
            ->get();

        foreach ($contactsQuery as $contact){
            array_push($events, [
                'id' => 'contact' . $contact->id,
                'title' => $contact->expedient->full_code,
                'start' => $contact->localize('time'),
                'color' => 'rgb(124, 58, 237)', //purple-600
                'url' => route('expedient.edit', $contact->expedient_id) . '?showSubmenu=management',
                'extendedProps' => [
                    'state' => '',
                    'address' => $contact->expedient->address->address,
                    'full_address' => $contact->expedient->address->full_address,
                    'icon' => '<svg class="w-4 h-4 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>'
                ]
            ]);
        }

        return $events;
    }
}
