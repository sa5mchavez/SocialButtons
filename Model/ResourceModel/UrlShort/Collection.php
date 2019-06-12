<?php

namespace Pengo\SocialButtons\Model\ResourceModel\UrlShort;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Pengo\SocialButtons\Model\UrlShort',
            'Pengo\SocialButtons\Model\ResourceModel\UrlShort'
        );
    }
}