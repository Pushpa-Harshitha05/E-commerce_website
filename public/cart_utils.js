document.addEventListener('DOMContentLoaded', () => {
  const cartcountele = document.getElementById('cartcount');

  function displaycartcount(){
     fetch('update_cartcount.php')
        .then((response) => {
          console.log(response.text);
           return response.text;
        })
        .then((data) => {
           cartcountele.textContent = data;
        })
        .catch((error) => {
           console.error(error);
     });
  }

  displaycartcount();

  setInterval(() => {
     displaycartcount();
  }, 10000);
});