<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

final class CategoriaRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarAtivas(): array
    {
        $sql = '
            SELECT
                id,
                nome,
                slug,
                imgcategoria,
                descricao
            FROM categorias
            WHERE ativo = 1
            ORDER BY nome ASC
        ';

        $consulta = $this->pdo->prepare(
            $sql
        );

        $consulta->execute();

        return $consulta->fetchAll();
    }


    public function buscarPorSlug(
        string $slug
    ): ?array {
        $sql = '
            SELECT
                id,
                nome,
                slug,
                imgcategoria,
                descricao
            FROM categorias
            WHERE slug = :slug
              AND ativo = 1
            LIMIT 1
        ';

        $consulta = $this->pdo->prepare(
            $sql
        );

        $consulta->execute([
            'slug' => $slug,
        ]);

        $categoria =
            $consulta->fetch();

        return is_array($categoria)
            ? $categoria
            : null;
    }
}
