<?php

namespace MageMastery\Todo\Api;

use MageMastery\Todo\Api\Data\TaskInterface;

/**
 * @api
 */
interface CustomerTaskListInterface
{
    /**
     * @param int $customerId
     * @return mixed
     */
    public function getList(int $customerId);
}
