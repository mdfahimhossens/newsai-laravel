  const pwd = document.getElementById('password');
  const btn = document.querySelector('.toggle-password');

  btn.addEventListener('click', () => {
    const isHidden = pwd.type === 'password';
    pwd.type = isHidden ? 'text' : 'password';
    btn.setAttribute('aria-pressed', String(isHidden)); // accessibility
    btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
    // optional: change icon
    btn.textContent = isHidden ? '🙈' : '👁️';
  });


