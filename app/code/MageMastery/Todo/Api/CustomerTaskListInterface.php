<?php

namespace MageMastery\Todo\Api;

/**
 * @api
 */
interface CustomerTaskListInterface
{
    /**
     * @return TaskInterface[]
     */
    public function getList();
}
