$(document).ready(function () {
    let inputs = [];
    inputs.push({name: '#email', pattern: new RegExp("^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$")});
    inputs.push({name: '#password', pattern: new RegExp("^.{8,}$")});
    inputs.push({name: '#username', pattern: new RegExp("^.{3,}$")});
    inputs.push({name: '#about-myself', pattern: new RegExp("^.{5,}$")});

    inputs.forEach(function (item) {
        $(item.name).one('blur',function () {
            checkInput($(this), item.pattern );
            $(this).on('input', () => checkInput($(this), item.pattern));
        });
    });

    let checkInput = ($element, regexp) => (!regexp.test($element.val())) ? $element.addClass('error') : $element.removeClass('error');

    const locations = ['Arryn', 'Baratheon', 'Bronn', 'Greyjoy', 'Lannister', 'Martell', 'Tully'];
// initialize slider
    $('.slider').slick({
        accessibility: false,
        arrows: false
    });

// initialize select
    $('.aboutMeForm__location').select2({closeOnSelect: true});

// fill slider and select
    for (let i = 0; i < locations.length; i++) {
        const $img = $('<img>').addClass('slider__Item').attr('src', `images/${locations[i]}.png`).attr('alt', locations[i]);
        const newOption = new Option(locations[i], locations[i], false, false);
        $('.slider').slick('slickAdd', $('<div></div>').append($img));
        $('#location').append(newOption).trigger('change');
    }

// We process selection on select
    $('#location').change(function () {
        if ($('#location').val()) {
            $('.slider').slick('slickGoTo', locations.indexOf($('#location :selected').val()));
        }
    });

    //server request
    $('.aboutMeSection__form').submit(function (e) {
        e.preventDefault();
        let date = $(this).serialize();
        $.ajax({
            type: 'post',
            url: 'handler.php',
            data: date,
            dataType: 'json',
            success: function (answer) {
                handler(answer)
            }
        });
    });

    // server response processing
    function handler(answer) {
        if(answer){
            alert("Successful registration");
            return;
        }
        $('#username__error').css('display', answer['username'] ? 'none' : 'block');
        $('#about-myself__error').css('display', answer['about-myself'] ? 'none' : 'block');
        $('#location__error').css('display', answer['location'] ? 'none' : 'block');
    }
});