<?= $this->extend('templates/dashboard_user/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0 text-white">Calendar Tasks</h5>
          <div class="btn-group btn-group-sm" role="group" aria-label="View Switch">
            <button class="btn btn-light" id="monthView">Month</button>
            <button class="btn btn-light" id="weekView">Week</button>
          </div>
        </div>
        <div class="card-body p-0">
          <div id="calendar" style="padding: 20px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script Kalender -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'id',
      events: "<?= site_url('user/calendar/events') ?>",
      headerToolbar: {
        left: 'prev,next today',
        center: '',
        right: 'title'
      },
      height: 600,
      selectable: true,
      eventClick: function(info) {
        info.jsEvent.preventDefault();
        if (info.event.url) {
          window.open(info.event.url, '_blank');
        }
      }
    });

    calendar.render();

    // Fungsi untuk set tombol aktif
    function setActiveButton(activeId) {
      ['monthView', 'weekView'].forEach(function (id) {
        document.getElementById(id).classList.remove('active');
      });
      if (activeId) {
        document.getElementById(activeId).classList.add('active');
      }
    }

    // Kontrol tombol custom
    document.getElementById('monthView').addEventListener('click', function () {
      calendar.changeView('dayGridMonth');
      setActiveButton('monthView');
    });

    document.getElementById('weekView').addEventListener('click', function () {
      calendar.changeView('listWeek');
      setActiveButton('weekView');
    });

    // Set default active
    setActiveButton('monthView');
  });
</script>

<?= $this->endSection() ?>
