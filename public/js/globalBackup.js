document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-action="backup"]').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            // Show loading screen
            document.getElementById('loading-screen').style.display = 'block';

            // Perform AJAX request
            fetch(link.dataset.url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                // Hide loading screen
                document.getElementById('loading-screen').style.display = 'none';

                // Display SweetAlert success message
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('loading-screen').style.display = 'none';
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred. Please try again.',
                    confirmButtonText: 'OK'
                });
            });
        });
    });
});
