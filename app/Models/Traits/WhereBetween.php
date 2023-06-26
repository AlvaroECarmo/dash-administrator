<?php

namespace App\Models\Traits;

trait WhereBetween
{

    private function buildDateInitial($initialDate)
    {
        if ($initialDate == "") {
            return null;
        }

        return \Date::parse($initialDate)->format('Y-d-m');
    }

    private function buildDateFinal($finalDate)
    {
        if ($finalDate == "") {
            return null;
        }

        return \Date::parse($finalDate)->format('Y-d-m');
    }

    protected function scopeDateBetween($query, $initialDate, $finalDate)
    {
        $columns = implode(',', $this->searchable);
        // Boolean mode allows us to match john* for words starting with john
        // (https://dev.mysql.com/doc/refman/5.6/en/fulltext-boolean.html)
        if ($initialDate != "" && $finalDate != "") {
            $campo = $this->dateSeach[0];
            $query->whereBetween($campo, [$this->buildDateInitial($initialDate), $this->buildDateFinal($finalDate)]);//($campo . ' LIKE ?', [$this->buildWildCards($term)]);
        }

        $contagemCampos = count($this->searchable);
        for ($x = 1; $x < $contagemCampos; $x++) {
            $campo = $this->searchable[$x];
            $query->orWhereBetween($campo, [$this->buildDateInitial($initialDate), $this->buildDateFinal($finalDate)]);
        }

        return $query;

    }
}
