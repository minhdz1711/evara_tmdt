jQuery(document).ready(function ($) {
    $(".Switch").click(function () {
        if ($(this).hasClass("On")) {
            $(this).parent().find("input:checkbox").attr("checked", !1);
            $(this).removeClass("On").addClass("Off");
        } else {
            $(this).parent().find("input:checkbox").attr("checked", !0);
            $(this).removeClass("Off").addClass("On");
        }

    }), $(".Switch").each(function () {
        $(this).parent().find("input:checkbox").length && ($(this).parent().find("input:checkbox").hasClass("show") || $(this).parent().find("input:checkbox").hide(), $(this).parent().find("input:checkbox").is(":checked") ? $(this).removeClass("Off").addClass("On") : $(this).removeClass("On").addClass("Off"))
    });

    $('.js-example-basic-single').select2();
});
$(function () {
    var url = window.location;
    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({'display': 'block'})
        .addClass('menu-open').prev('a')
        .addClass('active');
});

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source) {
            checkboxes[i].checked = source.checked;
        }
    }
    $('table tbody tr').toggleClass('mycheckbox');
}
