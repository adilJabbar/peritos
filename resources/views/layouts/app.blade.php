<x-layouts.base>

    <div class="" style="">
        <div>

            <div class="h-screen overflow-hidden bg-gray-100 flex flex-col">
                <!-- Top nav-->
                <header x-data="{ open: false }"
                        class="flex-shrink-0 relative h-16 bg-white flex items-center border-b border-gray-800">
                    <!-- Logo area -->
                    <div class="absolute inset-y-0 left-0 md:static md:flex-shrink-0">
                        <x-branding.square-logo/>
                    </div>

                    <!-- Mobiles Picker area -->
                    <div class="mx-auto md:hidden">
                        <livewire:layout.menu.mobiles-picker-area/>
                    </div>

                    <!-- Menu button area -->
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center sm:pr-6 md:hidden">
                        <!-- Mobile menu button -->
                        <livewire:layout.menu.hamburguer/>
                    </div>

                    <!-- Desktop nav area -->
                    <div class="hidden md:min-w-0 md:flex-1 md:flex md:items-center md:justify-between">
                        <livewire:layout.menu.search/>

                        <livewire:layout.menu.top-links/>

                    </div>

                    <!-- Mobile menu, show/hide this `div` based on menu open/closed state -->
                    <livewire:layout.menu.side-panel/>

                </header>

                <!-- Bottom section -->
                <div class="min-h-0 flex-1 flex overflow-hidden">
                    <!-- Narrow sidebar-->
                    <livewire:layout.menu.nav-side-bar/>

                    <!-- Main area -->
                    <div class="flex-grow overflow-auto">
                        {{ $slot }}
                    </div>
                </div>
            </div>

        </div>
    </div>


    <x-slot name="styles">
        {{--        @yield('css-trix')--}}
        @yield('trix-editor')
        @yield('css-filepond')
        <link rel="stylesheet" href="{{ asset('css/choices.css') }}"/>
        <script src="{{ asset('js/choices.js') }}"></script>
    </x-slot>

    <x-slot name="scripts">
        {{--        @yield('trix')--}}
        @yield('filepond')
        @yield('timezone')
        @yield('text-area')
        @yield('fullcalendar')
        @yield('twilio-video')

        <x-notification.notification/>

        <script>


            // var time;
            // var model;
            // var id;
            // var name;
            //
            // function inactivityTime (model, id, user, name) {
            //
            // }
            //
            // function userIdleOut() {
            //     alert('out');
            //     Livewire.emit('idleOutWorkTime', model, id, name);
            // }
            //
            // function resetTimer() {
            //     clearTimeout(time);
            //     time = setTimeout(userIdleOut, 300000)
            //     // 1000 milliseconds = 1 second
            // }

            var time;
            var _model;
            var _id;
            var _name;
            Livewire.on('loadedWorkTimeArea', (newModel, newId, newName) => {
                clearTimeout(time);
                inactivityTime(newModel, newId, newName);
            })

            var inactivityTime = function (model, id, name) {
                _model = model;
                _id = id;
                _name = name;

                resetTimer();
                window.onload = resetTimer;
                // DOM Events
                document.onmousemove = resetTimer;
                document.onmousedown = resetTimer; // touchscreen presses
                document.ontouchstart = resetTimer;
                document.onclick = resetTimer;     // touchpad clicks
                document.onkeydown = resetTimer;

                document.addEventListener('scroll', resetTimer, true); // improved

                function userIdleOut() {
                    Livewire.emit('idleOutWorkTime', model, id, name);
                }

                function resetTimer() {
                    clearTimeout(time);
                    time = setTimeout(userIdleOut, 900000)
                    // 1000 milliseconds = 1 second
                }


            };

            // window.addEventListener('beforeunload', function (e) {
            //     e.preventDefault();
            //     e.returnValue = '';
            //     Livewire.emit('idleOutWorkTime', _model, _id, _name);
            // });
            // window.onbeforeunload = function (e) {
            //     Livewire.emit('idleOutWorkTime', _model, _id, _name);
            //     debugger;
            //     console.log(e);
            //     debugger
            // };


        </script>

        @yield('workTime')

    </x-slot>

</x-layouts.base>
