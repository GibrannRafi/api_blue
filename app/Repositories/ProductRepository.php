<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?string $productCategoryId = null,
        ?int $limit,
        bool $execute,
    ) {
        $query = Product::where(function ($query) use ($productCategoryId, $search) {
            if ($search) {
                $query->search($search);
            }

            if ($productCategoryId === true) {
                $query->where('product_category_id', $productCategoryId);
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
        ?string $productCategoryId = null,
        ?int $rowPerPage,
    ) {
        $query = $this->getAll(
            $search,
            $productCategoryId,
            null,
            false,
        );

        return $query->paginate($rowPerPage);
    }
}
