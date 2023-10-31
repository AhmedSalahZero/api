<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;
	
	public function jsonAs($user , $method , $url ,array $data= [], array $header = [] ){
		return $this->actingAs($user,'api')->json($method , $url  , $data , $header);
	}
	
}
