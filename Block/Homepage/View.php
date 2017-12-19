<?php

namespace LoganStellway\FishPigRoot\Block\Homepage;

/**
 * Homepage View
 */
class View extends \Magento\Framework\View\Element\Template {
    /**
     * Dependency Injection
     */
    public function __construct(
        \FishPig\WordPress\Model\App $app,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_app = $app;
    }

    /**
     * To HTML
     */
    protected function _toHtml()
    {
        if ($this->_app->getHomepagePageId()) {
            return $this->getLayout()->createBlock(
                'FishPig\WordPress\Block\Post\View',
                'lsfishpigroot.homepage.view'
            )->setPost(
                \Magento\Framework\App\ObjectManager::getInstance()->create('FishPig\WordPress\Model\Post')->load(
                    $this->_app->getHomepagePageId()
                )
            )->toHtml();
        }
        return '';
    }
}
