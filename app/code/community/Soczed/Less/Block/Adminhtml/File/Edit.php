<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Soczed
 * @package    Soczed_Less
 * @copyright  Copyright (c) 2012 Soczed <magento@soczed.com> (Benoît Leulliette <benoit@soczed.com>)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Soczed_Less_Block_Adminhtml_File_Edit
    extends Mage_Adminhtml_Block_Widget
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('soczed/less/file/edit.phtml');
        $this->setId('less_file_edit');
    }
    
    public function getLessFile()
    {
        return Mage::registry('current_less_file');
    }
    
    public function getLessFileId()
    {
        return $this->getLessFile()->getId();
    }
    
    protected function _prepareLayout()
    {
        $file = $this->getLessFile();
        
        $this->setChild('back_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'   => $this->__('Back'),
                    'onclick' => 'setLocation(\''.$this->getUrl('*/*/').'\')',
                    'class'   => 'back',
                ))
        );
        $this->setChild('save_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'   => $this->__('Save'),
                    'onclick' => 'lessFileForm.submit()',
                    'class'   => 'save',
                ))
        );
        $this->setChild('save_and_edit_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'   => $this->__('Save and Continue Edit'),
                    'onclick' => 'saveAndContinueEdit(\''.$this->getSaveAndContinueUrl().'\')',
                    'class'   => 'save',
                ))
        );
        $this->setChild('delete_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'   => $this->__('Delete'),
                    'onclick' => 'confirmSetLocation(\''.$this->__('Are you sure?').'\', \''.$this->getDeleteUrl().'\')',
                    'class'   => 'delete',
                ))
        );
        
        return parent::_prepareLayout();
    }
    
    protected function _beforeToHtml()
    {
        if ($tabsBlock = $this->getChild('less_file_tabs')) {
            $tabsBlock->setActiveTab($this->getSelectedTabId());
        }
        return parent::_beforeToHtml();
    }
    
    public function getBackButtonHtml()
    {
        return $this->getChildHtml('back_button');
    }
    
    public function getCancelButtonHtml()
    {
        return $this->getChildHtml('reset_button');
    }
    
    public function getSaveButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }
    
    public function getSaveAndEditButtonHtml()
    {
        return $this->getChildHtml('save_and_edit_button');
    }
    
    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('delete_button');
    }
    
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', array('_current' => true, 'back' => null));
    }
    
    public function getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', array(
            '_current'   => true,
            'back'       => 'edit',
            'tab'        => '{{tab_id}}',
            'active_tab' => null,
        ));
    }
    
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array('_current' => true));
    }
    
    public function getHeader()
    {
        return $this->htmlEscape($this->getLessFile()->getPath());
    }
    
    public function getSelectedTabId()
    {
        return addslashes(htmlspecialchars($this->getRequest()->getParam('tab')));
    }
}