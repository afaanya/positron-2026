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

    const eventDates = [
        { day: 19, month: 7, year: 2026 },
        { day: 20, month: 7, year: 2026 },
        { day: 11, month: 9, year: 2026 },
        { day: 24, month: 9, year: 2026 },
        { day: 20, month: 10, year: 2026 }
    ];

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

    const events = [
        { name: 'FORUM MABA 2026', day: 19, month: 7, year: 2026 },
        { name: 'LDK 2026', day: 11, month: 9, year: 2026 },
        { name: 'IOH 2026', day: 24, month: 9, year: 2026 },
        { name: 'NAKO 2026', day: 20, month: 10, year: 2026 }
    ];

    const monthEvents = events.filter(event => event.year === currentYear && event.month === currentMonth);

    if (monthEvents.length === 0) {
    document.getElementById('countdownDisplay').innerHTML = 
    '<strong style="font-size:18px; line-height:1.6; display:block; text-align:center;">TIDAK ADA<br>ACARA<br>PADA BULAN INI</strong>';
    return;
}

    const buildCountdown = (event) => {
        const targetDate = new Date(currentYear, event.month, event.day);
        const diff = targetDate - now;
        const isToday = now.getDate() === event.day && now.getMonth() === event.month && now.getFullYear() === event.year;

        if (diff < 0 || isToday) {
            return `<div style="margin-bottom:10px;"><strong style="font-size:18px;">${event.name} sedang berlangsung 🎉</strong></div>`;
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

        return `
            <div style="margin-bottom:10px;">
                <span style="font-size:16px;">${days} hari | ${hours} jam | ${minutes} menit</span><br>
                <strong style="font-size:18px;">${event.name}</strong>
            </div>`;
    };

    document.getElementById('countdownDisplay').innerHTML = monthEvents.map(buildCountdown).join('');
}

updateCountdown();
setInterval(updateCountdown, 1000);

updateCalendar();

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
