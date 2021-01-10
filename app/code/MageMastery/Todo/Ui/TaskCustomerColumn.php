<?php

declare(strict_types=1);
namespace MageMastery\Todo\Ui;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use http\Exception;

class TaskCustomerColumn extends Column
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){
            foreach($dataSource['data']['items'] as &$item){
                $item[$this->getData('name')] = $this->prepareItem($item);
            }
        }
        return $dataSource;
    }

    /**
     * @param array $item
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function prepareItem(array $item)
    {
        try {
            if($item['customer_id']!==null){
                $customer = $this->customerRepository->getById((int)$item['customer_id']);
                return $customer->getFirstname().' '.$customer->getLastname();
            }else{
                return 'N/A';
            }

        } catch (Exception $exception) {
            return 'N/A';
        }

    }
}
