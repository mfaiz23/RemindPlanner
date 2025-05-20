document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('calendarContainer');
    const title = document.getElementById('calendarTitle');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    let currentMonth = parseInt(container.dataset.month);
    let currentYear = parseInt(container.dataset.year);

    function updateCalendar(month, year) {
        fetch(`/calendar?month=${month}&year=${year}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            container.innerHTML = html;
            container.dataset.month = month;
            container.dataset.year = year;
            const date = new Date(year, month - 1);
            title.textContent = date.toLocaleString('default', { month: 'long', year: 'numeric' });
            currentMonth = month;
            currentYear = year;
        });
    }

    prevBtn.addEventListener('click', function () {
        let m = currentMonth - 1, y = currentYear;
        if (m < 1) { m = 12; y--; }
        updateCalendar(m, y);
    });

    nextBtn.addEventListener('click', function () {
        let m = currentMonth + 1, y = currentYear;
        if (m > 12) { m = 1; y++; }
        updateCalendar(m, y);
    });
});
