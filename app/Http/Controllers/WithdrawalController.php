<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Http\Requests\ApproveRequest;
use App\Http\Requests\WithdrawalStoreRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\WithdrawalResouce;
use App\Interfaces\WithdrawalRepositoryInterface;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    private WithdrawalRepositoryInterface $withdrawalRepository;

    public function __construct(WithdrawalRepositoryInterface $withdrawalRepository)
    {
        $this->withdrawalRepository = $withdrawalRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         try {
            $withDrawals = $this->withdrawalRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data withdrawal berhasil diambil', WithdrawalResouce::collection($withDrawals   ), 200);
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
            $withdrawals = $this->withdrawalRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page'],
            );

            return ResponseHelper::jsonResponse(true, 'Data withdrawal berhasil diambil', PaginateResource::make($withdrawals, WithdrawalResouce::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(WithdrawalStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $withdrawal = $this->withdrawalRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data withdrawal berhasil ditambahkan', new WithdrawalResouce($withdrawal), 201);
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
            $withdrawal = $this->withdrawalRepository->getById(
                $id,
            );

            if (!$withdrawal){
                 return ResponseHelper::jsonResponse(false, 'Data withdrawal tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data withdrawal berhasil diambil', new WithdrawalResouce($withdrawal), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }

    public function approve (ApproveRequest $request, string $id)
    {
        $request = $request->validated();

        try {
            $withdrawal = $this->withdrawalRepository->getById(
                $id,
            );

            if (!$withdrawal){
                 return ResponseHelper::jsonResponse(false, 'Data withdrawal tidak ditemukan', null, 404);
            }

            $withdrawal = $this->withdrawalRepository->approve(
                $id,
                $request['proof'],
            );

            return ResponseHelper::jsonResponse(true, 'Data withdrawal berhasil disetujui', new WithdrawalResouce($withdrawal), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false,   $e->getMessage(), null, 500);
        }
    }


}
