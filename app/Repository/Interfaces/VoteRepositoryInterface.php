<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Repository\Interfaces;

interface VoteRepositoryInterface
{
    /**
     * Нравится
     *
     * @param int $id ID записи
     *
     * @return mixed
     */
    public function plusVotes(int $id): mixed;

    /**
     * Не нравится
     *
     * @param int $id ID записи
     *
     * @return mixed
     */
    public function minusVotes(int $id): mixed;
}
