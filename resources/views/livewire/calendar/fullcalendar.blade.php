<x-card.card>
    <x-card.body>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </x-card.body>
</x-card.card>

@section('fullcalendar')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            // var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            // var checkbox = document.getElementById('drop-remove');
            var data =   @this.events;
            var calendar = new Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                views: {
                    timeGrid: {
                        usesMinMaxTime: !0,
                        allDaySlot: !0,
                        slotDuration: "00:30:00",
                        slotEventOverlap: !0
                    },
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                events: JSON.parse(data),
                eventContent: function(arg) {
                    if (arg.view.type == 'timeGridWeek' || arg.view.type == 'timeGridDay'){
                        return {
                            html: '' +
                                '<div class="flex justify-between">' +
                                '   <div class="flex space-x-1">' +
                                '       <span class="font-bold">' + arg.timeText + '</span>' + arg.event.extendedProps.icon + '' +
                                '   </div>' +
                                '   <span class="text-xs">' + arg.event.title + '</span>' +
                                '</div>' +
                                '<span class="font-bold mr-2">' + arg.event.extendedProps.state + '</span>' +
                                '<span class="text-xs font-light">' + arg.event.extendedProps.address + '</span>'
                        }
                    } else if (arg.view.type == 'listMonth'){
                        return {
                            html: '' +
                                '<a href="' + arg.event.url + '">' +
                                '<div class="flex justify-between">' +
                                '   <div class="flex space-x-1">' +
                                '       <div class="font-bold">' + arg.timeText + '</div>' +
                                '       <div>' + arg.event.extendedProps.icon + '</div>' +
                                '       <span>' + arg.event.title + '</span>' +
                                '   </div>' +
                                '</div>' +
                                '<span class="text-xs font-light">' + arg.event.extendedProps.full_address + '</span>' +
                                '</a>'
                        }
                    }
                },
                navLinks: true,
                firstDay: {{ App::getLocale() == 'es' ? 1 : 0 }},
                displayEventTime: true,
                weekNumbers: true,
                slotMinTime: "07:00:00",
                selectable: true,
                dayMaxEventRows: true,



                // dateClick(info)  {
                //     var title = prompt('Enter Event Title');
                //     var date = new Date(info.dateStr + 'T00:00:00');
            {{--        if(title != null && title != ''){--}}
            {{--            calendar.addEvent({--}}
            {{--                title: title,--}}
            {{--                start: date,--}}
            {{--                allDay: true--}}
            {{--            });--}}
            {{--            var eventAdd = {title: title,start: date};--}}
            {{--            @this.addevent(eventAdd);--}}
            {{--            alert('Great. Now, update your database...');--}}
            {{--        }else{--}}
            {{--            alert('Event Title Is Required');--}}
            {{--        }--}}
            //     },
                // editable: true,
            {{--    droppable: true, // this allows things to be dropped onto the calendar--}}
            {{--    drop: function(info) {--}}
            {{--        // is the "remove after drop" checkbox checked?--}}
            {{--        if (checkbox.checked) {--}}
            {{--            // if so, remove the element from the "Draggable Events" list--}}
            {{--            info.draggedEl.parentNode.removeChild(info.draggedEl);--}}
            {{--        }--}}
            {{--    },--}}
            {{--    eventDrop: info => @this.eventDrop(info.event, info.oldEvent),--}}
                loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });
            calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });
            calendar.setOption('locale', '{{ App::getLocale() }}');
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
@endsection
