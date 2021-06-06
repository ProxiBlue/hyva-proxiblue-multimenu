<?php

/*
 * (c) Lucas van Staden <sales@proxiblue.com.au>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

declare(strict_types=1);

namespace ProXiBlue\MultiMenu\ViewModel;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Image implements ArgumentInterface
{
    /* @var Filesystem */
    private $_filesystem;

    /* @var StoreManagerInterface */
    private $_storeManager;

    /* @var AdapterFactory */
    private $_imageFactory;

    /* @var \Magento\Framework\Filesystem\Directory\WriteInterface */
    private $_directory;

    private $_logger;

    private $_scopeConfig;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        AdapterFactory $imageFactory,
        Filesystem $filesystem,
        LoggerInterface $logger,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->_storeManager = $storeManager;
        $this->_imageFactory = $imageFactory;
        $this->_filesystem = $filesystem;
        $this->_directory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_logger = $logger;
        $this->_scopeConfig = $scopeConfig;
    }

    public function resize($srcImage, $w, $h = null)
    {
        $store = $this->_storeManager->getStore();
        $mediaBaseUrl = $store->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        );
        try {
            if (empty($h)) $h = $w;
            if (is_string($srcImage)) {
                $mediaDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $image = $mediaDir->getAbsolutePath('catalog/category/') . basename($srcImage);
                if ($this->_directory->isFile($image)) {
                    $targetDir = $mediaDir->getAbsolutePath('catalog/category/menu/' . $w . 'x' . $h);
                    if (!$this->_directory->isExist($targetDir)) {
                        $this->_directory->create($targetDir);
                    }
                    $destination = $targetDir . '/' . $srcImage;
                    $relativeDestination = $this->_directory->getRelativePath($destination);
                    if ($this->_directory->isFile($this->_directory->getRelativePath($destination))) {
                        return $mediaBaseUrl . $relativeDestination;
                    }
                    $resize = $this->_imageFactory->create();
                    $resize->open($image);
                    $resize->keepAspectRatio(true);
                    $resize->resize($w, $h);
                    $resize->save($destination);
                    if ($this->_directory->isFile($this->_directory->getRelativePath($destination))) {
                        return $mediaBaseUrl . $relativeDestination;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->_logger->critical($e);
        }
        $fallbackImage = $this->_scopeConfig->getValue('catalog/placeholder/image_placeholder');
        return $mediaBaseUrl . "/catalog/product/placeholder/" . $fallbackImage;

    }
}
