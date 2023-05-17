<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Repository\Role\RoleRepoInterface;
use App\Services\Role\RoleServiceInterface;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $roleService, $roleRepo;
    public function __construct(RoleServiceInterface $roleService, RoleRepoInterface $roleRepo){

        $this->roleService = $roleService;
        $this->roleRepo = $roleRepo;
    }
    public function index()
    {
        try{
            $data = $this->roleRepo->get();
            return response()->json([
            'status' => 'success',
            'message' => "Role list all",
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
    public function store(RoleRequest $request)
    {
        try{
            $data = $this->roleService->store($request->validated());
            return response()->json([
            'status' => 'success',
            'message' => 'New role store',
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
            $data = $this->roleRepo->show($id);
            return response()->json([
            'status' => 'success',
            'message' => "Role select",
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
    public function update(RoleRequest $request, $id)
    {
        try{
            $data = $this->roleService->update($request->validated(), $id);
            return response()->json([
            'status' => 'success',
            'message' => 'Role update',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = $this->roleService->destroy($id);
            return response()->json([
            'status' => 'success',
            'message' => 'Role delete',
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
}
