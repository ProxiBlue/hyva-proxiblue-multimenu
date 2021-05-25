<?php

declare(strict_types=1);

namespace ProxiBlue\MultiMenu\Service;

use Hyva\Theme\Service\Navigation as HyvaNavigation;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryColleciton;
use Magento\Framework\Data\Collection;
use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\Data\TreeFactory;
use Magento\Framework\Exception\LocalizedException;

/** @see \Magento\Catalog\Plugin\Block\Topmenu */

class Navigation extends HyvaNavigation
{

    /**
     * Initialize dependencies.
     *
     * @param \Magento\Catalog\Helper\Category $catalogCategory
     * @param \Magento\Catalog\Model\ResourceModel\Category\StateDependentCollectionFactory $categoryCollectionFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param NodeFactory $nodeFactory
     * @param TreeFactory $treeFactory
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     */
    public function __construct(
        \Magento\Catalog\Helper\Category $catalogCategory,
        \Magento\Catalog\Model\ResourceModel\Category\StateDependentCollectionFactory $categoryCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        NodeFactory $nodeFactory,
        TreeFactory $treeFactory,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver
    ) {
        parent::__construct($catalogCategory,$categoryCollectionFactory,$storeManager,$nodeFactory,$treeFactory,$layerResolver);
    }

    /**
     * Convert category to array
     *
     * @param Category $category
     * @param Category $currentCategory
     * @param bool $isParentActive
     * @return array
     * @throws LocalizedException
     */
    protected function getCategoryAsArray($category, $currentCategory, $isParentActive)
    {
        $categoryId = $category->getId();
        return [
            'name' => $category->getName(),
            'id' => 'category-node-' . $categoryId,
            'url' => $this->catalogCategory->getCategoryUrl($category),
            'image' => $category->getImageUrl(),
            'has_active' => in_array((string)$categoryId, explode('/', (string)$currentCategory->getPath()), true),
            'is_active' => $categoryId == $currentCategory->getId(),
            'is_category' => true,
            'is_parent_active' => $isParentActive,
            'position' => $category->getData('position'),
            'menu_css_class' => $category->getData('menu_css_class')
        ];
    }

    /**
     * Get Category Tree
     *
     * @param int $storeId
     * @param int $rootId
     * @param int $maxLevel
     * @return CategoryColleciton
     * @throws LocalizedException
     */
    protected function getCategoryTree($storeId, $rootId, $maxLevel = 0)
    {
        /** @var CategoryColleciton $collection */
        $collection = $this->collectionFactory->create();
        $collection->setStoreId($storeId);
        $collection->addAttributeToSelect(['name', 'image', 'menu_css_class']);
        $collection->addFieldToFilter('path', ['like' => '1/' . $rootId . '/%']); //load only from store root
        $collection->addAttributeToFilter('include_in_menu', 1);
        $collection->addIsActiveFilter();
        if ($maxLevel > 0) {
            $collection->addLevelFilter($maxLevel);
        } else {
            $collection->addNavigationMaxDepthFilter();
        }
        $collection->addUrlRewriteToResult();
        $collection->addOrder('level', Collection::SORT_ORDER_ASC);
        $collection->addOrder('position', Collection::SORT_ORDER_ASC);
        $collection->addOrder('parent_id', Collection::SORT_ORDER_ASC);
        $collection->addOrder('entity_id', Collection::SORT_ORDER_ASC);

        return $collection;
    }

}
