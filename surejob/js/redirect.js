function redirect(msg) {
  if (msg == 'success-msg') {
    return setTimeout(() => (document.location = 'login.php'), 1500);
  }
}
