<?php

namespace App\Http\Controllers;

use App\Interfaces\StoreRepositoryInterface;
use App\Http\Resources\StoreResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Requests\StoreStoreRequest;

class StoreController extends Controller
{

    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $stores = $this->storeRepository->getAll(
                $request->search,
                $request->is_verified,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Toko berhasil diambil', StoreResource::collection($stores), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'nullable|string',
            'is_verified' => 'nullable|boolean',
            'row_per_page' => 'required|integer',
        ]);

        try {
            $stores = $this->storeRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['is_verified'] ?? null,
                $request['row_per_page'],
            );

            return ResponseHelper::jsonResponse(true, 'Data toko berhasil diambil', PaginateResource::make($stores, StoreResource::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $store = $this->storeRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data toko berhasil ditambahkan', new StoreResource($store), 201);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->storeRepository->getById(
                $id,
            );

            if (!$user) {
                return ResponseHelper::jsonResponse(false, 'Data Toko tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data toko berhasil diambil', new StoreResource($user), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
