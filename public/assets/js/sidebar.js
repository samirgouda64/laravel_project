$(document).ready(function () {
    $('.arrow-controls').on('click', function () {
        $('#sidebar').toggleClass('collapsed');
        $('#mainContent').toggleClass('collapsed');
    });

    // Active menu highlight
    $('.sidebar-menu li').on('click', function () {
        $('.sidebar-menu li').removeClass('active');
        $(this).addClass('active');
    });
});
