<?php

namespace App\Repositories;

/**
 * Interface PriceSeasonRepositoryInterface
 * @package App\Repositories
 */
interface PriceSeasonRepositoryInterface
{
    /**
     * @return mixed
     */
    public function save($data);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @return void
     */
    public function all();

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string;

}