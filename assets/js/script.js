$(document).ready(function(){


$("#homeMenu").click(function() {
    $("a").removeClass("active")
    $(this).addClass("active")
    $("#homePage").removeClass("d-none").addClass("d-block");
    $("#cafePage").removeClass("d-block").addClass("d-none");
    $("#packagePage").removeClass("d-block").addClass("d-none");
    $("#aboutPage").removeClass("d-block").addClass("d-none");
    $("#contactPage").removeClass("d-block").addClass("d-none");
});

$("#cafeMenu").click(function() {
    $("a").removeClass("active")
    $(this).addClass("active")
    $("#homePage").removeClass("d-block").addClass("d-none");
    $("#cafePage").removeClass("d-none").addClass("d-block");
    $("#packagePage").removeClass("d-block").addClass("d-none");
    $("#aboutPage").removeClass("d-block").addClass("d-none");
    $("#contactPage").removeClass("d-block").addClass("d-none");
});

$("#packageMenu").click(function() {
    $("a").removeClass("active")
    $(this).addClass("active")
    $("#homePage").removeClass("d-block").addClass("d-none");
    $("#cafePage").removeClass("d-block").addClass("d-none");
    $("#packagePage").removeClass("d-none").addClass("d-block");
    $("#aboutPage").removeClass("d-block").addClass("d-none");
    $("#contactPage").removeClass("d-block").addClass("d-none");
});

$("#aboutMenu").click(function() {
    $("a").removeClass("active")
    $(this).addClass("active")
    $("#homePage").removeClass("d-block").addClass("d-none");
    $("#cafePage").removeClass("d-block").addClass("d-none");
    $("#packagePage").removeClass("d-block").addClass("d-none");
    $("#aboutPage").removeClass("d-none").addClass("d-block");
    $("#contactPage").removeClass("d-block").addClass("d-none");
});

$("#contactMenu").click(function() {
    $("a").removeClass("active")
    $(this).addClass("active")
    $("#homePage").removeClass("d-block").addClass("d-none");
    $("#cafePage").removeClass("d-block").addClass("d-none");
    $("#packagePage").removeClass("d-block").addClass("d-none");
    $("#aboutPage").removeClass("d-block").addClass("d-none");
    $("#contactPage").removeClass("d-none").addClass("d-block");
});

let amtText = $('#amtSQL').text();
console.log(amtText.substr(amtText.lenght, 4));

$('#amt').change(function() {
    console.log($('#amt').val());
    if($('#amt').val() < (parseInt(amtText.substr(amtText.lenght, 4)) + 1)) {
        if($('#amt').val() < 1) {
            $('#amt').val(1);
        }
    } else {
        $('#amt').val(amtText.substr(amtText.lenght, 4));
        Swal.fire({
            icon: 'warning',
            text: 'สินค้าในคลังเหลือ ' + amtText,
            showConfirmButton: false,
            showCloseButton: true
        });
    }
})

$('#plus').click(function() {
    if($('#amt').val() >= 1) {
        if($('#amt').val() != amtText.substr(amtText.lenght, 4)) {
            $('#amt').val(parseInt($('#amt').val()) + 1);
        } else {
            Swal.fire({
                icon: 'warning',
                text: 'สินค้าในคลังเหลือ ' + amtText,
                showConfirmButton: false,
                showCloseButton: true
            });
        }
    }
});
$('#minus').click(function() {
    if($('#amt').val() > 1) {
        $('#amt').val(parseInt($('#amt').val()) - 1);
    }
});

$('#shooseFile').click(function() {
    $('#file').click();
});
$('#file').change(function() {
    let file = $('#file').click();
    $('#fileName').html(file.val().replace(/C:\\fakepath\\/i, ''));
})

});