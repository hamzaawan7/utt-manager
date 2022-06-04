<?php

namespace App\Repositories;

/**
 * Interface CustomerRepositoryInterface
 * @package App\Repositories
 */
interface CustomerRepositoryInterface
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
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

}