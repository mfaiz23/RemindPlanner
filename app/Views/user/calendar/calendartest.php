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

<!-- Task Detail Modal -->
<div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold text-light" id="taskDetailModalLabel">Task Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <h6 class="fw-bold ">Title:</h6>
          <p id="taskTitle" class="mb-2"></p>
        </div>
        <div class="mb-3">
          <h6 class="fw-bold">Description:</h6>
          <p id="taskDescription" class="mb-2"></p>
        </div>
        <div class="mb-3">
          <h6 class="fw-bold">Due Date:</h6>
          <p id="taskDueDate" class="mb-2"></p>
        </div>
        <div class="mb-3">
          <h6 class="fw-bold">Status:</h6>
          <p id="taskStatus" class="mb-2"></p>
        </div>
        <div class="mb-3">
          <h6 class="fw-bold">Category:</h6>
          <p id="taskCategory" class="mb-2"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a id="taskEditLink" href="#" class="btn btn-primary">Edit Task</a>
      </div>
    </div>
  </div>
</div>

<!-- Script Kalender -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var taskModal = new bootstrap.Modal(document.getElementById('taskDetailModal'));
    
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
        
        // Set modal content with task details
        document.getElementById('taskTitle').textContent = info.event.title || 'No title';
        document.getElementById('taskDescription').textContent = info.event.extendedProps.description || 'No description';
        document.getElementById('taskDueDate').textContent = info.event.start ? info.event.start.toLocaleDateString() : 'No due date';
        document.getElementById('taskStatus').textContent = info.event.extendedProps.status || 'No status';
        document.getElementById('taskCategory').textContent = info.event.extendedProps.category_name || 'No category';
        
        // Set edit link if task ID is available
        if (info.event.extendedProps.taskId) {
          document.getElementById('taskEditLink').href = "<?= site_url('/tasks/edit/') ?>" + info.event.extendedProps.taskId;
        } else {
          document.getElementById('taskEditLink').style.display = 'none';
        }
        
        // Show the modal
        taskModal.show();
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