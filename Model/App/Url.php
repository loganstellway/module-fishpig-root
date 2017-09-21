<?php

namespace LoganStellway\FishPigRoot\Model\App;

/**
 * Url Builder
 */
class Url extends \FishPig\WordPress\Model\App\Url
{
    /**
     * Get Url Alias
     * 
     * @param  \Magento\Framework\App\RequestInterface $request
     * @return mixed
     */
    public function getUrlAlias(\Magento\Framework\App\RequestInterface $request)
    {
        $pathInfo = $this->getPathInfo($request);
        $blogRoute = $this->getBlogRoute();

        if ($blogRoute && strpos($pathInfo, $blogRoute) !== 0) {
            $pathInfo = $blogRoute . '/' . $pathInfo;
        }

        if (trim(substr($pathInfo, strlen($blogRoute)), '/') === '') {
            return $pathInfo;
        }       
        
        $pathInfo = explode('/', $pathInfo);
        
        // Clean off pager and feed parts
        if (($key = array_search('page', $pathInfo)) !== false) {
            if (isset($pathInfo[($key+1)]) && preg_match("/[0-9]{1,}/", $pathInfo[($key+1)])) {
                $request->setParam('page', $pathInfo[($key+1)]);
                unset($pathInfo[($key+1)]);
                unset($pathInfo[$key]);
                
                $pathInfo = array_values($pathInfo);
            }
        }

        // Remove comments pager variable
        foreach($pathInfo as $i => $part) {
            $results = array();
            if (preg_match("/" . sprintf('^comment-page-%s$', '([0-9]{1,})') . "/", $part, $results)) {
                if (isset($results[1])) {
                    unset($pathInfo[$i]);
                }
            }
        }
        
        if (count($pathInfo) == 1 && preg_match("/^[0-9]{1,8}$/", $pathInfo[0])) {
            $request->setParam('p', $pathInfo[0]);
            
            array_shift($pathInfo);
        }

        $uri = urldecode(implode('/', $pathInfo));

        return $uri;
    }
}
