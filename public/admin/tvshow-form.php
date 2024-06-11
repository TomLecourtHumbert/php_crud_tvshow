<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\TvShow;
use Html\AppWebPage;
use Html\Form\TvShowForm;

try {
    if (!isset($_GET["tvshowId"])) {
        $show = new TvShowForm();
    } else {
        if (!ctype_digit($_GET["tvshowId"])) {
            throw new ParameterException();
        }
        $showId = $_GET["tvshowId"];
        $showF = TvShow::findById((int)$showId);
        $show = new TvShowForm($showF);
    }
    $webPage = new AppWebPage();
    $webPage->setTitle("Enregistrer un Show");
    $webPage->appendContent("{$show->getHtmlForm("tvshow-save.php")}");
    echo $webPage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}