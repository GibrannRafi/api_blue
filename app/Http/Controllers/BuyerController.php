<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Resources\BuyerResource;
use App\Http\Resources\PaginateResource;
use App\Interfaces\BuyerRepositoryInterface;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
   private BuyerRepositoryInterface $buyerRepository;

    public function __construct(BuyerRepositoryInterface $buyerRepository)
    {
        $this->buyerRepository = $buyerRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      try {
            $buyers = $this->buyerRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Buyer berhasil diambil', BuyerResource::collection($buyers), 200);
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
            $buyers = $this->buyerRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page'],
            );

            return ResponseHelper::jsonResponse(true, 'Data Buyer berhasil diambil', PaginateResource::make($buyers, BuyerResource::class), 200);
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
