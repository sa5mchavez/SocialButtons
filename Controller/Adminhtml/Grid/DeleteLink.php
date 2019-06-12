<?php

namespace Pengo\SocialButtons\Controller\Adminhtml\Grid;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class DeleteLink extends Action
{
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Pengo\SocialButtons\Model\UrlShort $urlShort,
        array $data = []
    ) {
        parent::__construct($context);
        $this->urlShort = $urlShort;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */

    public function execute()
    {
        $link = $this->getRequest()->getPostValue("link");
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customLink = $objectManager->create('Pengo\SocialButtons\Model\UrlShort');
        $customLink->load($link);
        $customLink->delete();

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());
        return $redirect;
    }
}