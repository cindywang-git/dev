<?php

namespace MageMastery\Todo\Model\ResourceModel\Task;

use MageMastery\Todo\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \MageMastery\Todo\Model\Task;
use \MageMastery\Todo\Model\ResourceModel\Task as TaskResource;

class Collection extends AbstractCollection implements TaskSearchResultInterface
{
	protected function _construct()
	{
		$this->_init(Task::class, TaskResource::class);
	}

    /**
     * @return \Magento\Framework\Api\SearchCriteriaInterface|mixed
     */
	public function getSearchCriteria()
    {
        return $this->getSearchCriteria();
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this|TaskSearchResultInterface
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        $this-$searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items = null)
    {
        if(!items) {
            return $this;
        }
        foreach ($items as $item){
            $this->addItem($item);
        }
        return $this;
    }

    /**
     * @return int|void
     */
    public function getTotalCount()
    {
        $this->getSize();
    }

    /**
     * @param int $totalCount
     * @return $this|TaskSearchResultInterface
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
}
