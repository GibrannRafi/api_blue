<?php

namespace App\Repositories;

use App\Interfaces\StoreBallanceRepositoryInterface;
use App\Models\StoreBallance;

class StoreBallanceRepository implements StoreBallanceRepositoryInterface {
      public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute,
    ) {
        $query = StoreBallance::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        if($limit){
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage,
    ) {
        $query = $this->getAll(
           $search,
            null,
           false,
        );

        return $query->paginate($rowPerPage);
    }
}
