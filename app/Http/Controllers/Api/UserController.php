<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repository\User\UserRepoInterface;
use App\Services\User\UserServiceInterface;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userService, $userRepo;
    public function __construct(UserServiceInterface $userService, UserRepoInterface $userRepo){

        $this->userService = $userService;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        try{
            $user = Auth::user();
            if (!$user->can('user-list')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to view user lists',
                ], 403);
            }
            $data = $this->userRepo->get();
            return response()->json([
            'status' => 'success',
            'message' => "user list all",
            'data' => $data
        ], 200);

        } catch(Exception $e) {
            return response()->json([
            'status' => 'error',
            'message' => $e->getMesage(),
            'data' => $data
        ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            $data = $this->userService->store($request->validated());
            return response()->json([
            'status' => 'success',
            'message' => 'New user store',
            'data' => $data
        ], 200);
        }  catch(Exception $e) {
            return response()->json([
            'status' => 'error',
            'message' => $e->getMesage(),
            'data' => $data
        ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = $this->userRepo->show($id);
            return response()->json([
            'status' => 'success',
            'message' => "user select",
            'data' => $data
        ], 200);

        } catch(Exception $e) {
            return response()->json([
            'status' => 'error',
            'message' => $e->getMesage(),
            'data' => $data
        ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userDelete($id)
    {
        try{

            $user = Auth::user();
            if (!$user->can('delete-user')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to delete a user',
                ], 403);
            } else {

                $userToDelete = User::find($id);
                if (!$userToDelete) {
                    return response()->json(['message' => 'User not found'], 404);
                }

                if ($userToDelete->hasRole('Admin')) {
                    return response()->json(['message' => 'Cannot delete a user with Admin role'], 403);
                }

                if ($userToDelete->hasRole('SuperAdmin')) {
                    return response()->json(['message' => 'Cannot delete a user with Super Admin role'], 403);
                }

                $data = $this->userService->destroy($id);
                return response()->json([
                'status' => 'success',
                'message' => 'user delete successful',
                'data' => $data
                ], 200);
            }


        }  catch(Exception $e) {
            return response()->json([
            'status' => 'error',
            'message' => $e->getMesage(),
            'data' => $data
        ], 500);
        }
    }

    public function adminDelete($id)
    {
        try{

            $user = Auth::user();
            if (!$user->can('delete-admin')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You do not have permission to delete admin',
                ], 403);
            } else {

                $userToDelete = User::find($id);
                if (!$userToDelete) {
                    return response()->json(['message' => 'User not found'], 404);
                }

                $data = $this->userService->destroy($id);
                return response()->json([
                'status' => 'success',
                'message' => 'admin delete successful',
                'data' => $data
                ], 200);
            }


        }  catch(Exception $e) {
            return response()->json([
            'status' => 'error',
            'message' => $e->getMesage(),
            'data' => $data
        ], 500);
        }
    }


}
