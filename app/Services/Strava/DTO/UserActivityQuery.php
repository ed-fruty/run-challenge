<?php

namespace App\Services\Strava\DTO;

class UserActivityQuery
{
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $perPage;
    /**
     * @var int|null
     */
    private $before;
    /**
     * @var int|null
     */
    private $after;

    /**
     * @param int $page
     * @param int $perPage
     * @param int|null $before
     * @param int|null $after
     */
    public function __construct(int  $page = 1, int  $perPage = 10, ?int $before = null, ?int $after = null)
    {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->before = $before;
        $this->after = $after;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return UserActivityQuery
     */
    public function setPage(int $page): UserActivityQuery
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return UserActivityQuery
     */
    public function setPerPage(int $perPage): UserActivityQuery
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBefore(): ?int
    {
        return $this->before;
    }

    /**
     * @param int|null $before
     * @return UserActivityQuery
     */
    public function setBefore(?int $before): UserActivityQuery
    {
        $this->before = $before;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAfter(): ?int
    {
        return $this->after;
    }

    /**
     * @param int|null $after
     * @return UserActivityQuery
     */
    public function setAfter(?int $after): UserActivityQuery
    {
        $this->after = $after;
        return $this;
    }
}
