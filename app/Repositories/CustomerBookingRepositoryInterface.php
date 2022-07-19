<?php

namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface CustomerBookingRepositoryInterface
{
    /**
     * @param $data
     * @return JsonResponse|null
     */
    public function save($data);

}