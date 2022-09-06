$(document).ready(function ($) {

    var pessoa_fisica = $('#pessoa_fisica');
    var pessoa_juridica = $('#pessoa_juridica');

    if (pessoa_fisica.is(":checked")) {

        $('.pessoa_juridica').hide();
        $('.pessoa_fisica').show();
    }

    if (pessoa_juridica.is(":checked")) {

        $('.pessoa_fisica').hide();
        $('.pessoa_juridica').show();
    }

    pessoa_fisica.click(function () {

        $('.pessoa_juridica').hide();
        $('.pessoa_fisica').show();

    });

    pessoa_juridica.click(function () {

        $('.pessoa_fisica').hide();
        $('.pessoa_juridica').show();

    });

});

$(document).ready(function ($) {

    var grupo_a = $('#grupo_a');
    var grupo_b = $('#grupo_b');

    if (grupo_a.is(":checked")) {

        $('.grupo_b').hide();
        $('.grupo_a').show();
    }

    if (grupo_b.is(":checked")) {

        $('.grupo_a').hide();
        $('.grupo_b').show();
    }

    grupo_a.click(function () {

        $('.grupo_b').hide();
        $('.grupo_a').show();

    });

    grupo_b.click(function () {

        $('.grupo_a').hide();
        $('.grupo_b').show();

    });

});