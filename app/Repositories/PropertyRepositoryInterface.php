<?php

namespace App\Repositories;

/**
 * Interface PropertyRepositoryInterface
 * @package App\Repositories
 */
interface PropertyRepositoryInterface
{
    /**
     * @param $data
     * @return mixed
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