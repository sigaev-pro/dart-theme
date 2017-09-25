jQuery(document).ready(function($) {
    $('main').delegate('.nav-previous a, .nav-next a', 'click', function(event) {
        event.preventDefault();

        $('main').animate({ opacity: 0.5 }, 500);
        $('main').css('cursor', 'wait');

        $.get(event.target.href, function(data) {
            $('main > *').remove();
            $('main').prepend($(data).find('main > *'));

            $('html, body').animate({
                scrollTop: $('main').offset().top,
            }, 1000);
            $('main').animate({ opacity: 1 }, 1000);
            $('main').css('cursor', 'initial');
        });

        return false;
    });
});