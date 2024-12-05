<?php include('app/header.php');


$reservas =sp('RESERVAS_CALENDARIO_ALL()');

foreach ($reservas as $r) {
  // Create a new event object with the required properties
  $formattedEvent = [
      'title' => $r['MODELO']."-".$r['PATENTE'],
      'start' => $r['FECHA_RETIRO'],
      'end' => $r['FECHA_ENTREGA'],
      'url' => 'http://localhost/3wheels/cotizador/admin/nueva-reserva?r='.$r['ID'],
      'backgroundColor' => '#'.$r['PATENTE'].substr(0,5), // Set your desired background color here
      // Add more properties as needed
  ];

  // Add the formatted event object to the array
  $formattedEvents[] = $formattedEvent;
}
// Convert the formatted events array to JSON
$formattedReservas = json_encode($formattedEvents);


?>
<script src='./fullcalendar-6.1.11/dist/index.global.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
    initialDate: new Date().toISOString().slice(0, 10),
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
    select: function(arg) {
      var modelo = prompt('Modelo:');
      var patente = prompt('Patente:');
      if (modelo && patente) {
        calendar.addEvent({
        title: modelo + " - " + patente,
        start: arg.start,
        end: arg.end,
        allDay: arg.allDay
        });
      }
        calendar.unselect()
      },
    // Your other options...
    eventRender: function(info) {
      var eventsOnSameDate = info.view.calendar.getEvents().filter(function(event) {
        return event.start.toDateString() === info.event.start.toDateString() && event.id !== info.event.id;
      });

      if (eventsOnSameDate.length > 0) {
        // Change the background color if there are other events on the same date
        info.el.style.backgroundColor = 'red'; // Change to your desired color
      }
    },
      eventClick: function(arg) {
        // if (confirm('Borrar el evento?')) {
        //   arg.event.remove()
        // }
        if (arg.event.url) {
          window.open(info.event.url);
        }
      },
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: <?php echo $formattedReservas; ?>
    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->
  <div id='calendar'></div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include('app/footer.php');?>