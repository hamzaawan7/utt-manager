<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PriceSeasonRepositoryInterface;
use App\Models\Season;
use App\Models\TypeSeason;

/**
 * Class PriceSeasonRepository
 * @package App\Repositories\Eloquent
 */
class PriceSeasonRepository implements PriceSeasonRepositoryInterface
{
    /**
     * @var Season
     */
    private $season;
    /**
     * @var TypeSeason
     */
    private $typeSeason;

    /**
     * @param Season $season
     * @param TypeSeason $typeSeason
     */
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

                return "Data Saved Successfully";
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function getCommonFields($data, $season)
    {
        $season->type_id     = $data['type'];
        $season->season_name = $data['season_name'];
        $season->from_date   = dateFormat($data['from_date']);
        $season->to_date     = dateFormat($data['to_date']);

        return $season;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->season->find($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->season->all();
    }

    /**
     * @param int $id
     * @return string
     */
    public function delete(int $id): string
    {
        try {
            $this->typeSeason->where('season_id', $id)->delete();
            $this->season->where('id', $id)->delete();

            return "Data Deleted Successfully";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}