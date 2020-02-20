window.timeouts = [];
var $yourColor = $('#js-your_color');
var $yourText = $('#js-your_text');
var $yourUrl = $('#js-your_url');
var $updated = $('#js-updated');
var $currentText = $('#js-text');

$(document).ready(function () {
    const title = new URLSearchParams(window.location.search).get('text');
    const theme = new URLSearchParams(window.location.search).get('color');
    if (!title) {
        return;
    }

    html2canvas(document.querySelector("#capture"), {
        backgroundColor: null, // Transparent
        onclone: function (dom) {
            $(dom).find('body').addClass('canvas');
        },
    }).then(canvas => {
        $.ajax({
            type: 'POST',
            url: "save_image.php",
            data: { imgBase64: canvas.toDataURL(), title: title, theme: theme },
        }).done(function (response) {
            console.log('Saved social card image.');
        });
    });
});

$yourColor.change(function () {
    var newTheme = $yourColor.val();
    var $body = $('body');
    $body.removeAttr('class');
    $body.addClass(newTheme);

    renderUrl();
});

$yourText.keyup(function () {
    var newText = $yourText.val();
    $currentText.text(newText); // Sanitize code
    newText = $currentText.text().replace(/\\n/g, '<br>');
    $currentText.html(newText);

    renderUrl();
});

function renderUrl () {
    resetTimeouts();
    $updated.hide();
    var url = getUrl();
    $yourUrl.val(url);
    $updated.fadeIn();

    var timeout = setTimeout(function () { $updated.fadeOut() }, 2000);
    window.timeouts.push(timeout);
}

function getUrl () {
    var $baseUrl = 'https://retro-respect.nick-hat-boecker.de/?';
    var data = {
        color: $yourColor.val(),
        text: $yourText.val(),
    };

    return $baseUrl + jQuery.param(data);
}

function resetTimeouts () {
    for(i = 0; i < window.timeouts.length; i++) {
        window.clearTimeout(window.timeouts[i]);
    }
}
