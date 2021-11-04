<?php

namespace App\Services;

use Exception;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {}

    /**
     * Store a new user
     *
     * @param  array  $data
     * @param  string $output
     * @return UserResource|Model
     */
    public function saveData(array $data = [], string $output = "resource"): UserResource|Model
    {
        $data['password'] = Hash::make($data['password']); // hash password
        $user = $this->userRepository->create($data);

        return match($output) {
            "model" => $user,
            default => new UserResource($user),
        };
    }

    /**
     * Get users paginated
     *
     * @param array  $filters
     * @param array  $relationships
     * @param string $output
     * @return UserResourceCollection|Collection
     */
    public function getPaginated(array $filters = [], array $relationships = [], string $output = "resource"): AnonymousResourceCollection|Collection
    {
        $users = $this->userRepository->paginate(
            filters: $filters,
            relations: $relationships,
            perPage: $filters['per_page'] ?? 15
        );

        return match($output) {
            "collection" => $users,
            default => UserResource::collection($users),
        };
    }

    /**
     * Get all users
     *
     * @param array  $filters
     * @param array  $relationships
     * @param string $output
     * @return UserResourceCollection|Collection
     */
    public function getAll(array $filters = [], array $relationships = [], string $output = "resource")
    {
        $users = $this->userRepository->all(filters: $filters, relations: $relationships);

        return match($output) {
            "collection" => $users,
            default => UserResource::collection($users),
        };
    }

    /**
     * Get user by id
     *
     * @param integer $id
     * @param array   $relationships
     * @param string  $output
     * @return UserResource|Model
     */
    public function getById(int $id = 0, array $relationships = [], string $output = "resource"): UserResource|Model
    {
        $user = $this->userRepository->findById(modelId: $id, relations: $relationships);

        return match($output) {
            "model" => $user,
            default => new UserResource($user),
        };
    }

    /**
     * Update an user by id
     *
     * @param integer $id
     * @param array   $data
     * @param string  $output
     * @return UserResource|Model
     */
    public function updateDataById(int $id = 0, array $data = [], string $output = "resource"): UserResource|Model
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $this->userRepository->update($id, $data);
        $user = $this->userRepository->findById($id);

        return match($output) {
            "model" => $user,
            default => new UserResource($user),
        };
    }

    /**
     * Delete user by id
     *
     * @param  integer $id
     * @return bool
     */
    public function deleteById(int $id = 0)
    {
        return $this->userRepository->deleteById($id);
    }
}
