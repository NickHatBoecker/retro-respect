<?php
$text = $_GET['text'] ?? 'Tell your dog I said hi.';
$theme = $_GET['color'] ?? 'pink';
if (!$theme) {
    $theme = 'pink';
}

$showHelp = !isset($_GET['text']);

$saveText = htmlentities($text, ENT_QUOTES, 'utf-8');
$saveText = str_replace('\n', "<br>", $saveText);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <title>Retro respect</title>

    <link rel="stylesheet" type="text/css" href="app.css">
</head>
<body class="<?php echo htmlentities($theme, ENT_QUOTES, 'utf-8'); ?>">
    <?php
    if ($showHelp) {
        ?>
        <div class="c-help">
            <div class="c-help__form-group">
                <label for="js-your_text" class="u-block">Your text:</label>
                <div class="c-help__textarea-wrapper">
                    <textarea id="js-your_text" rows="2">Tell your dog I said hi.</textarea>
                </div>
                <em class="c-help__helptext u-block">You can wrap lines with "\n"</em>
            </div>
            <div class="c-help__form-group">
                <label for="js-your_color">Choose color:</label>
                <select id="js-your_color">
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="orange">Orange</option>
                    <option value="pink" selected>Pink</option>
                    <option value="red">Red</option>
                </select>
            </div>
            <div class="c-help__form-group">
                <label for="js-your_url">Your generated url:</label> <input type="text" id="js-your_url" value="https://retro-respect.nick-hat-boecker.de/" disabled>
                <span class="c-help__helptext" id="js-updated" style="display: none;">Updated!</span>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="c-card__wrapper<?php if (!$showHelp) { echo ' u-height-100'; } ?>">
        <div class="c-card">
            <div class="c-card__content">
                <p class="c-card__text" id="js-text"><?php echo $saveText; ?></p>
                <p class="c-card__text c-card__next u-bounce-3">▼</p>
            </div>
        </div>
    </div>
    <div class="c-footer">
        <p>
            Retro-Respect &copy; <a href="https://nick-hat-boecker.de">NickHatBoecker</a> || Wanna generate your own? Visit <a href="https://retro-respect.nick-hat-boecker.de">https://retro-respect.nick-hat-boecker.de</a>.
        </p>
    </div>

    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script>
        window.timeouts = [];
        var $yourColor = $('#js-your_color');
        var $yourText = $('#js-your_text');
        var $yourUrl = $('#js-your_url');
        var $updated = $('#js-updated');
        var $currentText = $('#js-text');

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
    </script>
</body>
</html>

