<?php

declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();

$webPage->setTitle("Séries TV");

$webPage->appendCSSUrl("css/index.css");

$shows = TvShowCollection::findAll();

foreach ($shows as $show) {
    $nomShow = $show->getName();
    $posterId = !empty($show->getPosterId()) ? $show->getPosterId() : null;
    $desc = $show->getOverview();
    $poster = "<img src='poster.php?posterId=$posterId' alt='image'/>";
    $webPage->appendContent("<a href='tvshow.php?tvshowId={$show->getId()}' class='serie'><p>$poster</p><div class='info_serie'><p>$nomShow</p><p>$desc</p></div></a>");
}

echo $webPage->toHTML();
