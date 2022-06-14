<?php

namespace App\Repositories;

/**
 * Interface TypeRepositoryInterface
 * @package App\Repositories
 */
interface TypeRepositoryInterface
{
    /**
     * @param $data
     * @return string|void
     */
    public function save($data);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @return mixed
     */

    public function delete(int $id);
}