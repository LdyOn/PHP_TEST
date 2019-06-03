<?php
namespace Lib;

interface  DbInterface
{
	public  function  get($field);
	public  function  update($data);
	public  function  where($where);
	public  function  delete();
	public  function  limite();
	public  function  orderBy();
	public  function  add();
	public  function  first();
	public  function  table($table);
	public  function  toArray();
}

