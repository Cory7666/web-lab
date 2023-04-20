<?php

namespace App\Http\ActiveDirectory;

interface BaseActiveDirectory
{
  public function save();
  public function delete();
  public function find($id);
  public function findAll();
}
