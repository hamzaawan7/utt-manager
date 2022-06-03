<?php

namespace App\Repositories;

/**
 * Interface ReviewRepositoryInterface
 * @package App\Repositories
 */
interface ReviewRepositoryInterface
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
     * @return mixed
     */
    public function get();

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

}