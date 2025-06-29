const fullname = document.getElementById('name');
const phone = document.getElementById('phone');
const address = document.getElementById('address');
const city = document.getElementById('city');
const state = document.getElementById('state');
const nameError = document.getElementById('nameError');
const phoneError = document.getElementById('phoneError');
const addressError = document.getElementById('addressError');
const cityError = document.getElementById('cityError');

const addressform = document.getElementById('addressForm');

addressform.addEventListener('submit', (e) => {
  e.preventDefault();

  let isValid = true;

  nameError.textContent = '';
  phoneError.textContent = '';
  addressError.textContent = '';
  cityError.textContent = '';

  if (fullname.value.trim() === '') {
    nameError.textContent = 'Name is required.';
    isValid = false;
  }

  if (!/^\d{10}$/.test(phone.value)) {
    phoneError.textContent = 'Phone number must be 10 digits.';
    isValid = false;
  }

  if (address.value.trim() === '') {
    addressError.textContent = 'Address is required.';
    isValid = false;
  }
  
  if(city.value.trim() === ''){
    cityError.textContent = 'City is required. ';
    isValid = false;
  }

  if (isValid) {

    const formdata = new FormData();
    formdata.append('fullname',fullname.value);
    formdata.append('phone',phone.value);
    formdata.append('address',address.value);
    formdata.append('city',city.value);
    formdata.append('state',state.value);

    fetch('add_address_data.php',{
      method: 'POST',
      body: formdata
    })
    .then((response) => 
      response.text()
    )
    .then((data) => {
      addressform.reset();
      window.location.href = "address.php";
    })
    .catch((error) => {
      console.error(error);
  });

  }

});
