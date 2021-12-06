<?php

namespace App\Services\Strava\DTO;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UserTokenResponse
{
    /**
     * @var \stdClass
     */
    private $token;

    /**
     * @param \stdClass $token
     */
    public function __construct(\stdClass $token)
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->token->athlete->id;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return (string) $this->token->access_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return (string) $this->token->refresh_token;
    }

    /**
     * @return Carbon
     */
    public function getExpireAt(): Carbon
    {
        return Carbon::parse($this->token->expires_at);
    }

    public function getFirstName(): string
    {
        return $this->token->athlete->firstname ?? '';
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->token->athelete->lastname ?? '';
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        $username = $this->token->athlete->username ?? $this->token->athlete->id;

        return $username . '@strava.com';
    }

    /**
     * @return string
     */
    public function getProfile(): string
    {
        return $this->token->athlete->profile ?? '';
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->token->athlete->state ?? '';
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->token->athele->city ?? '';
    }

}
