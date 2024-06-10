<?php

declare(strict_types=1);

use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$webPage = new AppWebPage();

$webPage->setTitle("Séries TV");

$shows = TvShowCollection::findAll();

foreach ($shows as $show) {
    $nomShow = $show->getName();
    $posterId = $show->getPosterId();
    $desc = $show->getOverview();
    $poster = "<img src='poster.php?posterId=$posterId' alt='image'/>";
    $webPage->appendContent("<p>$poster <a href='poster.php?posterId=$posterId'>$nomShow</a><p><div>$desc</div>");
}

echo $webPage->toHTML();