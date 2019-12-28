<?php

$start = "http://codexshaper.com";

function flower_link($url)
{
    $doc = new DOMDocument();
    @$doc->loadHTML(file_get_contents($url));

    $linkList = $doc->getElementsByTagName('img');

    foreach ($linkList as $link) {
        $image    = $link->getAttribute("src");
        $imgName  = explode('/', $image);
        $fileName = end($imgName);
        file_put_contents($fileName, file_get_contents($image));
    }

}

flower_link($start);
