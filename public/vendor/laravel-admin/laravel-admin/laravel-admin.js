$.fn.editable.defaults.params = function (params) {
    params._token = LA.token;
    params._editable = 1;
    params._method = 'PUT';
    return params;
};

$.fn.editable.defaults.error = function (data) {
    var msg = '';
    if (data.responseJSON.errors) {
        $.each(data.responseJSON.errors, function (k, v) {
            msg += v + "\n";
        });
    }
    return msg
};

toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};

$.pjax.defaults.timeout = 5000;
$.pjax.defaults.maxCacheLength = 0;
$(document).pjax('a:not(a[target="_blank"])', {
    container: '#pjax-container'
});

NProgress.configure({ parent: '#app' });

$(document).on('pjax:timeout', function (event) {
    event.preventDefault();
})

$(document).on('submit', 'form[pjax-container]', function (event) {
    $.pjax.submit(event, '#pjax-container')
});

$(document).on("pjax:popstate", function () {

    $(document).one("pjax:end", function (event) {
        $(event.target).find("script[data-exec-on-popstate]").each(function () {
            $.globalEval(this.text || this.textContent || this.innerHTML || '');
        });
    });
});

$(document).on('pjax:send', function (xhr) {
    if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if ($submit_btn) {
            $submit_btn.button('loading')
        }
    }
    NProgress.start();
});

$(document).on('pjax:complete', function (xhr) {
    if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if ($submit_btn) {
            $submit_btn.button('reset')
        }
    }
    NProgress.done();
    $.admin.grid.selects = {};
});

$(document).click(function () {
    $('.sidebar-form .dropdown-menu').hide();
});

$(function () {
    $('.sidebar-menu li:not(.treeview) > a').on('click', function () {
        var $parent = $(this).parent().addClass('active');
        $parent.siblings('.treeview.active').find('> a').trigger('click');
        $parent.siblings().removeClass('active').find('li').removeClass('active');
    });
    var menu = $('.sidebar-menu li > a[href$="' + (location.pathname + location.search + location.hash) + '"]').parent().addClass('active');
    menu.parents('ul.treeview-menu').addClass('menu-open');
    menu.parents('li.treeview').addClass('active');

    $('[data-toggle="popover"]').popover();

    // Sidebar form autocomplete
    $('.sidebar-form .autocomplete').on('keyup focus', function () {
        var $menu = $('.sidebar-form .dropdown-menu');
        var text = $(this).val();

        if (text === '') {
            $menu.hide();
            return;
        }

        var regex = new RegExp(text, 'i');
        var matched = false;

        $menu.find('li').each(function () {
            if (!regex.test($(this).find('a').text())) {
                $(this).hide();
            } else {
                $(this).show();
                matched = true;
            }
        });

        if (matched) {
            $menu.show();
        }
    }).click(function (event) {
        event.stopPropagation();
    });

    $('.sidebar-form .dropdown-menu li a').click(function () {
        $('.sidebar-form .autocomplete').val($(this).text());
    });
});

$(window).scroll(function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        $('#totop').fadeIn(500);
    } else {
        $('#totop').fadeOut(500);
    }
});

$('#totop').on('click', function (e) {
    e.preventDefault();
    $('html,body').animate({ scrollTop: 0 }, 500);
});

(function ($) {

    var Grid = function () {
        this.selects = {};
    };

    Grid.prototype.select = function (id) {
        this.selects[id] = id;
    };

    Grid.prototype.unselect = function (id) {
        delete this.selects[id];
    };

    Grid.prototype.selected = function () {
        var rows = [];
        $.each(this.selects, function (key, val) {
            rows.push(key);
        });

        return rows;
    };

    $.fn.admin = LA;
    $.admin = LA;
    $.admin.swal = swal;
    $.admin.toastr = toastr;
    $.admin.grid = new Grid();

    $.admin.reload = function () {
        $.pjax.reload('#pjax-container');
        $.admin.grid = new Grid();
    };

    $.admin.redirect = function (url) {
        $.pjax({ container: '#pjax-container', url: url });
        $.admin.grid = new Grid();
    };

    $.admin.getToken = function () {
        return $('meta[name="csrf-token"]').attr('content');
    };

    $.admin.loadedScripts = [];

    $.admin.loadScripts = function (arr) {
        var _arr = $.map(arr, function (src) {

            if ($.inArray(src, $.admin.loadedScripts)) {
                return;
            }

            $.admin.loadedScripts.push(src);

            return $.getScript(src);
        });

        _arr.push($.Deferred(function (deferred) {
            $(deferred.resolve);
        }));

        return $.when.apply($, _arr);
    }

})(jQuery);

function getNextDayDate(selectedDay) {
    // Get the current date
    var currentDate = new Date();

    // Get the current day of the week (0 for Sunday, 1 for Monday, ..., 6 for Saturday)
    var currentDayOfWeek = currentDate.getDay();

    // Calculate the difference in days between the selected day and the current day
    var dayDifference = (selectedDay - currentDayOfWeek + 7) % 7;

    // Add the difference to the current date to get the next occurrence of the selected day
    var nextDayDate = new Date(currentDate.getTime() + dayDifference * 24 * 60 * 60 * 1000);

    // Format the date to DD-MM-YYYY
    var formattedDate = ('0' + nextDayDate.getDate()).slice(-2) + '-' + ('0' + (nextDayDate.getMonth() + 1)).slice(-2) + '-' + nextDayDate.getFullYear();

    return formattedDate;
}


// Example usage:
var selectedDay = 0; // 0 for Sunday
var nextSundayDate = getNextDayDate(selectedDay);

// console.log(nextSundayDate.toDateString()); // Output the date of the next Sunday
$('#day_select').on('change', function () {
    console.log($(this).val(), 'ut');
    $('#day-id').val(getNextDayDate($(this).val()))
})
$('#day-id').val(nextSundayDate)
function getDateAfterDays(dayOfWeek) {
    // Get the current date
    var currentDate = new Date();

    // Calculate the difference in days between the selected day and the current day
    var dayDifference = (dayOfWeek - currentDate.getDay() + 7) % 7;

    // Add the difference to the current date to get the next occurrence of the selected day
    var nextDayDate = new Date(currentDate.getTime() + dayDifference * 24 * 60 * 60 * 1000);

    // Add 14 days to the next occurrence of the selected day
    nextDayDate.setDate(nextDayDate.getDate() + 14);

    // Format the date to DD-MM-YYYY
    var formattedDate = ('0' + nextDayDate.getDate()).slice(-2) + '-' + ('0' + (nextDayDate.getMonth() + 1)).slice(-2) + '-' + nextDayDate.getFullYear();

    return formattedDate;
}

// Example usage:
var selectedDay = 0; // 0 for Sunday
var dateAfter14Days = getDateAfterDays(selectedDay);


$('#14-day-select').on('change', function () {
    console.log($(this).val(), 'ut');
    $('#14day-id').val(getDateAfterDays($(this).val()))
})
$('#14day-id').val(dateAfter14Days)

$("#meeting-date").on("blur", function () {
    var value = $("#meeting-date").val();
    var dateParts = value.split("-");
    var formattedDate = dateParts[2] + "-" + dateParts[1] + "-" + dateParts[0];
    var date = new Date(formattedDate);
    var dayNumber = date.getDay();
    var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $("#month-id").val(daysOfWeek[dayNumber])
});