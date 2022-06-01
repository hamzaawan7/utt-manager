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
    public function edit(int $id);

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