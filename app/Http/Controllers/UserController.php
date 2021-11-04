<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserIndexRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index(UserIndexRequest $request)
    {
        $resultCode = Response::HTTP_OK;

        try {
            $users = $this->userService->getPaginated($request->validated());

            return $users;

        } catch (Exception $e) {
            $resultCode = $e->getCode();

            $result = [
                "message" => __('messages.not_found', ['model' => 'Users']),
                "error" => $e->getMessage(),
            ];

            return response()->json($result, $resultCode);
        }
    }

    public function store(UserStoreRequest $request)
    {
        $resultCode = Response::HTTP_OK;

        try {
            $user = $this->userService->saveData($request->validated());

            return $user;

        } catch (Exception $e) {
            $resultCode = $e->getCode();

            $result = [
                "message" => __('messages.store_error', ['model' => 'User']),
                "error" => $e->getMessage(),
            ];

            return response()->json($result, $resultCode);
        }
    }

    public function show($id)
    {
        $resultCode = Response::HTTP_OK;

        try {
            $user = $this->userService->getById($id);

            return $user;

        } catch (Exception $e) {
            $resultCode = $e->getCode();

            $result = [
                "message" => __('messages.not_found', ['model' => 'User']),
                "error" => $e->getMessage(),
            ];

            return response()->json($result, $resultCode);
        }
    }

    public function update($id, UserUpdateRequest $request)
    {
        $resultCode = Response::HTTP_OK;

        try {
            $user = $this->userService->updateDataById($id, $request->validated());

            return $user;

        } catch (Exception $e) {
            $resultCode = $e->getCode();

            $result = [
                "message" => __('messages.update_error', ['model' => 'User']),
                "error" => $e->getMessage(),
            ];

            return response()->json($result, $resultCode);
        }
    }

    public function destroy($id)
    {
        $resultCode = Response::HTTP_OK;

        try {
            $this->userService->deleteById($id);

            $result = ["message" => __('messages.destroy', ['model' => 'User'])];

        } catch (Exception $e) {
            $resultCode = $e->getCode();

            $result = [
                "message" => __('messages.destroy_error', ['model' => 'User']),
                "error" => $e->getMessage(),
            ];
        }

        return response()->json($result, $resultCode);
    }
}
