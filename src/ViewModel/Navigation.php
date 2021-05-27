<?php

declare(strict_types=1);

namespace ProXiBlue\MultiMenu\ViewModel;

use Hyva\Theme\ViewModel\Navigation as HyvaNavigation;
use ProxiBlue\MultiMenu\Service\Navigation as NavigationService;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Navigation extends HyvaNavigation
{

    protected $scopeConfig;

    const XML_PATH_MULTIMENU = 'proxiblue_multimenu/';

    public function __construct(NavigationService $navigationService, ScopeConfigInterface $scopeInterface)
    {
        parent::__construct($navigationService);
        $this->scopeConfig = $scopeInterface;
    }

    public function getCategoryDepth($storeId = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_MULTIMENU . 'general/depth', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getCanShowIcons($storeId = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_MULTIMENU . 'general/show_icons', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}
