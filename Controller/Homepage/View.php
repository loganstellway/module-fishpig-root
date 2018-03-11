<?php

namespace LoganStellway\FishPigRoot\Controller\Homepage;

/**
 * Homepage View
 */
class View extends \FishPig\WordPress\Controller\Homepage\View
{
    /*
     * Get the blog breadcrumbs
     *
     * @return array
     */
    protected function _getBreadcrumbs()
    {
        $crumbs = parent::_getBreadcrumbs();
        return $crumbs;
    }

    /*
     * Set the 'wordpress_front_page' handle if this is the front page
     *
     *
     * @return array
     */
    public function getLayoutHandles()
    {
        $handles = ['lsfishpigroot_homepage_view'];

        if (!$this->getApp()->getHomepagePageId()) {
            $handles[] = 'wordpress_front_page';
        }

        return array_merge($handles, parent::getLayoutHandles());
    }
}
