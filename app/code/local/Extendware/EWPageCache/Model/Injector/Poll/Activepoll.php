<?php
class Extendware_EWPageCache_Model_Injector_Poll_Activepoll extends Extendware_EWPageCache_Model_Injector_Abstract
{
	public function getInjection(array $params = array(), array $request = array()) {
		$data = null;
		$cache = $this->loadFromCache($this->getCacheKey());
		if ($cache !== false) $data = $cache['data'];
		else {
			$block = Mage::app()->getLayout()->createBlock('poll/activePoll', $this->getId());
			$block->setPollTemplate('poll/active.phtml', 'poll');
			$block->setPollTemplate('poll/result.phtml', 'results');
			
			$block->setTemplate($params['template']);
			$data = $block->toHtml();
			$this->saveToCache($this->getCacheKey(), $data);
		}
		return $data;
	}
}
