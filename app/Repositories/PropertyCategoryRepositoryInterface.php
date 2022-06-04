<?php

namespace App\Repositories;

/**
 * Interface PropertyCategoryRepositoryInterface
 * @package App\Repositories
 */
interface PropertyCategoryRepositoryInterface
{
    /**
     * @param $data
     * @return string
     */
    public function save($data): string;

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