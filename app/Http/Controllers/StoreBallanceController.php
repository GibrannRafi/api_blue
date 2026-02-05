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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
