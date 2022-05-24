<?php

namespace App\Repositories\Eloquent;
use App\Models\Price;

class PriceRepository
{

    /** @var Price $price */
    public function __construct(Price $price)
    {
        $this->price = $price;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        try {
            $priceSeason = new $this->price;
            $priceSeason->name = $data['name'];
            $priceSeason->type = $data['type'];
            $priceSeason->from_date = $data['from_date'];
            $priceSeason->to_date = $data['to_date'];
            $priceSeason->save();
            return $priceSeason;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return $this->price::where('id', $id)->first();
    }

    /**
     * @param $data
     * @return string
     */
    public function update($data): string
    {
        try {
            $priceSeason = $this->price::where('id', intval($data['season_id']))->first();
            $priceSeason->name = $data['name'];
            $priceSeason->type = $data['type'];
            $priceSeason->from_date = $data['from_date'];
            $priceSeason->to_date = $data['to_date'];
            $priceSeason->update();
            return $priceSeason;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->price::all();
    }

    /**
     * @return void
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            return $this->price::where('id', $id)->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}