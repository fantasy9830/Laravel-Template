<?php

namespace App\Auth\Libraries;

use Illuminate\Http\Request;
use App\Auth\Contracts\ApiAuthContract;
use App\Auth\Repositories\UserRepository;
use Carbon\Carbon;
use DomainException;
use Firebase\JWT\JWT;

class ApiAuth extends Guard implements ApiAuthContract
{
    protected $algo;

    protected $currentId = '';

    protected $key;

    protected $request;

    protected $userRepository;

    public function __construct(Request $request, UserRepository $userRepository)
    {
        $this->algo = env('JWT_ALGO');
        $this->key = env('APP_KEY');
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function createToken(string $username = '')
    {
        if ($userId = $this->getUserID($username)) {
            $userData = $this->userRepository->find($userId);

            $payload = [
                'iss' => 'Company',
                'sub' => $username,
                'iat' => Carbon::now()->toIso8601String(),
                'name' => $userData->name,
                'roles' => $this->roles($userId),
                'permissions' => $this->permissions($userId),
            ];

            return JWT::encode($payload, $this->key, $this->algo);
        }
    }

    public function verifyToken(string $token = null): bool
    {
        if ($token) {
            try {
                $payload = JWT::decode($token, $this->key, [$this->algo]);
            } catch (DomainException $e) {
                abort(401, 'Token invalid.');
            }

            $userId = $this->getUserID($payload->sub);
            if ($userId) {
                $this->setCurrentId($userId);

                return true;
            }
        }

        return false;
    }

    public function login(string $username = '', string $password = ''): bool
    {
        if ($this->attempt($username, $password)) {
            $userId = $this->getUserID($username);

            $this->setCurrentId($userId);

            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->currentId = null;
    }

    public function permissions(string $userId = ''): array
    {
        return $this->userRepository->getPermissions($userId)->all();
    }

    public function roles(string $userId = ''): array
    {
        return $this->userRepository->getRoles($userId)->all();
    }

    public function isContractor(): bool
    {
        return !is_numeric($this->getCurrentId());
    }

    public function getCurrentId(): string
    {
        if ($this->currentId) {
            return $this->currentId;
        } else {
            $token = $this->request->bearerToken();

            $this->verifyToken($token);

            return $this->currentId;
        }
    }

    public function setCurrentId(string $currentId = '')
    {
        $this->currentId = $currentId;
    }
}
