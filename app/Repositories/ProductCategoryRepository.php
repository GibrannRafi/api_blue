<?php

namespace App\Repositories;

use App\Interfaces\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function create(
        array $data
    ) {
        DB::beginTransaction();
        try {
            $productCategory = new ProductCategory;
            if (isset($data['parent_id'])) {
                $productCategory->parent_id = $data['parent_id'];
            }
            if (isset($data['image'])) {
                $productCategory->image = $data['image']->store('assets/product-category', 'public');
            }
            $productCategory->name = $data['name'];
            $productCategory->slug = Str::slug($data['name']);

            if (isset($data['tagline'])) {
                $productCategory->tagline = $data['tagline'];
            }
            $productCategory->description = $data['description'];
            $productCategory->save();
            DB::commit();
            return $productCategory;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        DB::beginTransaction();
        try {
            $productCategory = ProductCategory::find($id);

            if (isset($data['parent_id'])) {
                $productCategory->parent_id = $data['parent_id'];
            }
            if (isset($data['image'])) {
                $productCategory->image = $data['image']->store('assets/product-category', 'public');
            }
            $productCategory->name = $data['name'];
            $productCategory->slug = Str::slug($data['name']);

            if (isset($data['tagline'])) {
                $productCategory->tagline = $data['tagline'];
            }
            $productCategory->description = $data['description'];
            $productCategory->save();
            DB::commit();
            return $productCategory;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function delete(
        string $id,
    ) {
        DB::beginTransaction();
         try {
            $productCategory = ProductCategory::find($id);
            $productCategory->delete();
            DB::commit();
            return $productCategory;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
