# FishPig Root

Magento 2 module that extends [FishPig WordPress integration](https://github.com/bentideswell/magento2-wordpress-integration/) module to support the ability to serve pages & posts from the Magento root

## Installation

Configure repository
```
composer config repositories.fishpigroot https://github.com/loganstellway/module-fishpig-root.git
```

Install module with [Composer](https://getcomposer.org/):
```
composer require loganstellway/module-fishpig-root
```

Enable Module:
```
php bin/magento module:enable LoganStellway_FishPigRoot
```

Upgrade / compile Magento:
```
php bin/magento setup:upgrade && php bin/magento setup:di:compile
```

## More Resources

  - Notes for [Wordpress Installation using Bedrock](https://github.com/bentideswell/magento2-wordpress-integration/) 
  - [Installation Guide](https://github.com/bentideswell/magento2-wordpress-integration/) for the FishPig Wordpress integration module

## Issues

Please feel free to add issues and contribute to the project. 
