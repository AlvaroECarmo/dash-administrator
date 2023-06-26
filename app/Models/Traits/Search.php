<?php

namespace App\Models\Traits;

trait Search
{
    private function buildWildCards($term) {
        if ($term == "") {
            return $term;
        }

        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);
        foreach($words as $idx => $word) {
            // Add operators so we can leverage the boolean mode of
            // fulltext indices.
            $words[$idx] = "%" . $word . "%";
        }
        $term = implode(' ', $words);
        return $term;
    }

    protected function scopeSearch($query, $term) {
        $columns = implode(',', $this->searchable);

        // Boolean mode allows us to match john* for words starting with john
        // (https://dev.mysql.com/doc/refman/5.6/en/fulltext-boolean.html)
            $campo = $this->searchable[0];

        $query->whereRaw($campo.' LIKE ?',[$this->buildWildCards($term)]);

        $contagemCampos = count($this->searchable);

        for ($x = 1; $x < $contagemCampos; $x++) {
            $campo = $this->searchable[$x];
            $query->orWhereRaw($campo.' LIKE ?',$this->buildWildCards($term));
        }

        return $query;
    }
}
