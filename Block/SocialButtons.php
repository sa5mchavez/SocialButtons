<?php

namespace Pengo\SocialButtons\Block;

class SocialButtons extends \Magento\Framework\View\Element\Template {

	protected $_template = 'buttons.phtml';

	protected $_scopeConfig;
	protected $_registry;
	private $product;
	/**
	 * [__construct description]
	 * @param \Magento\Framework\View\Element\Template\Context                $context                 [description]
	 * @param array                                                           $data                    [description]
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\Registry $registry ,
        \Magento\Catalog\Api\ProductRepositoryInterfaceFactory $productRepositoryFactory,
        \Magento\Catalog\Helper\ImageFactory $imageHelperFactory,
        \Pengo\SocialButtons\Model\UrlShort $urlShort,
        array $data = []
	) {
		parent::__construct($context, $data);
		$this->_scopeConfig = $context->getScopeConfig();
        $this->productRepositoryFactory = $productRepositoryFactory;
        $this->imageHelperFactory = $imageHelperFactory;
        $this->urlShort = $urlShort;
        $this->_registry = $registry;
	}

    /**
     * @return Product
     */
    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->_registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

	public function getProductName()
    {
        return $this->getProduct()->getName();
    }

    public function getProductImage()
    {
        $producto = $this->getProduct();
        $imageUrl = $this->imageHelperFactory->create()
            ->init($producto, 'product_thumbnail_image')->getUrl();
        return $imageUrl;
    }

    public function getUrlShort($newUrl)
    {
        $urlCurrent = $this->urlShort->getCollection();
        $urlCurrent->addFieldToFilter('url',array('eq' => $newUrl));
        $current = $urlCurrent->count();

        if($current == 1 ):

            foreach ($urlCurrent as $item):
                $result = $item->getUrlShort();
            endforeach;
            return $result;

        else:
            /**
             **************************************************************
             **       Convert a long url to a Bitly Shorten Link         **
             **************************************************************
             **/
            $user = $this->getBitlyUser();
            $apikey = $this->getBitlyAppId();
            $link = "http://api.bit.ly/v3/shorten?login=".$user."&apiKey=".$apikey."&uri=".$newUrl."&format=txt";
            $result = file_get_contents($link);

            /** @var $url **/
            $url = $this->urlShort;
            $url->setUrl($newUrl);
            $url->setUrlShort($result);
            $url->save();

            return $result;

        endif;
    }

	public function isLocal()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/local/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

    public function bitlyOn()
    {
        return $this->_scopeConfig->getValue(
            'socialbuttons/bitly/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getBitlyAppId()
    {
        return $this->_scopeConfig->getValue(
            'socialbuttons/bitly/appid',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getBitlyUser()
    {
        return $this->_scopeConfig->getValue(
            'socialbuttons/bitly/user',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

	public function showFacebook()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/facebook/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function showFacebookShare()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/facebook/share',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function getFacebookAppId()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/facebook/appid',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function getFacebookCount()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/facebook/count',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function showTwitter()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/twitter/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function showPinterest()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/pinterest/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function showGPlus()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/google/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

	public function getGPlusCount()
	{
		return $this->_scopeConfig->getValue(
		    'socialbuttons/google/count',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
	}

    public function showWhatsapp()
    {
        return $this->_scopeConfig->getValue(
            'socialbuttons/whatsapp/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function showEmail()
    {
        return $this->_scopeConfig->getValue(
            'socialbuttons/email/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function showCopy()
    {
        return $this->_scopeConfig->getValue(
            'socialbuttons/copy/enable',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
