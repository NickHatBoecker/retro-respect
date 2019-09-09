<?php
$text = $_GET['text'] ?? 'Tell your dog I said hi.';
$theme = $_GET['color'] ?? 'pink';
if (!$theme) {
    $theme = 'pink';
}

$saveText = htmlentities($text, ENT_QUOTES, 'utf-8');
$saveText = str_replace('\n', "<br>", $saveText);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <title></title>

    <link rel="stylesheet" type="text/css" href="app.css">
</head>
<body class="<?php echo htmlentities($theme, ENT_QUOTES, 'utf-8'); ?>">
    <div class="c-card__wrapper">
        <div class="c-card">
            <div class="c-card__content">
                <p class="c-card__text"><?php echo $saveText; ?></p>
                <p class="c-card__text c-card__next u-bounce-3">▼</p>
            </div>
        </div>
    </div>
    <div class="c-footer">
        <p>
            Retro-Respect &copy; <a href="https://nick-hat-boecker.de">NickHatBoecker</a> || Wanna generate your own? Visit <a href="https://retro-respect.nick-hat-boecker.de">https://retro-respect.nick-hat-boecker.de</a>.
        </p>
    </div>
</body>
</html>

