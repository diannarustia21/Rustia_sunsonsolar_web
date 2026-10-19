function showPage(pageId) {
    document.querySelectorAll('.page').forEach((p) => p.classList.remove('active'));

    const p = document.getElementById(pageId);
    if (p) {
        p.classList.add('active');
    }

    window.scrollTo(0, 0);
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registrationForm');
    const p = document.getElementById('password');
    const c = document.getElementById('confirmPassword');

    form?.addEventListener('submit', (e) => {
        if (p.value !== c.value) {
            e.preventDefault();
            c.setCustomValidity('Passwords do not match.');
            c.reportValidity();
        }
    });

    c?.addEventListener('input', () => c.setCustomValidity(''));

    showPage(new URLSearchParams(location.search).get('page') || 'home');
});

function technicianCheckIn(button, bookingId) {
    if (!navigator.geolocation) {
        alert('Geolocation is not supported.');
        return;
    }

    button.disabled = true;

    navigator.geolocation.getCurrentPosition(
        async (pos) => {
            const body = new URLSearchParams({
                latitude: pos.coords.latitude,
                longitude: pos.coords.longitude
            });

            const r = await fetch('/technician/check-in/' + bookingId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body
            });

            const d = await r.json();
            alert(d.message);

            if (r.ok) {
                location.reload();
            } else {
                button.disabled = false;
            }
        },
        () => {
            alert('Location permission is required.');
            button.disabled = false;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000
        }
    );
}
