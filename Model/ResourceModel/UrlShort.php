<?php

namespace Pengo\SocialButtons\Model\ResourceModel;

class UrlShort extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('pengo_url_short', 'url_id');
    }
}