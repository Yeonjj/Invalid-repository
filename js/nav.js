$(document).ready(function () {

    var jsonObj = $.parseJSON('{"a":1,"b":3,"ds":4}');
    var html = '<table border="1">';
    $.each(jsonObj, function (key, value) {
        html += '<tr>';
        html += '<td>' + key + '</td>';
        html += '<td>' + value + '</td>';
        html += '</tr>';
    });
    html += '</table>';

    $('p.convert').html(html);

    var childElem = new Array();
    $("div.nav").children().each(function () {
        childElem.push($(this));
    });
    $("div.menu").mouseover(function () {
        var distance = 27;
        for (var i = 1; i < 5; i++) {
            $(childElem[i]).animate({
                top: distance,
                opacity: '1'
            }, 200);
            distance += 22;
        }

    });
    $("div.nav").mouseleave(function () {
        for (var i = 4; i >= 1; i--) {
            $(childElem[i]).animate({
                top: 27,
                opacity: '0'
            }, 200);
        }
    });
});


