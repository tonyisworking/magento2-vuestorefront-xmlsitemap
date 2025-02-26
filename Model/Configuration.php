<?php
declare(strict_types=1);

/**
 * @author tjitse (Vendic)
 * Created on 23/03/2019 10:33
 */

namespace Vendic\VueStorefrontSitemap\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;

class Configuration
{
    const VUE_STOREFRONT_URL_CONFIG_PATH = 'vuestorefront/sitemap/vs_url';
    const VUE_STOREFRONT_SHORT_CATALOG_ENABLED = 'vuestorefront/sitemap/use_catalog_short_urls';
    const VUE_STOREFRONT_CATEGORY_ID_SUFFIX_ENABLED = 'vuestorefront/sitemap/category_id_suffix';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getVueStorefrontUrl(): string
    {
        $url = $this->scopeConfig->getValue(
            self::VUE_STOREFRONT_URL_CONFIG_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        if (!is_string($url)) {
            throw new LocalizedException(
                __('Invalid or no VueStorefront url entered for config path %1', self::VUE_STOREFRONT_URL_CONFIG_PATH)
            );
        }
        return $url;
    }

    public function getShortCatalogUrlsEnabled(): bool
    {
        $setting = $this->scopeConfig->getValue(
            self::VUE_STOREFRONT_SHORT_CATALOG_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return (bool) $setting;
    }

    public function getCategoryIdSuffixEnabled(): bool
    {
        $setting = $this->scopeConfig->getValue(
            self::VUE_STOREFRONT_CATEGORY_ID_SUFFIX_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return (bool) $setting;
    }
}
