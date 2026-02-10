<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{


    public function getAll(
        ?string $search,
        ?bool $is_parent = null,
        ?int $limit,
        bool $execute,
    ) {
        $query = ProductCategory::where(function ($query) use ($is_parent, $search) {
            if ($search) {
                $query->search($search);
            }

            if ($is_parent === true) {
                $query->whereNull('parent_id');
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
        ?bool $is_parent = null,
        ?int $rowPerPage,
    ) {
        $query = $this->getAll(
            $search,
            $is_parent,
            null,
            false,
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id,
    ) {
        $query = ProductCategory::where('id', $id)->with('childrens');
        return $query->first();
    }

     public function getBySlug(
        string $slug,
    ) {
        $query = ProductCategory::where('slug', $slug)->with('childrens');
        return $query->first();
    }
}
