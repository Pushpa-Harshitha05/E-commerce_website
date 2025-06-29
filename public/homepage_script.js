function search(){
  let a=document.getElementById('mySelect').value.toLowerCase();
  if(a != ''){
    window.location.href = a+'.php';
  }
}


function changeoption(){
   setTimeout(() => {
      let a=document.getElementById('mySelect').value.toLowerCase();
      if(a != ''){
         window.location.href = a+'.php';
      }
   }, 800);
}


// homepage.php drop-down menu
document.addEventListener('DOMContentLoaded', () => {
   const profileImg = document.getElementById('profileimg');
   const dropdownMenu = document.getElementById('dropdownMenu');

   if(profileImg && dropdownMenu){
      profileImg.addEventListener('click', () => {
         if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
         } else {
            dropdownMenu.style.display = 'block';
         }
      });
   }
});


document.addEventListener('click', (event) => {
   // (!event.target.closest('.profile-container')) - Returns true if the clicked element is not inside the .profile-container. This means the user clicked outside the container.
   if (!event.target.closest('.profile-container')) {
      dropdownMenu.style.display = 'none';
   }
});


// homepage.php items
const itembtns = document.querySelectorAll('.items');

itembtns.forEach(button => {
   button.addEventListener('click', () => {
      let type = document.getElementById('product-type').innerHTML;
      if(type == 'mouse'){
         window.location.href = type+".php";
      }
      else{
         window.location.href = type+"s.php";
      }
   });
});


// myprofile.php
const addressbtn = document.querySelectorAll('.addresses');
const ordersbtn = document.querySelectorAll('.orders');
const cartbtn = document.querySelectorAll('.cart');
const editloginbtn = document.querySelectorAll('.login');

addressbtn.forEach(element => {
   element.addEventListener('click', () => {
      window.location.href = "address.php";
   });
});

ordersbtn.forEach(element => {
   element.addEventListener('click', () => {
      window.location.href = "orders.php";
   });
});

cartbtn.forEach(element => {
   element.addEventListener('click', () => {
      window.location.href = "shopping_cart.php";
   });
});

editloginbtn.forEach(element => {
   element.addEventListener('click', () => {
      window.location.href = "editlogin.php";
   });
});


// address.php add address
const addaddr = document.querySelectorAll('.add-addr');

addaddr.forEach(addrbtn => {
   addrbtn.addEventListener('click', () => {
      window.location.href = "add_address.html";
   });
});


// delete the address.
const removebtn = document.querySelectorAll('.removebtn');

removebtn.forEach(removeaddr => {
   removeaddr.addEventListener('click', (e) => {

      const changebtn = e.target.closest('.addr-display').querySelectorAll('p');
      let ind = 0;
      let data = ['phone','address','city','state'];

      const formData = new FormData();

      formData.append('type','remove');

      changebtn.forEach(cbtn => {
         if(cbtn.innerHTML.includes(':')){
            formData.append(data[ind],cbtn.innerHTML.split(": ")[1]);
            ind += 1;
         }
         else{
            formData.append('fullname',cbtn.innerHTML);
         }
      });
      
      fetch('add_address_data.php', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.text())
        .then((data) => {
         window.location.href = "address.php";
        })
        .catch(error => console.error('Error:', error));
   })
});