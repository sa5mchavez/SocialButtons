<?php


namespace Pengo\SocialButtons\Block\Adminhtml\Grid;

class Links extends \Magento\Backend\Block\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Pengo\SocialButtons\Model\UrlShort $urlShort,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->urlShort = $urlShort;
    }
    public function getLinks(){
        $urlCurrent = $this->urlShort->getCollection();

        return $urlCurrent;
    }
}
