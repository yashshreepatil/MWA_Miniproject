document.getElementById('loginForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  const response = await fetch('/login', {
    method: 'POST',
    body: new URLSearchParams(formData)
  });

  const result = await response.json();

  if (result.success) {
    window.location.href = result.redirect;
  } else {
    document.getElementById('error-msg').innerText = result.message;
  }
});
