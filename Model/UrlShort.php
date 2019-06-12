<?php

namespace Pengo\SocialButtons\Model;

class UrlShort extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'pengo_url_short';

    protected $_cacheTag = 'pengo_url_short';

    protected $_eventPrefix = 'pengo_url_short';

    protected function _construct()
    {
        $this->_init('Pengo\SocialButtons\Model\ResourceModel\UrlShort');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}