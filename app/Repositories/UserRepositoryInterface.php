<?php

namespace App\Repositories;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface UserRepositoryInterface
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
     * @return mixed
     */
    public function delete(int $id);
}