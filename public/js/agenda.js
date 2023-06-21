document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('agenda');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'UTC',
        initialView: 'timeGridFourDay',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'timeGridDay,timeGridFourDay'
        },
        views: {
            timeGridFourDay: {
                type: 'timeGrid',
                duration: { days: cantidadDias },
                slotMinTime: "07:00:00",
                slotMaxTime: "22:00:00",
                allDaySlot: false,
                buttonText: 'Semana',
                dayHeaderContent: function(arg) {
                    // Reemplaza los títulos con los valores de tu consulta
                    var dayIndex = arg.date.getDay();
                    console.log(dayIndex);
                    if (horarios.length != 100) {
                        return horarios[dayIndex].area;
                    } else {
                        return '';
                    }
                }
            },
            timeGridDay: {
                allDaySlot: false,

            }

        },
        events: "http://localhost/cursosCTA/public/agenda/mostrar",
        // events: 'https://fullcalendar.io/api/demo-feeds/events.json'
    });

    calendar.render();
});
