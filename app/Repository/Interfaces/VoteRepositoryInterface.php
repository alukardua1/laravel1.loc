<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository\Interfaces;


/**
 * Interface VoteRepositoryInterface
 *
 * @package App\Repositories\Interfaces
 */
interface VoteRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function plusVotes(int $id): mixed;

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function minusVotes(int $id): mixed;
}
