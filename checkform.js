
let errori = {
    errnome: 0,
    errcognome: 0,
    errusername: 0,
    erremail: 0,
    errpassword: 0
};


const nome = document.querySelector('#nome input');
const cognome = document.querySelector('#cognome input');
const username = document.querySelector('#username input');
const email = document.querySelector('#email input');
const password = document.querySelector('#password input');

nome.addEventListener('blur', checknome);
cognome.addEventListener('blur', checkcognome);
username.addEventListener('blur', checkUsername);
email.addEventListener('blur', checkemail);
password.addEventListener('blur', checkPassword);

function checknome(event){
    const check = event.currentTarget;
    console.log(check);
    console.log(check.value.length);
    if(check.value.length == 0){
        check.classList.add('errore');
        const input = document.querySelector('#adv');
        input.textContent = 'Nome strano';
        errori.errnome = true;
        console.log(errori);
        } else {
          check.classList.remove('errore');
          const adv = document.querySelector('#adv');
          adv.textContent = '';
         
         errori.errnome = false;
         console.log(errori);
         }
            
         
        
       checkform();  
          
        }
    


function checkcognome(event){
    const check = event.currentTarget;
    console.log(check);
    console.log(check.value.length);
    if(check.value.length == 0){
        check.classList.add('errore');
        const input = document.querySelector('#adv2');
        input.textContent = 'Cognome strano';
        errori.errcognome = true;
        console.log(errori);
    } else {
          check.classList.remove('errore');
          const adv = document.querySelector('#adv2');
          adv.textContent = '';

            errori.errcognome = false;
            console.log(errori);
         
    }
    checkform();
}


function onJson(json){
    console.log(json);
    if(json){
        document.querySelector('#adv3').innerHTML = "Username già in uso";
        errori.errusername = true;
    } else {
        document.querySelector('#adv3').innerHTML = "";
        errori.errusername = false;
    }
    checkform();
}

function onResponse(response){
    return response.json();
}

function checkUsername(event) {
    const Check = event.currentTarget;

    if(Check.value.length == 0){
        document.querySelector('#adv3').textContent = "Questo campo non può essere vuoto";
        errori.errusername = true;
    } else fetch("username.php?q="+Check.value).then(onResponse).then(onJson);

   
}


function checkemail(event){
    const check = event.currentTarget;
    console.log(check.value.length);
    if(check.value.length == 0){
        document.querySelector('#adv4').textContent = "Questo campo non può essere vuoto";
        errori.erremail = true;
     } else if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(String(email.value).toLowerCase())){
    check.classList.add('errore');
    const input = document.querySelector('#adv4');
    input.textContent = 'Email non valida';
    errori.erremail = true;
    console.log(errori);
    } else {
        check.classList.remove('errore');
        const adv = document.querySelector('#adv4');
        adv.textContent = '';
        
            errori.erremail = false;
            console.log(errori);
         
           
        }
    
        checkform();
    }

    function checkPassword(event) {
        const Check = event.currentTarget;
    
        if(Check.value.length == 0){
            document.querySelector('#adv5').textContent = "Questo campo non può essere vuoto";
            errori.errpassword = true;
        } else if(Check.value.length < 8){
            document.querySelector('#adv5').textContent = "La password deve contenere almeno 8 caratteri";
            errori.errpassword = true;
        } else if(!Check.value.match(/[A-Z]/g)||!Check.value.match(/[a-z]/g)||!Check.value.match(/[0-9]/g)){
            document.querySelector('#adv5').textContent = "La password deve contenere almeno una lettera maiuscola, una lettera minuscola e un numero";
            errori.errpassword = true;
        }else {
            document.querySelector('#adv5').innerHTML = "";
            errori.errpassword = false;
        }
        checkform();
    }


const button = document.querySelector('.button');
button.addEventListener('click', checkform);

function checkform(){
    let control = 0;
     for(let key in errori){
         if(errori[key] == true){
             control++;
     }
     }
     if(control != 0){
        const button = document.querySelector('.button');
        button.disabled = true;
    } else {
        const button = document.querySelector('.button');
        button.disabled = false;

    }
    
}


