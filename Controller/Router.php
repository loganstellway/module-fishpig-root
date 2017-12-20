<?php

namespace LoganStellway\FishPigRoot\Controller;

/**
 * Dependencies
 */
use Magento\Framework\App\RequestInterface;

/**
 * FishPig Router
 */
class Router extends \FishPig\WordPress\Controller\Router
{
    /**
     * Dependency Injection
     * 
     * @param \Magento\Framework\App\ActionFactory               $actionFactory
     * @param \FishPig\WordPress\Model\App                       $app
     * @param \LoganStellway\FishPigRoot\Model\App\Url           $urlBuilder
     * @param \FishPig\WordPress\Model\ResourceModel\PostFactory $postResourceFactory
     * @param \Magento\Framework\App\Request\Http                $request
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,    
        \FishPig\WordPress\Model\App $app,
        \LoganStellway\FishPigRoot\Model\App\Url $urlBuilder,
        \FishPig\WordPress\Model\ResourceModel\PostFactory $postResourceFactory,
        \Magento\Framework\App\Request\Http $request
    ) {
        parent::__construct($actionFactory, $app, $urlBuilder, $postResourceFactory, $request);
    }

    /**
     * Match Route
     * @param RequestInterface $request
     */
    public function match(RequestInterface $request)
    {
        try {
            if (!$this->_app->canRun()) {
                return false;
            }

            if (!($requestUri = $this->_wpUrlBuilder->getRouterRequestUri($request))) {
                $this->addRouteCallback(array($this, '_getHomepageRoutes'));
            }

            $this->addRouteCallback(array($this, '_getSimpleRoutes'));
            $this->addRouteCallback(array($this, '_getPostRoutes'));
            $this->addRouteCallback(array($this, '_getTaxonomyRoutes'));

            $this->addExtraRoutesToQueue();

            if (($route = $this->_matchRoute($requestUri)) !== false) {
                $request->setModuleName($route['path']['module'])
                    ->setControllerName($route['path']['controller'])
                    ->setActionName($route['path']['action'])
                    ->setAlias(
                        \Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS,
                        $this->_wpUrlBuilder->getUrlAlias($request)
                    );
                
                if (count($route['params']) > 0) {
                    foreach($route['params'] as $key => $value) {
                        $request->setParam($key, $value);
                    }
                }

                return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
            }
        }
        catch (\Exception $e) {}

        return false;
    }

    /**
     * Get home page routes
     * @param  string $uri
     * @return $this
     */
    protected function _getHomepageRoutes($uri = '')
    {
        if ($this->_app->getHomepagePageId() == $this->_app->getBlogPageId()) {
            $this->addRoute('', '*/homepage/view');
        } else {
            $this->addRoute('', 'lsfishpigroot/homepage/view');
        }
        return $this;
    }
}
