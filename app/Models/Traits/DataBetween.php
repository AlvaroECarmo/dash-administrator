<?php

namespace App\Models\Traits;


trait DataBetween
{

    private function buildDateInitial($initialDate)
    {
        if ($initialDate == "") {
            return null;
        }

        return \Date::parse($initialDate)->format('Y-m-d');
    }

    private function buildDateFinal($finalDate)
    {
        if ($finalDate == "") {
            return null;
        }

        return \Date::parse($finalDate)->format('Y-m-d');
    }

    protected function scopeDateBetween($query, $initialDate, $finalDate)
    {
        $columns = implode(',', $this->dateSeach);
        // Boolean mode allows us to match john* for words starting with john
        // (https://dev.mysql.com/doc/refman/5.6/en/fulltext-boolean.html)
        if ($initialDate != "" && $finalDate != "") {
            $campo = $this->dateSeach[0];
            $query->whereBetween($campo, [$this->buildDateInitial($initialDate), $this->buildDateFinal($finalDate)]);//($campo . ' LIKE ?', [$this->buildWildCards($term)]);
        }

        $contagemCampos = count($this->dateSeach);
        for ($x = 1; $x < $contagemCampos; $x++) {
            $campo = $this->searchable[$x];
            $query->orWhereBetween($campo, [$this->buildDateInitial($initialDate), $this->buildDateFinal($finalDate)]);
        }

        return $query;

    }
}
