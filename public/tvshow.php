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

try {
    $tvshow = TvShow::findById((int)$tvshowId);
    $webPage->setTitle("Séries TV : {$tvshow->getName()}");

    $nameShow = $tvshow->getName();
    $originalNameShow = $tvshow->getOriginalName();
    $showPosterId = $tvshow->getPosterId();
    $desc = $tvshow->getOverview();
    $showposter = "<img src='poster.php?posterId=$showPosterId' alt='posterShow'/>";
    $webPage->appendContent("<p>$showposter <div>$nameShow</div><p><div>$originalNameShow</div><p><div>$desc</div>");

    $seasons = $tvshow->getSeason();

    foreach ($seasons as $season) {
        $poster = Poster::findById($season->getPosterId());
        $nameSeason = $season->getName();
        $webPage->appendContent("<p><element><div><img src='poster.php?posterId={$poster->getId()}' alt='posterSeason'/> </div><div>$nameSeason</div></element>");
    }

    echo $webPage->toHTML();
} catch(EntityNotFoundException $e) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}