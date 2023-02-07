# Hyva Compatible Multi Depth Menu based on category structure

NOTE: This is an initial attempt (and ugly) to integrate snowdogmenu manager into this menu.
I spent a total of 3h on it sofar, so it is not production ready, and will likely change a lot.

Only category menu items work. It is all I needed for the client site I am working on.

## Introduction

This is a multiple layer depth menu with Snowdog Menu as the editor.

## Install

You can install via composer:

* run: ```composer config repositories.github.repo.repman.io composer https://github.repo.repman.io```
* use composer ```composer require proxi-blue/multi-menu```
* enable: ```./bin/magento module:enable ProxiBlue_MultiMenu```
* run: ```./bin/magento setup:upgrade```
* run: ```./bin/magento setup:di:compile```


## Setup

* Create a new menu in Admin with the identifier 'main-menu' then add sub menu items
* You can override the identifier via xml


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

