<?php

namespace sagittaracc;

/**
 * Способ задание выборок из результатов запросов
 * 
 * @author Yuriy Arutyunyan <sagittaracc@gmail.com>
 */
class QMap
{
    /**
     * @var string выполняемый запрос
     */
    private $query;
    /**
     * @var array таблица коллбэков с правилами выборок по имени поля
     */
    private $map;
    /**
     * Задает запрос
     * @param string $query
     * @return self
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }
    /**
     * Возвращает запрос
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }
    /**
     * Задает поле и коллбэк выборки по нему
     * @param string $column
     * @param $callback
     */
    public function setColumn($column, $callback)
    {
        $this->map[$column] = $callback;
    }
    /**
     * Осуществляет выборку по полю из результата запроса
     * @param string $column
     * @param mixed $data
     * @return mixed
     */
    public function getColumn($column, $data)
    {
        return $this->map[$column]($data);
    }
}