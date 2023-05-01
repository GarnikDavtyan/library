<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StaffService;

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

        return view('pages.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.staff.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $staff)
    {
        return view('pages.staff.edit', compact('staff'));
    }
}
