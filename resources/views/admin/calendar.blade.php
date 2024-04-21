<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script><script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true, // Permet la modification des événements par glisser-déposer
                selectable: true, // Permet la sélection de dates pour créer de nouveaux événements
                events: {!! json_encode($events) !!},
                eventClick: function(info) { // Gérer le clic sur un événement existant
                    if (confirm("Voulez-vous supprimer cet événement?")) {
                        info.event.remove(); // Supprime l'événement en cas de confirmation
                    }
                },
                select: function(info) { // Gérer la sélection d'une plage de dates
                    const title = prompt('Entrez le titre de l\'événement:')
                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: info.start,
                            end: info.end,
                            allDay: info.allDay
                        })
                    }
                    $.ajax({
                        url:"{{route('addEvent')}}",
                        method:"POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            name:title,
                            date :info.start
                        }
                    })
                    calendar.unselect() // Désélectionne la plage de dates après avoir ajouté l'événement
                }
            })
            calendar.render()
        })

    </script>
</head>
<body>
<div id='calendar'></div>
</body>
</html>
