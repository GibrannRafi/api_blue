<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?string $productCategory = null,
        ?int $limit,
        bool $execute,
    ) {
        $query = Product::where(function ($query) use ($productCategory, $search) {
            if ($search) {
                $query->search($search);
            }

            if ($productCategory === true) {
                $query->where('product_category_id', $productCategory);
            }
        })->with('productImages');

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
        ?string $productCategory = null,
        ?int $rowPerPage,
    ) {
        $query = $this->getAll(
            $search,
            $productCategory,
            null,
            false,
        );

        return $query->paginate($rowPerPage);
    }

     public function getById(
        string $id,
    ) {
        $query = Product::where('id', $id)->with('productImages');

        return $query->first();
    }

    public function getBySlug(
        string $slug,
    ) {
        $query = Product::where('slug', $slug)->with('productImages');
        return $query->first();
    }

}
