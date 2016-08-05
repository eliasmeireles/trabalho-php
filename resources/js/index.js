$(init);

function init() {
    var caroucel = $('.carousel');
    var active = $(caroucel).find('.slide');
    var index = $(caroucel).find('.slide.active').index();
    $(active[index]).toggleClass('active');

    if (index + 1 >= active.length) {
        $(active[0]).toggleClass('active');
    } else {
        $(active[index + 1]).toggleClass('active');
    }
}