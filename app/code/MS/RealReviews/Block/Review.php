<?php
	
namespace MS\RealReviews\Block;

/**
 * Entity rating block
 *
 */
 
class Review extends \Magento\Review\Block\Product\View\ListView
{

	protected $customer_id;
	protected $producttype;
	protected $product_ids = array();
	protected $orders;
	protected $_productloader;  
	protected $_orderCollectionFactory;
	
	public function __construct(    
	    \Magento\Catalog\Block\Product\Context $context,
	    \Magento\Framework\Url\EncoderInterface $urlEncoder,
	    \Magento\Framework\Json\EncoderInterface $jsonEncoder,
	    \Magento\Framework\Stdlib\StringUtils $string,
	    \Magento\Catalog\Helper\Product $productHelper,
	    \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
	    \Magento\Framework\Locale\FormatInterface $localeFormat,
	    \Magento\Customer\Model\Session $customerSession,
	    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
	    \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
	    \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory,
	    \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
	    array $data = []
	) {
	    $this->_orderCollectionFactory = $orderCollectionFactory;
	    parent::__construct(
	         $context, 
	         $urlEncoder,
	         $jsonEncoder,
	         $string,
	         $productHelper,
	         $productTypeConfig,
	         $localeFormat,
	         $customerSession,
	         $productRepository,
	         $priceCurrency,
	         $collectionFactory,
	         $data
	    );
	}
	
	public function getOrders() {

        if (!$this->orders && $this->customer_id):
            $this->orders = $this->_orderCollectionFactory->create()->addAttributeToSelect(
                '*'
            )
/*
            ->addAttributeToFilter(
            	'product_id',
            	 $this->getProductId()
			)
*/
			->addFieldToFilter(
                'customer_id',
                $this->_getCustomerID()
            );
        endif;
        
        return $this->orders;

    }
	
	protected function _setCustomerID($input){
		$this->customer_id = $input;
	}
	
	protected function _getCustomerID(){
		return $this->customer_id;
	}
	
	protected function _setProductIDs($input){
		$this->product_ids[] = $input;
	}
	
	protected function _getProductIDs(){
		return $this->product_ids;
	}

	protected function _setProductType($input){
		$this->producttype = $input;
	}
	
	protected function _getProductType(){
		return $this->producttype;
	}
	
	public function isRealReview($customer_id = false){
		
		$html = '';
		$pid = $this->getProductId();

		if($customer_id):
			$this->_setCustomerID($customer_id);
			//$this->_setProductType($producttype);
			$orders = $this->getOrders();
			if($orders && count($orders)):
				foreach($orders as $_order):
					foreach($_order->getAllVisibleItems() as $item):
						try {
							//$this->_setProductType($item->getProductType());
							$this->_setProductIDs($item->getProductId());
							//$html .= $item->getProductId() . " - " . $item->getProductType() . "<br />";
						} catch(Exception $e) {
							Mage::throwException('ERROR:' . $e);
						}
	
					endforeach;
				endforeach;
			endif;
			
			
			if (in_array($pid, $this->_getProductIDs())) {
			    return (bool)true;
			} else {
				return (bool)false;
			}
		endif;
		
		return (bool)false;
	}
	
}