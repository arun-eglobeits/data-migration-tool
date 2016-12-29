<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Migration\Step\PostProcessing\Data;

use Migration\ResourceModel;
use Migration\Step\PostProcessing\Model\ProductsInRootCatalog as ProductsInRootCatalogModel;

/**
 * Class ProductsInRootCatalogCleaner
 */
class ProductsInRootCatalogCleaner
{
    /**
     * @var ResourceModel\Destination
     */
    private $destination;

    /**
     * @var ProductsInRootCatalogModel
     */
    private $productsInRootCatalogModel;

    /**
     * @param ResourceModel\Destination $destination
     * @param ProductsInRootCatalogModel $productsInRootCatalogModel
     */
    public function __construct(
        ResourceModel\Destination $destination,
        ProductsInRootCatalogModel $productsInRootCatalogModel
    ) {
        $this->destination = $destination;
        $this->productsInRootCatalogModel = $productsInRootCatalogModel;
    }

    /**
     * Deletes products assigned to root category
     *
     * @return void
     */
    public function clean()
    {
        $productIds = $this->productsInRootCatalogModel->getProductIds();
        if (!$productIds) {
            return ;
        }
        $this->destination->deleteRecords(
            $this->productsInRootCatalogModel->getCatalogCategoryProductDocument(),
            'entity_id',
            $productIds
        );
    }
}
