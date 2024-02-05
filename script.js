document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('login');
  const cadastraForm = document.getElementById('cadastra');
  const toggleLoginLink = document.getElementById('toggleLogin');
  const toggleCadastraLink = document.getElementById('toggleCadastra');

  toggleLoginLink.addEventListener('click', function (e) {
    e.preventDefault();
    loginForm.style.display = 'block';
    cadastraForm.style.display = 'none';
  });

  toggleCadastraLink.addEventListener('click', function (e) {
    e.preventDefault();
    loginForm.style.display = 'none';
    cadastraForm.style.display = 'block';
  });
});
