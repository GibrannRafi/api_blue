<?php

namespace App\Repositories;

use App\Interfaces\BuyerRepositoryInterface;
use App\Models\Buyer;

class BuyerRepository implements BuyerRepositoryInterface{

      public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute,
    ) {
        $query = Buyer::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
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
