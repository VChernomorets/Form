// when the form is filled in correctly - true
let emailFlag = false;
let passwordFlag = false;
let usernameFlag = false;
let locationFlag = false;
// input email
let email = document.getElementById('email');
/**
 * Verification of the form to enter email
 */
 checkEmail = () => {
    let regexp = new RegExp("^([a-z0-9_-]+\\.)*[a-z0-9_-]+@[a-z0-9_-]+(\\.[a-z0-9_-]+)*\\.[a-z]{2,6}$");
    if(!regexp.test(email.value)){
        email.style.borderBottom = "2px solid red";
        emailFlag = false;
    } else {
        email.style.borderBottom = "2px solid #d3bb89";
        emailFlag = true;
    }
};
/**
 * Delete the event 'blur'. Create a new event 'input'.
 * Call the field validation method.
 */
firstCheckEmail = () => {
    email.removeEventListener('blur', firstCheckEmail);
    email.addEventListener('input', checkEmail);
    checkEmail();
};
// Create event 'blur'
email.addEventListener('blur', firstCheckEmail);
// Password field
password = document.getElementById('password');

/**
 * We check the data that the user entered.
 * If the characters are less than 8, underline the field.
 */
checkPassword = () => {
    if(password.value.length < 8){
        password.style.borderBottom = "2px solid red";
        passwordFlag = false;
    } else {
        password.style.borderBottom = "2px solid #d3bb89";
        passwordFlag = true;
    }
};
/**
 * Delete the event 'blur'. Create a new event 'input'.
 * Call the field validation method.
 */
firstCheckPassword = () => {
    password.removeEventListener('blur', firstCheckPassword);
    password.addEventListener('input', checkPassword);
    checkPassword();
};
// Create event 'blur'
password.addEventListener('blur', firstCheckPassword);
// Button save registration form
let registrationSave = document.getElementById('registrationSave');
/**
 * After pressing the button, the forms are checked.
 * If everything is filled out correctly, it shows the new form, and hides the old one.
 * If the fields are not correctly filled, underlines those that are incorrectly filled.
 */
registrationSave.addEventListener('click', () => {
   if(emailFlag && passwordFlag){
       document.getElementsByClassName("registration")[0].style.display = "none";
       document.getElementsByClassName("aboutMe")[0].style.display = "block";
   } else {
       if(!emailFlag){
           email.style.borderBottom = "2px solid red";
       }
       if (!passwordFlag) {
           password.style.borderBottom = "2px solid red";
       }
   }
});
// Input field login
let username = document.getElementById('username');
/**
 * If the field is empty, underlines it.
 */
username.addEventListener('blur', () => {
   if(username.value.length === 0){
       username.style.borderBottom = "2px solid red";
       usernameFlag = false;
   } else {
       username.style.borderBottom = "2px solid #d3bb89";
       usernameFlag = true;
   }
});
// Location field
let selectLocation = document.getElementById('location');
/**
 * If the location is not selected, we emphasize the field.
 */
selectLocation.onchange = () => {
    let option = selectLocation.querySelectorAll('option')[selectLocation.selectedIndex];
    if(option.getAttribute('value') === ""){
        selectLocation.style.borderBottom = "2px solid red";
        locationFlag = false;
    } else {
        selectLocation.style.borderBottom = "2px solid #d3bb89";
        locationFlag = true;
    }
};
// Button to save the second form
let saveAboutMe = document.getElementById('saveAboutMe');
/**
 * All forms are checked for correctness.
 * Those fields that are incorrectly filled - underline.
 */
saveAboutMe.addEventListener('click', () =>{
   if(usernameFlag && locationFlag){
       console.log("The form is ready to be sent!");
   } else {
       if(!usernameFlag){
           username.style.borderBottom = "2px solid red";
       }
       if(!locationFlag){
           selectLocation.style.borderBottom = "2px solid red";
       }
   }
});