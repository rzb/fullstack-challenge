<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate($request->input('per_page')));
    }

    public function show(User $user): UserResource
    {
        return UserResource::make($user);
    }
}
