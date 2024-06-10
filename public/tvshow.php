<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Poster;
use Entity\TvShow;
use Html\AppWebPage;

if (!isset($_GET["tvshowId"]) || !ctype_digit($_GET["tvshowId"])) {
    header("Location: http://localhost:8000");
    die();
}

$tvshowId = $_GET["tvshowId"];

$webPage = new AppWebPage();

$webPage->appendCSSUrl("css/tvshow.css");

try {
    $tvshow = TvShow::findById((int)$tvshowId);
    $webPage->setTitle("Séries TV : {$tvshow->getName()}");

    $nameShow = $tvshow->getName();
    $originalNameShow = $tvshow->getOriginalName();
    $showPosterId = $tvshow->getPosterId();
    $desc = $tvshow->getOverview();
    $showposter = "<img src='poster.php?posterId=$showPosterId' alt='posterShow'/>";
    $webPage->appendContent("<div id='serie'><p>$showposter</p><div id='info_serie'><p>$nameShow</p><p>(Nom original : $originalNameShow)</p><p>$desc</p></div></div>");

    $seasons = $tvshow->getSeason();

    foreach ($seasons as $season) {
        $poster = Poster::findById($season->getPosterId());
        $nameSeason = $season->getName();
        $webPage->appendContent("<div class='season'><img src='poster.php?posterId={$poster->getId()}' alt='posterSeason'/><p class='info_season'>$nameSeason</p></div>");
    }

    echo $webPage->toHTML();
} catch(EntityNotFoundException $e) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}