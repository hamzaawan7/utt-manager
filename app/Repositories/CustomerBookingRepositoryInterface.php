<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface CustomerBookingRepositoryInterface
{
    /**
     * @param $data
     * @return JsonResponse|void
     */
    public function save($data);

}