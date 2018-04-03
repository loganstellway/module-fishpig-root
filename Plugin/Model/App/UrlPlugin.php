<?php

namespace LoganStellway\FishPigRoot\Plugin\Model\App;

class UrlPlugin
{
    /**
     * Reference the Magento root when generating a WordPress URL
     * @param  \FishPig\WordPress\Model\App\Url $subject
     * @param  callable  $proceed
     * @param  string  $uri
     * @return string
     */
    public function aroundGetUrl(\FishPig\WordPress\Model\App\Url $subject, callable $proceed, string $uri = '')
    {
        return $subject->getMagentoUrl()  . '/' . $uri;
    }
}
