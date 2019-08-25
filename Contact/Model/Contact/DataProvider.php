<?php

namespace SMile\Contact\Model\Contact;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use SMile\Contact\Model\ResourceModel\Contact\CollectionFactory;

/**
 * Class DataProvider
 *
 * @package SMile\Contact\Model\Contact
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Contact Request collection
     *
     * @var \SMile\Contact\Model\ResourceModel\Contact\Collection
     */
    protected $collection;

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Loaded data
     *
     * @var array
     */
    private $loadedData;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DataProvider constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $ContactCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface    $storeManager
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $ContactCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $ContactCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $contactRequest) {
            $this->loadedData[$contactRequest->getId()] = $contactRequest->getData();
        }

        $data = $this->dataPersistor->get('smile_contact_contactrequest');
        if (!empty($data)) {
            $contactRequest = $this->collection->getNewEmptyItem();
            $contactRequest->setData($data);
            $this->loadedData[$contactRequest->getId()] = $contactRequest->getData();
            $this->dataPersistor->clear('smile_contact_contactrequest');
        }

        return $this->loadedData;
    }
}
