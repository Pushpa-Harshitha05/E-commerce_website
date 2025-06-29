// address.php edit address
document.addEventListener('DOMContentLoaded', () => {
  const editaddr = document.querySelectorAll('.editbtn');

  editaddr.forEach(editbtn => {
     editbtn.addEventListener('click', (event) => {
        window.location.href = "add_address.html";
     });
  });
});