<?php

namespace App\Http\Livewire;

use App\Actions\CalendarEvents\getMyEvents;
use App\Models\ContactAttempt;
use App\Models\VisitAppointment;
use App\Traits\DataTable\WithBulkActions;
use App\Traits\DataTable\WithPerPagePagination;
use App\Traits\DataTable\WithSorting;
use Livewire\Component;

class Calendar extends Component
{
    use WithSorting, WithBulkActions;

    public $showSubmenu;
    public $events;

    protected $queryString = ['showSubmenu'];

    public function mount()
    {
        ! $this->showSubmenu ? $this->showSubmenu = 'My Calendar' : '';
    }

    public function render()
    {
        if ($this->showSubmenu == 'My Calendar') {
            $action = new getMyEvents();
            $this->events =  $action->handle(auth()->user());
//            return ContactAttempt::query()->where('user_id', auth()->user()->id);
        } elseif ($this->showSubmenu == 'My Visits') {
//            return VisitAppointment::query()->select('id','address as title','date_time as start')->with(['technician', 'expedient:id,full_code'])->where('technician_id', auth()->user()->id);
        } else {
//            return VisitAppointment::query()->with('technician')->where('user_id', auth()->user()->id);
        }
//        dd($this->events);
//        $events = VisitAppointment::select('id','address as title','date_time as start')->get();
//        $this->events = json_encode($events);
        $this->events = (json_encode($this->events));
        return view('livewire.calendar');
    }
}
