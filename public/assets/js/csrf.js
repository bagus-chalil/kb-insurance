let csrfToken;

// Fungsi untuk mendapatkan token CSRF
function getCsrfToken() {
    return $.ajax({
        url: '/csrf-token',
        type: 'GET',
        success: function(response) {
            csrfToken = response.csrfToken;

            // Update meta tag
            $('meta[name="csrf-token"]').attr('content', csrfToken);

            // Perbarui setup AJAX global
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        },
        error: function(xhr, status, error) {
            console.error("CSRF Token Error:", error);
        }
    });
}

// Perbarui token CSRF setiap 10 menit
setInterval(getCsrfToken, 10 * 60 * 1000);

// Panggil saat halaman dimuat
$(document).ready(function() {
    getCsrfToken();

    // Timeout session pengguna
    const sessionTimeout = 90 * 60 * 1000; // 90 menit
    const warningTime = 5 * 60 * 1000; // 5 menit sebelum timeout

    function showWarningAlert(seconds) {
        Swal.fire({
            title: 'Session Akan Berakhir!',
            html: `<p>Mohon lakukan aksi sebelum sesi Anda habis.</p>
                   <p>Sisa waktu: <strong id="countdown">${Math.floor(seconds / 60)}m ${seconds % 60}s</strong></p>`,
            icon: 'warning',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                const countdownInterval = setInterval(() => {
                    seconds--;
                    const minutes = Math.floor(seconds / 60);
                    const secondsLeft = seconds % 60;
                    document.getElementById('countdown').textContent = `${minutes}m ${secondsLeft}s`;
                    if (seconds <= 0) {
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            },
        });
    }

    function showSessionExpiredAlert() {
        Swal.fire({
            title: 'Session Expired!',
            text: 'Sesi Anda telah berakhir. Silakan login kembali.',
            icon: 'error',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonText: 'Login Ulang',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/login'; // Sesuaikan dengan URL login/logout
            }
        });
    }

    setTimeout(function() {
        showWarningAlert(warningTime / 1000);
    }, sessionTimeout - warningTime);

    setTimeout(function() {
        showSessionExpiredAlert();
    }, sessionTimeout);
});
