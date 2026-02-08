<?php

namespace App\Http\Controllers;

use App\Interfaces\StoreBallanceRepositoryInterface;
use App\Models\StoreBallance;
use App\Http\Resources\StoreBallanceResource;
use App\Helper\ResponseHelper;
use App\Http\Resources\PaginateResource;
use Illuminate\Http\Request;

class StoreBallanceController extends Controller
{
    private StoreBallanceRepositoryInterface $storeBallanceRepository;

    public function __construct(StoreBallanceRepositoryInterface $storeBallanceRepository)
    {
        $this->storeBallanceRepository = $storeBallanceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $storeBallance = $this->storeBallanceRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Dompet Toko berhasil diambil', StoreBallanceResource::collection($storeBallance), 200);
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
            $storeBallance = $this->storeBallanceRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page'],
            );

            return ResponseHelper::jsonResponse(true, 'Data dompet toko berhasil diambil', PaginateResource::make($storeBallance, StoreBallanceResource::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    public function show(string $id)
    {
          try {
            $storeBallance = $this->storeBallanceRepository->getById(
                $id,
            );

            if (!$storeBallance){
                 return ResponseHelper::jsonResponse(false, 'Data dompet toko tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data dompet toko berhasil diambil', new StoreBallanceResource($storeBallance), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }


}
