<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\StoreBallanceHistoryResource;
use App\Interfaces\StoreBallanceHistoryRepositoryInterface;
use Illuminate\Http\Request;

class StoreBallanceHistoryController extends Controller
{
    private StoreBallanceHistoryRepositoryInterface $storeBallanceHistoryRepository;
    /**
     * Display a listing of the resource.
     */

     public function __construct(StoreBallanceHistoryRepositoryInterface $storeBallanceHistoryRepository)
    {
        $this->storeBallanceHistoryRepository = $storeBallanceHistoryRepository;
    }
    public function index(Request $request)
    {
          try {
            $storeBallanceHistories = $this->storeBallanceHistoryRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Riwayat Dompet Toko berhasil diambil', StoreBallanceHistoryResource::collection($storeBallanceHistories), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'nullable|string',
            'row_per_page' => 'required|integer',
        ]);

        try {
            $storeBallanceHistories = $this->storeBallanceHistoryRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page'],
            );

            return ResponseHelper::jsonResponse(true, 'Data Riwayat Dompet Toko berhasil diambil', PaginateResource::make($storeBallanceHistories, StoreBallanceHistoryResource::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    public function show(string $id)
    {
        try {
            $storeBallanceHistory = $this->storeBallanceHistoryRepository->getById(
                $id,
            );

            if (!$storeBallanceHistory){
                 return ResponseHelper::jsonResponse(false, 'Data riwayat dompet toko tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data riwayat dompet toko berhasil diambil', new StoreBallanceHistoryResource($storeBallanceHistory), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

}
