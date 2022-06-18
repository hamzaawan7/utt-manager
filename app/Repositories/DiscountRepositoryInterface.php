<?php

namespace App\Repositories;

/**
 * Class DiscountRepositoryInterface
 * @package App\Repositories
 */
interface DiscountRepositoryInterface
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
