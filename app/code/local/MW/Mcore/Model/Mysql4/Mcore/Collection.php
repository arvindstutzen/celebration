<?php

class MW_Mcore_Model_Mysql4_Mcore_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('mcore/mcore');
    }
}