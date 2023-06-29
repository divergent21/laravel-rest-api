<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function __construct ()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cache::tags('users-lists')->rememberForever('users-page-' . request('page', 1), function () {
            return UserResource::collection(User::paginate());
        });
    }

    public function posts(User $user) {
        return Cache::tags('user-posts')->rememberForever('user-posts-' . $user->id, function () use ($user) {
            return PostResource::collection($user->posts);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'login' => $request->login,
            'name' => $request->name,
            'role' => 'user',
            'password' => Hash::make($request->password)
        ]);

        return response($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Cache::tags('user')->rememberForever('user-' . $user->id, function () use ($user) {
            return UserResource::make($user);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return response()->noContent(202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent(204);
    }
}
