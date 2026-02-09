<?php

namespace App\Interfaces;

interface ProductRepositoryInterface {
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute,
    );

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage,
    );
}
