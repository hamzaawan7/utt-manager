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
    public function edit(int $id);

    /**
     * @param $data
     * @return string
     */
    public function update($data): string;

    /**
     * @return void
     */
    public function all();

    /**
     * @return void
     */
    public function get();

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string;
}