<?php

namespace App\Services;

use App\Helpers\UserTypes;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\User;
use App\Notifications\StaffMemberCreated;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffService {
    public function list(): Collection
    {
        $staff = User::staff()->get();

        return $staff;
    }

    public function store(StoreStaffRequest $request): User
    {
        try {
            $staff = new User();

            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->password = Hash::make($request->password);
            $staff->type = UserTypes::STAFF;

            $staff->save();

            $staff->notify(new StaffMemberCreated(Auth::user(), $request->password));

            return $staff;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function update(UpdateStaffRequest $request, User $staff): User
    {
        $staff->name = $request->name;

        $staff->save();

        return $staff;
    }

    public function delete(User $staff): void
    {
        $staff->delete();
    }
}