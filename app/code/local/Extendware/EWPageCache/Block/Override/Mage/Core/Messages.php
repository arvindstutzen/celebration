<?php
class Extendware_EWPageCache_Block_Override_Mage_Core_Messages extends Extendware_EWPageCache_Block_Override_Mage_Core_Messages_Bridge
{
	const EWPAGECACHE_CACHE_KEY = 'core_messages';
	
	protected function _toHtml()
    {
    	$html = parent::_toHtml();
    	
    	$helper = Mage::helper('ewpagecache');
    	return $helper->getBeginMarker(self::EWPAGECACHE_CACHE_KEY, array('template' => $this->getTemplate())) . $html . $helper->getEndMarker(self::EWPAGECACHE_CACHE_KEY);
    }
}
