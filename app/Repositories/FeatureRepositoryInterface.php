<?php

namespace App\Repositories;

interface FeatureRepositoryInterface
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
