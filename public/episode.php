<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\TvShow;
use Html\AppWebPage;

if (!isset($_GET["seasonId"]) || !ctype_digit($_GET["seasonId"])) {
    header("Location: http://localhost:8000");
    die();
}

$seasonId = $_GET["seasonId"];

$webPage = new AppWebPage();

try {
    $season = Season::findById((int)$seasonId);
    $tvshow = TvShow::findById($season->getTvShowId());
    $webPage->setTitle("Séries TV : {$tvshow->getName()} <p> {$season->getName()}");

    $nameShow = $tvshow->getName();
    $nameSeason = $season->getName();
    $seasonPosterId = $season->getPosterId();

    $seasonPoster = "<img src='poster.php?posterId=$seasonPosterId' alt='posterShow'/>";
    $webPage->appendContent("<div id='serie'><p>$seasonPoster</p><div id='info_serie'><p>$nameShow</p><p>$nameSeason</p></div></div>");

    $episodes = $season->getEpisode();

    foreach ($episodes as $episode) {
        $numEpisode = $episode->getEpisodeNumber();
        $nameEpisode = $episode->getName();
        $descEpisode = $episode->getOverview();
        $webPage->appendContent("<p class='info_episode'>$numEpisode - $nameEpisode <p> $descEpisode</p></a>");
    }

    echo $webPage->toHTML();
} catch(EntityNotFoundException $e) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}