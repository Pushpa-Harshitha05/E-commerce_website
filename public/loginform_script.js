document.getElementById('showconpass').addEventListener("click", () => {
  let passcontent = document.getElementById('passwor');
  let passimg = document.getElementById('showconpass');

  if(passcontent.type === "password"){
      passcontent.type = "text";
      passimg.src = "images/form_imgs/hidden.png";
      passimg.alt = "Hide";
  }

  else{
      passcontent.type = "password";
      passimg.src = "images/form_imgs/view.png";
      passimg.alt = "Show";
  }
});