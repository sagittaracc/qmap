<?php

namespace sagittaracc;

class QMap
{
    private $query;

    private $map;

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setColumn($column, $callback)
    {
        $this->map[$column] = $callback;
    }

    public function getColumn($column, $data)
    {
        return $this->map[$column]($data);
    }
}