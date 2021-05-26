# Hyva Compatible Multi Depth Menu based on category structure

** This module is a WIP, it is not ready for production use **

## Introduction

The default Hyva menu if a flat 1 level category menu. I needed a multiple depth menu for a site build.
This is teh end result.

## Install

You can install via composer:

* first add my public github repository repo manager url to your composer.json

```
{
    "repositories": [
        {"type": "composer", "url": "https://github.repo.repman.io"}
    ]
}
```

* install using ```composer require proxi-blue/multi-menu```

## Setup

In admin, Stores->Configuration->General->MultiMenu you can set the Category Depth.

This will determine how many levels of pullouts are displayed

## Adding additional menu items (that is not categories)

You may want to add top level menu items, like example 'Contact Us'
You can add this by layout xml update in your theme ```default.xml``` layout file. Reference the block name ```topmenu_multimenu_additional```

```
<referenceBlock name="topmenu_multimenu_additional">
   <block name="topmenu_multimenu_additional_contactus" as="topmenu.additional.contactus"
       template="Magento_Theme::html/header/topmenu/additional/contact.phtml" ttl="3600"/>
</referenceBlock>
```

In the above example the contact.phtml file is as such:

```
<?php

use Magento\Framework\View\Element\Template;

/** @var Template $block */
?>

<button
    class="hidden 2xl:flex hover:bg-secondary-darker uppercase border-none bg-transparent
    outline-none focus:outline-none border py-1 rounded-sm flex items-center min-w-32">
        <span class="pr-1 font-normal flex-1">
                <a href="<?= $block->getUrl('contact-us') ?>"
                   title="Contact us"
                   class="block w-full whitespace-nowrap first:mt-0">
            Contact
                </a>
        </span>
</button>
```

## Usage

Well, it's a hover dropdown menu. Simply hover over memnu items, and the child items will be shown. 

![image](https://user-images.githubusercontent.com/4994260/119622514-ce63ea80-be39-11eb-87e6-be8f6efb2455.png)

To note is that the menu will detect the screen width end, and if any slide out items will breach teh screen edge, they will be pulled to the left.

![image](https://user-images.githubusercontent.com/4994260/119622688-f6534e00-be39-11eb-9f7c-d69538733cae.png)

## Credits

The original tailwind css based menu dropdown was based on https://tailwindcomponents.com/component/nestable-dropdown-menu
