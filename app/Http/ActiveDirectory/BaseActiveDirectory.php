<?php

namespace App\Http\ActiveDirectory;

interface BaseActiveDirectory
{
  public function save() : bool;
  public function delete() : bool;
  public function find(int $id) : bool;
  public static function findAll() : array;
}
