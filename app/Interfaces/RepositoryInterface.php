<?php


namespace App\Interfaces;


interface RepositoryInterface
{
	/**
	 * Repository Interface
	 *
	 * @param int $id
	 *
	 */
	public function find(int $id);
}