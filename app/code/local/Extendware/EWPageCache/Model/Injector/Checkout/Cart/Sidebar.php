<?php
class Extendware_EWPageCache_Model_Injector_Checkout_Cart_Sidebar extends Extendware_EWPageCache_Model_Injector_Abstract
{
	public function getInjection(array $params = array(), array $request = array()) {
		$data = null;
		$cache = $this->loadFromCache($this->getCacheKey());
		if ($cache !== false) $data = $cache['data'];
		else {
			$block = Mage::app()->getLayout()->createBlock('checkout/cart_sidebar', $this->getId());
			if (empty($params['template']) === true) {
				$params['template'] = 'checkout/cart/sidebar.phtml';
			}
			$block->setTemplate($params['template']);
			$data = $block->toHtml();
			$this->saveToCache($this->getCacheKey(), $data);
		}
		return $data;
	}
}
