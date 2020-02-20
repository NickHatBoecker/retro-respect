<?php
require_once 'helper.php';

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

    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:title" content="<?php echo htmlentities($text, ENT_QUOTES, 'utf-8'); ?>" />
    <meta property="og:description" content="Share some pixel messages with your loved ones." />
    <meta property="og:image" content="<?php echo sprintf('https://%s%s', $_SERVER['HTTP_HOST'], generateUrl($text, $theme)); ?>" />

    <link rel="stylesheet" type="text/css" href="app.css">
</head>
<body id="capture" class="<?php echo htmlentities($theme, ENT_QUOTES, 'utf-8'); ?>">
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
    <div class="c-footer" data-html2canvas-ignore>
        <p>
            Retro-Respect &copy; <a href="https://nick-hat-boecker.de">NickHatBoecker</a> || Wanna generate your own? Visit <a href="https://retro-respect.nick-hat-boecker.de">https://retro-respect.nick-hat-boecker.de</a>.
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="js/html2canvas.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>

