<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\User;
use App\Services\StaffService;
use Exception;

class StaffController extends Controller
{
    private $staffService;

    public function __construct(StaffService $service)
    {
        $this->staffService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = $this->staffService->list();

        return $this->successResponse($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        try {
            $staff = $this->staffService->store($request);

            return $this->successResponse($staff, 'Staff member created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse();
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, User $staff)
    {
        $staff = $this->staffService->update($request, $staff);

        return $this->successResponse($staff, 'Staff member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $staff)
    {
        $this->staffService->delete($staff);

        return $this->successResponse(null, 'Staff member deleted successfully');
    }
}
