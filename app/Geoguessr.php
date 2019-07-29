<?php

namespace App;


class Geoguessr
{
    private function curlPostPage($url, $postParameters)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParameters);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_USERAGENT,
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.62 Safari/537.36");
        $pageResponse = curl_exec($ch);
        curl_close($ch);
        return $pageResponse;
    }

    private function curlGetPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_USERAGENT,
            "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.62 Safari/537.36");
        $pageResponse = curl_exec($ch);

        curl_close($ch);
        return json_decode($pageResponse, true);
    }


    public function login()
    {
        if (!file_exists('cookie.txt')) {
            $response = $this->curlPostPage("https://geoguessr.com/api/v3/accounts/signin",
                [
                    'email' => config('geoguessr.username'),
                    'password' => config('geoguessr.password')
                ]);
        }

    }

    private function getPage($url)
    {

        $query = $this->curlGetPage($url);
        if(($query['statusCode'] ?? 200) == 401){
            $this->login();
            $query = $this->curlGetPage($url);
        }

        return $query;

    }


    public function getUnfinishedGames()
    {

        $response = $this->getPage("https://geoguessr.com/api/v3/social/events/unfinishedgames");

        return $response;


    }

    public function getGame($token)
    {

        $gameinfo = $this->getPage("https://geoguessr.com/api/v3/games/" . $token);

        return $gameinfo;

    }
}

