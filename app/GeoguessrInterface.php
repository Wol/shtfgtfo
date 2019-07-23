<?php


function curlPostPage($url, $postParameters)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postParameters);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.62 Safari/537.36");
    $pageResponse = curl_exec($ch);
    curl_close($ch);
    return $pageResponse;
}

function curlGetPage($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.62 Safari/537.36");
    $pageResponse = curl_exec($ch);
    curl_close($ch);
    return $pageResponse;
}


if (!file_exists('cookie.txt')) {
    $response = curlPostPage("https://geoguessr.com/api/v3/accounts/signin", ['email' => config('geoguessr.username'), 'password' => config('geoguessr.password')]);
    print_r($response);
}


$response = curlGetPage("https://geoguessr.com/api/v3/social/events/unfinishedgames");
$response = json_decode($response);
foreach($response as $game){

    $gameinfo = curlGetPage("https://geoguessr.com/api/v3/games/" . $game->token);
    $gameinfo = json_decode($gameinfo);


    ?>
<div>

    <h2><?= $game->map; ?> (<?= $game->date; ?>)</h2>
    <p><?= $game->score->percentage ?>%</p>
    <p>Rounds:</p>
    <ul>
    <?php
    foreach($gameinfo->rounds as $round){
        ?>
        <li><?= $round->lat; ?>, <?= $round->lng; ?></li>
        <?php
    }
    ?>
    </ul>
</div>

<?php
}


