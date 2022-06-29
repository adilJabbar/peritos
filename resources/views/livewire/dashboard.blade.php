<div>
    @section('timezone')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Livewire.emit('timezoneData', Intl.DateTimeFormat().resolvedOptions().timeZone);
            });
        </script>
    @endsection
</div>
