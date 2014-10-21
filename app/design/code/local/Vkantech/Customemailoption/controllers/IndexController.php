<?php
class Vkantech_Customemailoption_IndexController extends Mage_Core_Controller_Front_Action
{
	public function IndexAction(){
	
		$templateId = 'vkantechtest_testmail_template';
		$template = Mage::getModel('core/email_template')->loadDefault($templateId);

		$templateVariables = array();

		$template->setSenderName('Vishal Lakhani');
		$template->setSenderEmail('zaptechvishal@gmail.com');
		$template->setTemplateSubject('Test Mail Script');

		try {
			$template->send('carole@funeralprogram-site.com','Vishal Lakhani',$templateVariables);
			
			echo "Mail Send successfully";
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		exit;	

    }
}