<?php

namespace App\Repositories;

/**
 * Interface PriceCategoryRepositoryInterface
 * @package App\Repositories
 */
interface PriceCategoryRepositoryInterface
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