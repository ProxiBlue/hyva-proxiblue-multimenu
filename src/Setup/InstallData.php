<?php

/*
 * (c) Lucas van Staden <sales@proxiblue.com.au>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


namespace ProxiBlue\MultiMenu\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\{InstallDataInterface, ModuleContextInterface, ModuleDataSetupInterface};

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Category::ENTITY, 'menu_css_class');
    }
}
