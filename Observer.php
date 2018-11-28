<?php
Class webproject_Model_Observer
{
	public function setCustomTemplate($observer){
		$action = $observer->getEvent()->getAction(); 
		if ($action->getFullActionName() == 'catalog_product_view') {
			$layout = $observer->getEvent()->getLayout();
			$root = $layout->getBlock('root');
			if($root){
				$setingsCfg=Mage::helper('webproject/config')->getTpcfg('webproject_settings/product_info');
				$layout=$setingsCfg['product_layout'];
				if($layout!=0){
					$root->setTemplate('page/'.$layout.'.phtml');
				}
			}
		}
		if ($action->getFullActionName() == 'catalog_category_view') {
			$layout = $observer->getEvent()->getLayout();
			$root = $layout->getBlock('root');
			if($root){
				$setingsCfg=Mage::helper('webproject/config')->getTpcfg('webproject_settings/category');
				$layout=$setingsCfg['category_layout'];
				if($layout!=0){
					$root->setTemplate('page/'.$layout.'.phtml');
				}
			}
		}
	}

	public function setTemplateVariables($observer){
		$tmpCfgAr = array();
		$storeId = Mage::app()->getStore()->getId();
		$tmpCfgAr['set'] = Mage::getStoreConfig('webproject_settings',$storeId );
		$tmpCfgAr['deg'] = Mage::getStoreConfig('webproject_design',$storeId );
		if(!Mage::registry('tmpCfg')){
			$tmpCfg = Mage::register('tmpCfg', $tmpCfgAr);
		}
	}
}
