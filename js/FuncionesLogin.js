function login() {
    const form = document.getElementById('loginForm');
    const formData = new FormData(form);

    fetch('./controller/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error: ${response.status} ${response.statusText}`);
        }
        return response.text();
    })
    .then(result => {
        document.getElementById('loginResult').innerHTML = result;

        if (result.includes('alert alert-danger')) {
            return;
        }

        window.location.href = "./administrativo/dashboard.php";
    })
    .catch(error => {
        console.error(error);
        document.getElementById('loginResult').innerHTML = '<div class="alert alert-danger">' + error.message + '</div>';
    });
}

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    login();
});
