<?php

namespace App\Repositories;

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
    public function edit(int $id);

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
     * @return mixed
     */
    public function delete(int $id);
}