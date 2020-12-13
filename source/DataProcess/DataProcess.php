<?php

interface DataProcess
{
    public function insertEntity($entity);

    public function deleteEntity($key, $value);

    public function updateEntity();

}

