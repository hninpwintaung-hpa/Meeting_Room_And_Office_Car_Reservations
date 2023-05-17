<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use App\Repository\Team\TeamRepoInterface;
use App\Services\Team\TeamServiceInterface;
use Exception;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $teamService, $teamRepo;
    public function __construct(TeamServiceInterface $teamService, TeamRepoInterface $teamRepo)
    {

        $this->teamService = $teamService;
        $this->teamRepo = $teamRepo;
    }
    public function index()
    {
        try {
            $data = $this->teamRepo->get();
            return response()->json([
                'status' => 'success',
                'message' => "Team list all",
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
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
    public function store(TeamRequest $request)
    {
        try {
            $data = $this->teamService->store($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'new team store',
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
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
        try {
            $data = $this->teamRepo->show($id);
            return response()->json([
                'status' => 'success',
                'message' => "Team select",
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
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
    public function update(TeamRequest $request, $id)
    {
        try {
            $data = $this->teamService->update($request->validated(), $id);
            return response()->json([
                'status' => 'success',
                'message' => 'Team update',
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
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
        try {
            $data = $this->teamService->destroy($id);
            return response()->json([
                'status' => 'success',
                'message' => 'blog update',
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => $data
            ], 500);
        }
    }
}
