(function ($) {
    "use strict";

    // Initiate the wowjs
    new WOW().init();


    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });
    
})(jQuery);

    function validarFormulario() {
        var nombre = document.getElementById('nombres').value;
        var apellido = document.getElementById('apellidos').value;
        var documento = document.getElementById('documento').value;
        var contacto = document.getElementById('telefono').value;
        var correo = document.getElementById('correo').value;
        var contrasena = document.getElementById('contrasena').value;

        // Validar nombre
        var regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,28}( [a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,28})?$/;
        if (!regexNombre.test(nombre)) {
            alert("Por favor ingresa un nombre válido.");
            return false;
        }

        // Validar apellido
        var regexApellido = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,28}( [a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,28})?$/;
        if (!regexApellido.test(apellido)) {
            alert("Por favor ingresa un apellido válido no se permite puntos ni comas.");
            return false;
        }

        // Validar documento
        var regexDocumento = /^\d{8,10}$/;
        if (!regexDocumento.test(documento)) {
            alert("Por favor ingresa un número de documento válido.");
            return false;
        }

        // Validar contacto
        var regexContacto = /^\d{1,10}$/;
        if (!regexContacto.test(contacto)) {
            alert("Por favor ingresa un número de contacto válido.");
            return false;
        }

        // Validar correo
        var regexCorreo = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        if (!regexCorreo.test(correo)) {
            alert("Por favor ingresa una dirección de correo válida.");
            return false;
        }

        // Validar contraseña
        if (contrasena.length < 8 || contrasena.length > 11) {
            alert("La contraseña debe tener entre 8 y 11 caracteres.");
            return false;
        }

        return true;
    }
