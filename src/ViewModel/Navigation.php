<?php

declare(strict_types=1);

namespace ProXiBlue\MultiMenu\ViewModel;

use Hyva\Theme\ViewModel\Navigation as HyvaNavigation;
use ProxiBlue\MultiMenu\Service\Navigation as NavigationService;

class Navigation extends HyvaNavigation
{

    public function __construct(NavigationService $navigationService)
    {
        parent::__construct($navigationService);
    }

}
