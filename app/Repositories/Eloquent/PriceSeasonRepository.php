<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PriceSeasonRepositoryInterface;
use App\Models\Season;
use App\Models\TypeSeason;

class PriceSeasonRepository implements PriceSeasonRepositoryInterface
{
    /** @var Season $season */
    /** @var TypeSeason $typeSeason */
    public function __construct(
        Season $season,
        TypeSeason  $typeSeason
    )
    {
        $this->season = $season;
        $this->typeSeason = $typeSeason;
    }

    /**
     * @param $data
     * @return string
     */
    public function save($data): string
    {
        if (!is_null($data['season_id'])) {
            try {
                $season = $this->season->find($data['season_id']);
                $season = $this->getCommonFields($data, $season);
                $season->update();

                return 'Data Updated successfully.';
            } catch (\Exception $e) {
                return $e->getMessage();
            }

        } else {
            try {
                $season = new $this->season;
                $season = $this->getCommonFields($data, $season);
                $season->save();
                $seasonId              = $season->id;
                $typeSeason            = new $this->typeSeason;
                $typeSeason->season_id = $seasonId;
                $typeSeason->type_id   = $data['type_id'] ;
                $typeSeason->save();

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function getCommonFields($data, $season)
    {
        $season->season_name = $data['season_name'];
        $season->from_date   = dateFormat($data['from_date']);
        $season->to_date     = dateFormat($data['to_date']);

        return $season;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id)
    {
        return $this->priceSeason::where('id', $id)->first();
    }

    /**
     * @param $data
     * @return string
     */
    public function update($data): string
    {
        try {
            $priceSeason = $this->priceSeason::where('id', intval($data['season_id']))->first();
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
        return $this->season->all();
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
            return $this->priceSeason::where('id', $id)->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}