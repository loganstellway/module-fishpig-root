<?php

namespace LoganStellway\FishPigRoot\Plugin;

/**
 * CMS Index Plugin
 */
class CmsIndexPlugin 
{
    /**
     * @var \LoganStellway\FishPigRoot\Controller\Router
     */
    protected $_router;

    /**
     * @var \FishPig\WordPress\Model\App
     */
    protected $_app;

    /**
     * @var \FishPig\WordPress\Model\Config
     */
    protected $_config;

    /**
     * Dependency Injection
     */
    public function __construct(
        \LoganStellway\FishPigRoot\Controller\Router $router,
        \FishPig\WordPress\Model\App $app
    ) {
        $this->_router = $router;
        $this->_app = $app;
    }

    /**
     * Around Execute
     */
    public function aroundExecute(\Magento\Cms\Controller\Index\Index $subject, callable $proceed)
    {
        if (!$this->_app->getException() && $this->_app->getConfig()->getStoreConfigValue('wordpress/setup/use_wp_home')) {
            if ($route = $this->_router->match($subject->getRequest())) {
                return $route->execute();
            }
        }
        return $proceed();
    }
}
