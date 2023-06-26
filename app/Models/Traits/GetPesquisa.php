<?php

namespace App\Models\Traits;

use PHPUnit\Exception;

trait GetPesquisa
{


    /**
     * @param $pesquisa
     * @return string
     *
     * Auth: Munzambi Miguel
     *
     * $relationShip propriety is required
     * $columnName propriety is required
     * $columnEmail propriety is required
     * $columnData propriety is required
     */

    public static function buildWildText($term)
    {
        return "%" . $term . "%";
    }

    public static function getPicagens($pesquisa)
    {
        try {
            if (\Auth::user()->isInterinando()) {

                return self::with(self::$relationShip)
                    ->whereHas(self::$relationShip, function ($q) use ($pesquisa) {
                        $q->whereRaw(self::$columnName . ' LIKE ?', self::buildWildText($pesquisa));
                        $q->whereIn(self::$columnEmail, \Auth::user()->getMyDirectPorts());
                    });

            } else if (\Auth::user()->isManager()) {

                return self::with(self::$relationShip)
                    ->whereHas(self::$relationShip, function ($q) use ($pesquisa) {
                        $q->whereRaw(self::$columnName . ' LIKE ?', self::buildWildText($pesquisa));
                        $q->whereIn(self::$columnEmail, \Auth::user()->getMyDirectPorts());
                    });

            } else {

                return self::with(self::$relationShip)
                    ->whereHas(self::$relationShip, function ($q) {
                        $q->where(self::$columnEmail, \Auth::user()->ldap->getEmail());
                    });

            }
        } catch (\Exception $d) {
            return self::where(self::$columnDate, 0)->orderBy(self::$columnDate, 'desc');
        }


    }
}
