<?php


namespace Rentit;


interface Model
{
    public function getDB();
    public function getSingleResult($sql, $params = null);
    public function getResults($sql, $params = null);
}