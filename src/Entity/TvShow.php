<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Collection\TvShowCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;

class TvShow
{
    private int $id;
    private string $name;
    private string $originalName;
    private string $homepage;
    private string $overview;
    private int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Retourne la série ayant comme identifiant celui donné en paramètre
     *
     * @param int $id
     * @return TvShow
     */
    public static function findById(int $id): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, originalName, homepage, overview, posterId
            FROM tvshow
            WHERE id = ?
        SQL
        );
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, TvShow::class);
        $tvshow = $stmt->fetch();
        if ($tvshow === false) {
            throw new EntityNotFoundException();
        }
        return $tvshow;
    }

    /**
     * Retourne toutes les séries par ordre alphabétique
     *
     * @return array
     */
    public function getSeason(): array
    {
        return SeasonCollection::findByTvId($this->getId());
    }
}
