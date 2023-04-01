<?php
namespace app\Interfaces;

interface IRepository{
    public  function getOne($id);
    public  function getAll();
    public function getLimit($offset,$limit);
    public function getCount();
  
}