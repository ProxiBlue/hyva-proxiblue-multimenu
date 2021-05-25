<?php
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
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'menu_css_class', [
            'type' => 'varchar',
            'label' => 'Menu Css Class',
            'input' => 'text',
            'source' => '',
            'visible' => true,
            'default' => '',
            'required' => false,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'Display Settings',
        ]);
    }
}
