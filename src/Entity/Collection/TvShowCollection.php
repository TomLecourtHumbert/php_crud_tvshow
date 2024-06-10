<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;
use PDO;

class TvShowCollection
{
    /**
     * Retoure un array de toutes les séries
     *
     * @return TvShow[]
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, originName, homepage, overview, posterId
            FROM tvshow
        SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, TvShow::class);
    }
}
