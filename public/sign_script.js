const firname = document.getElementById('firname');
const email = document.getElementById('emai');
const passwordcheck1 = document.getElementById('pass1');
const passwordcheck2 = document.getElementById('pass2');
const form = document.getElementById('form');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let isvalid = true;

    if(firname.value.trim() === ''){
        let nameError = document.getElementById('nameError');
        nameError.textContent = 'name should not be empty';
        isvalid = false;
    }

    if(email.value.trim() === ''){
        let mailError = document.getElementById('mailError');
        mailError.textContent = 'email should not be empty';
        isvalid = false;
    }

    if(passwordcheck1.value.trim() === ''){
        let pass1Error = document.getElementById('pass1Error');
        pass1Error.textContent = 'password should not contain space';
        isvalid = false;
    }

    if(passwordcheck2.value.trim() === ''){
        let pass2Error = document.getElementById('pass2Error');
        pass2Error.textContent = 'password should not contain space';
        isvalid = false;
    }

    if(isvalid){

        const formdata = new FormData();
        formdata.append('firname',firname.value);
        formdata.append('email',email.value);
        formdata.append('pass1',passwordcheck1.value);
        formdata.append('pass2',passwordcheck2.value);

        fetch('sign.php', {
            method: 'POST',
            body: formdata
        })
        .then((response) => {
            response.text();
        })
        .then((data) => {
            form.reset();
            window.location.href = "loginform.html";
        })
        .catch((error) => {
            console.error(error);
        });
    }
});


document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("pass1").addEventListener("input", () => {
        let p1 = document.getElementById("pass1").value;
        let p2 = document.getElementById("pass2").value;

        if ((p1.length) < 5) {
            document.getElementById("msg").style.display = 'block';
            document.getElementById("msg").innerHTML = "Password should contain atleast 5 letters";
            document.getElementById("msg").style.backgroundColor = 'rgb(248, 118, 118)';
        }
        else{
            if(p1 === p2){
                document.getElementById("msg").style.display = 'block';
                document.getElementById("msg").innerHTML = "Passwords Match";
                document.getElementById("msg").style.backgroundColor = 'rgb(106, 218, 106)';
            }
            else{
                document.getElementById("msg").style.display = 'none';
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("pass2").addEventListener("input", () => {
        let password1 = document.getElementById('pass1').value;
        let password2 = document.getElementById("pass2").value;

        if (((password1.length) < 5)) {
            document.getElementById("msg").style.display = 'block';
            document.getElementById("msg").innerHTML = "Password should contain atleast 5 letters";
            document.getElementById("msg").style.backgroundColor = 'rgb(248, 118, 118)';
        }

        else if(password1 === password2){
            document.getElementById("msg").style.display = 'block';
            document.getElementById("msg").innerHTML = "Passwords Match";
            document.getElementById("msg").style.backgroundColor = 'rgb(106, 218, 106)';
        }
        else{
            document.getElementById("msg").style.display = 'block';
            document.getElementById("msg").innerHTML = "Passwords do not Match!";
            document.getElementById("msg").style.backgroundColor = 'rgb(248, 118, 118)';
        }
    });
});

document.getElementById('showpass').addEventListener("click", () => {
    let passcontent = document.getElementById('pass1');
    let passimg = document.getElementById('showpass');

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

document.getElementById('showconpass').addEventListener("click", () => {
    let passcontent = document.getElementById('pass2');
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