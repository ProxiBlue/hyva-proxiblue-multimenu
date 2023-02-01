# Hyva Compatible Multi Depth Menu based on category structure

## Introduction

The default Hyva menu is a flat 1 level category menu. I needed a multiple depth menu for a site build.
This is the end result.

## Install

You can install via composer:

Note: use the 1.1.9 branch for Hyva 1.1.9+ (1.3.x release range)

* run: `composer config repositories.github.repo.repman.io composer https://github.repo.repman.io`
* use composer `composer require proxi-blue/multi-menu`
* enable: `./bin/magento module:enable ProxiBlue_MultiMenu`
* run: `./bin/magento setup:upgrade`
* run: `./bin/magento setup:di:compile`


## Configuration

In admin, 

* Stores->Configuration->General->MultiMenu
* you can set the Category Depth. This will determine how many levels of pullouts are displayed
* You can set if the category image should be set as an icon to the left of menu item (note: this will add a large scale load of requests to server for the images on page load)

## Adding additional menu items (that are not categories)

You may want to add top level menu items, like example 'Contact Us'
You can add this by layout xml update in your theme `default.xml` layout file. Reference the block name `topmenu_multimenu_additional`

```xml
<referenceBlock name="topmenu_multimenu_additional">
   <block name="topmenu_multimenu_additional_contactus" as="topmenu.additional.contactus"
       template="Magento_Theme::html/header/topmenu/additional/contact.phtml" ttl="3600"/>
</referenceBlock>
```

In the above example the contact.phtml file is as such:

```php
<?php

use Magento\Framework\View\Element\Template;
use Magento\Framework\Escaper;

/** @var Template $block */
/** @var Escaper $escaper */
?>

<div class="pr-1 hidden 2xl:block">
    <a
        href="<?= $block->getUrl('contact-us') ?>"
        title="Contact us"
        class="flex items-center min-w-32 py-1 uppercase bg-transparent border rounded-sm hover:bg-secondary-darker focus:outline-none"
    >Contact</a>
</div>
```

## Usage

Well, it's a hover dropdown menu. Simply hover over menu items, and the child items will be shown. 

![image](https://user-images.githubusercontent.com/4994260/119622514-ce63ea80-be39-11eb-87e6-be8f6efb2455.png)

To note is that the menu will detect the screen width end, and if any slide out items will breach the screen edge, they will be pulled to the left.

![image](https://user-images.githubusercontent.com/4994260/119622849-24d12900-be3a-11eb-8c28-5b2971edf50f.png)

Mobile view with Category Icons enabled

![image](https://user-images.githubusercontent.com/4994260/119846015-57634a80-bf3c-11eb-809b-42bf56f8395d.png)

## Notes

I am not a master on frontend. Much can likely be improved.

This is not pure alpineJS. There is a portion of vanilla JS involved. SOme can likely be refactored to be more pure Alpine, 
but I am still learning and don't know all the moving parts for alpine, as yet.
As my knowledge progress I plan to refactor parts.

Feel free to contribute with PR's, as I can also learn from this, from you.

I needed this working for a client build, so it is AS IS.

## Credits

The original tailwind css based menu dropdown was based on https://tailwindcomponents.com/component/nestable-dropdown-menu

## Donations

If you use this in a commercial site, I'd appreciate a donation to my Cat Sugar Cube's toy fund ;)

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://paypal.me/proxiblue?locale.x=en_AU)

![image](https://user-images.githubusercontent.com/4994260/119922080-abece100-bfa1-11eb-968e-79af6e94789a.png)

