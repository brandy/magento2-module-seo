<?php

namespace Staempfli\Seo\Service\HrefLang;

use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Store\Model\Store;

class AlternativeUrlService
{
    /**
     * @var CmsPageUrlRetriever
     */
    private $cmsPageUrlRetriever;
    /**
     * @var HttpRequest
     */
    private $request;
    /**
     * @var CategoryUrlRetriever
     */
    private $categoryUrlRetriever;
    /**
     * @var ProductUrlRetriever
     */
    private $productUrlRetriever;

    public function __construct(
        CmsPageUrlRetriever $cmsPageUrlRetriever,
        CategoryUrlRetriever $categoryUrlRetriever,
        ProductUrlRetriever $productUrlRetriever,
        HttpRequest $request
    ) {
        $this->cmsPageUrlRetriever = $cmsPageUrlRetriever;
        $this->categoryUrlRetriever = $categoryUrlRetriever;
        $this->productUrlRetriever = $productUrlRetriever;
        $this->request = $request;
    }

    /**
     * @param Store $store
     * @return string
     */
    public function getAlternativeUrl($store)
    {
        switch ($this->request->getFullActionName())
        {
            case 'catalog_category_view':
                return $this->categoryUrlRetriever->getUrl($this->request->getParam('id'), $store);
            case 'catalog_product_view':
                return $this->productUrlRetriever->getUrl($this->request->getParam('id'), $store);
            case 'cms_page_view':
                return $this->cmsPageUrlRetriever->getUrl($this->request->getParam('page_id'), $store);
        }
        return '';
    }
}