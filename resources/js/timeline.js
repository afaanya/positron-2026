function updateClock() {
    const now = new Date();
    const seconds = now.getSeconds();
    const minutes = now.getMinutes();
    const hours = now.getHours() % 12;

    const secondsDegrees = (seconds / 60) * 360;
    const minutesDegrees = (minutes / 60) * 360 + (seconds / 60) * 6;
    const hoursDegrees = (hours / 12) * 360 + (minutes / 60) * 30;

    const setHand = (id, degrees) => {
        const element = document.getElementById(id);
        if (element) {
            element.style.transform = `rotate(${degrees}deg)`;
        }
    };

    setHand('js-second', secondsDegrees);
    setHand('js-minute', minutesDegrees);
    setHand('js-hour', hoursDegrees);
}

setInterval(updateClock, 1000);
updateClock();

let currentCalendarDate = new Date();

// Data acara: startDate & endDate agar mendukung acara multi-hari
// (mis. Forum Maba 28-29 Agustus 2026). Urutan array ini SAMA dengan
// urutan titik 1-4 di peta perjalanan (index 0 = titik 1, dst).
const timelineEventsData = [
    { name: 'FORUM MABA 2026', startDate: new Date(2026, 7, 28), endDate: new Date(2026, 7, 29, 23, 59, 59) },
    { name: 'LDK 2026', startDate: new Date(2026, 9, 11), endDate: new Date(2026, 9, 11, 23, 59, 59) },
    { name: 'IOH 2026', startDate: new Date(2026, 9, 24), endDate: new Date(2026, 9, 24, 23, 59, 59) },
    { name: 'NAKO 2026', startDate: new Date(2026, 10, 20), endDate: new Date(2026, 10, 20, 23, 59, 59) }
];

const H7_MS = 7 * 24 * 60 * 60 * 1000;

// Tanggal-tanggal yang harus diberi lingkaran di kalender.
// Hanya aktif mulai H-7 sebelum acara sampai acara tersebut berakhir.
function getEventDatesForCalendar() {
    const now = new Date();
    const dates = [];

    timelineEventsData.forEach(event => {
        const diffToStart = event.startDate - now;
        const isWithinWindow = diffToStart <= H7_MS && now <= event.endDate;

        if (!isWithinWindow) return;

        let d = new Date(event.startDate.getFullYear(), event.startDate.getMonth(), event.startDate.getDate());
        const endDay = new Date(event.endDate.getFullYear(), event.endDate.getMonth(), event.endDate.getDate());

        while (d <= endDay) {
            dates.push({ day: d.getDate(), month: d.getMonth(), year: d.getFullYear() });
            d.setDate(d.getDate() + 1);
        }
    });

    return dates;
}

function updateCalendar() {
    const now = new Date();
    const year = currentCalendarDate.getFullYear();
    const month = currentCalendarDate.getMonth();

    const monthNames = ["JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI",
                        "JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
    const dayNames = ["M","S","S","R","K","J","S"];

    document.getElementById('cal-header').innerText = monthNames[month] + ' ' + year;

    const firstDay = new Date(year, month, 1).getDay();
    const startDay = firstDay;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let html = '<tr>';
    dayNames.forEach((d, idx) => {
        const color = idx === 0 ? '#ff4444' : '#c8a96e';
        html += `<td style="padding:0px 1px; color:${color}; font-weight:bold;">${d}</td>`;
    });
    html += '</tr><tr>';

    let day = 1;
    for (let i = 0; i < startDay; i++) html += '<td style="padding:0 4px; height:12px; width:13px"></td>';

    const eventDates = getEventDatesForCalendar();

    for (let i = startDay; i < 42; i++) {
        if (day > daysInMonth) break;
        if (i % 7 === 0 && i !== startDay) html += '</tr><tr>';
        const isToday = day === now.getDate() && month === now.getMonth() && year === now.getFullYear();
        const isSunday = i % 7 === 0;
        const isEventDate = eventDates.some(event => event.day === day && event.month === month && event.year === year);
        const textColor = isSunday ? '#ff4444' : (isToday ? '#fff' : '#c8a96e');
        const fontWeight = isToday || isSunday ? 'bold' : 'normal';
        const borderStyle = isEventDate ? 'border:2px solid #F8D794; border-radius:50%; padding:2px; display:inline-block; min-width:13px; text-align:center;' : '';
        html += `<td style="padding:0 4px; height:12px; width:13px; color:${textColor}; font-weight:${fontWeight}; ${borderStyle}">${day}</td>`;
        day++;
    }
    html += '</tr>';

    document.getElementById('cal-table').innerHTML = html;
}

function updateCountdown() {
    const now = new Date();
    const currentYear = currentCalendarDate.getFullYear();
    const currentMonth = currentCalendarDate.getMonth();

    const monthEvents = timelineEventsData.filter(event =>
        (event.startDate.getFullYear() === currentYear && event.startDate.getMonth() === currentMonth) ||
        (event.endDate.getFullYear() === currentYear && event.endDate.getMonth() === currentMonth)
    );

    if (monthEvents.length === 0) {
        document.getElementById('countdownDisplay').innerHTML =
        '<strong style="font-size:18px; line-height:1.6; display:block; text-align:center;">TIDAK ADA<br>ACARA<br>PADA BULAN INI</strong>';
        return;
    }

    const buildCountdown = (event) => {
        const diffToStart = event.startDate - now;
        const diffToEnd = event.endDate - now;

        // Acara sudah berakhir
        if (diffToEnd < 0) {
            return `<div style="margin-bottom:10px;"><strong style="font-size:18px;">${event.name} telah selesai</strong></div>`;
        }

        // Sedang berlangsung: dari tanggal mulai sampai tanggal selesai
        if (diffToStart <= 0 && diffToEnd >= 0) {
            return `<div style="margin-bottom:10px;"><strong style="font-size:18px;">${event.name} sedang berlangsung 🎉</strong></div>`;
        }

        const days = Math.floor(diffToStart / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diffToStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diffToStart % (1000 * 60 * 60)) / (1000 * 60));

        return `
            <div style="margin-bottom:10px;">
                <span style="font-size:16px;">${days} hari | ${hours} jam | ${minutes} menit</span><br>
                <strong style="font-size:18px;">${event.name}</strong>
            </div>`;
    };

    document.getElementById('countdownDisplay').innerHTML = monthEvents.map(buildCountdown).join('');
}

// === Titik-titik di Peta Perjalanan ===
// Status tiap titik (1-4 -> index 0-3):
//   'dark'        -> belum mendekati acara, masih gelap/redup
//   'approaching' -> sudah masuk H-7, mulai menyala (glow berkedip)
//   'active'      -> hari H, menyala penuh & berdenyut
//   'completed'   -> sudah lewat, tetap terang (tidak berkedip)
function getPinState(event, now) {
    const diffToStart = event.startDate - now;
    const diffToEnd = event.endDate - now;

    if (diffToEnd < 0) return 'completed';
    if (diffToStart <= 0 && diffToEnd >= 0) return 'active';
    if (diffToStart <= H7_MS) return 'approaching';
    return 'dark';
}

function updateMapPins() {
    const now = new Date();

    timelineEventsData.forEach((event, index) => {
        const state = getPinState(event, now);
        const circle = document.getElementById('map-pin-' + index);
        const number = document.getElementById('map-pin-number-' + index);
        const label = document.getElementById('map-pin-label-' + index);
        const stateClasses = ['pin-dark', 'pin-approaching', 'pin-active', 'pin-completed'];

        [circle, number, label].forEach(el => {
            if (!el) return;
            el.classList.remove(...stateClasses);
            el.classList.add('pin-' + state);
        });
    });
}

updateCountdown();
setInterval(updateCountdown, 1000);

updateCalendar();

updateMapPins();
setInterval(updateMapPins, 60000);

document.getElementById('prevMonthBtn').addEventListener('click', function() {
    currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
    updateCalendar();
    updateCountdown();
});

document.getElementById('nextMonthBtn').addEventListener('click', function() {
    currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
    updateCalendar();
    updateCountdown();
});