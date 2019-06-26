// when the form is filled in correctly - true
let emailFlag = false;
let passwordFlag = false;
let usernameFlag = false;
let locationFlag = false;
// input email
const email = document.getElementById('email');
// minimum password size
const minPassSize = 8;

/**
 * Verification of the form to enter email
 */
checkEmail = () => {
    const regexp = new RegExp("^([a-z0-9_-]+\\.)*[a-z0-9_-]+@[a-z0-9_-]+(\\.[a-z0-9_-]+)*\\.[a-z]{2,6}$");
    if (!regexp.test(email.value)) {
        email.classList.add("error");
        emailFlag = false;
    } else {
        email.classList.remove("error");
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
    if (password.value.length < minPassSize) {
        password.classList.add("error");
        passwordFlag = false;
    } else {
        password.classList.remove("error");
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
const registrationSave = document.getElementById('registrationSave');
/**
 * After pressing the button, the forms are checked.
 * If everything is filled out correctly, it shows the new form, and hides the old one.
 * If the fields are not correctly filled, underlines those that are incorrectly filled.
 */
registrationSave.addEventListener('click', () => {
    if (emailFlag && passwordFlag) {
        document.getElementById("registrationForm").style.display = "none";
        document.getElementById("aboutMe").style.display = "block";
    } else {
        if (!emailFlag) {
            email.classList.add("error");
        }
        if (!passwordFlag) {
            email.classList.remove("error");
        }
    }
});
// Input field login
const username = document.getElementById('username');
/**
 * If the field is empty, underlines it.
 */
username.addEventListener('blur', () => {
    if (username.value.length === 0) {
        email.classList.add("error");
        usernameFlag = false;
    } else {
        email.classList.remove("error");
        usernameFlag = true;
    }
});
// Location field
const selectLocation = document.getElementById('location');
/**
 * If the location is not selected, we emphasize the field.
 */
selectLocation.onchange = () => {
    const option = selectLocation.querySelectorAll('option')[selectLocation.selectedIndex];
    if (option.getAttribute('value') === "") {
        email.classList.add("error");
        locationFlag = false;
    } else {
        email.classList.remove("error");
        locationFlag = true;
    }
};
// Button to save the second form
const saveAboutMe = document.getElementById('saveAboutMe');
/**
 * All forms are checked for correctness.
 * Those fields that are incorrectly filled - underline.
 */
saveAboutMe.addEventListener('click', () => {
    if (usernameFlag && locationFlag) {
        console.log("The form is ready to be sent!");
    } else {
        if (!usernameFlag) {
            email.classList.add("error");
        }
        if (!locationFlag) {
            email.classList.remove("error");
        }
    }
});



let locations = ["Arryn", "Baratheon", "Bronn", "Greyjoy", "Lannister", "Martell", "Tully"];

$(document).ready(function () {

    // initialize slider
    $('.slider').slick({
        accessibility: false,
        arrows: false
    });

    // initialize select
    $('.aboutMeForm__location').select2({closeOnSelect: true});

    // fill slider and select
    for(let i = 0; i < locations.length; i++){
        let $img = $("<img>").addClass("slider__Item").attr("src", `images/${locations[i]}.png`).attr("alt", locations[i]);
        let newOption = new Option(locations[i], locations[i], false, false);
        $('.slider').slick('slickAdd', $('<div></div>').append($img));
        $('#location').append(newOption).trigger('change');
    }

    // We process selection on select
    $("#location").change(function () {
        if($('#location').val()){
            $('.slider').slick('slickGoTo', locations.indexOf($('#location :selected').val()));
        }
    });
});

