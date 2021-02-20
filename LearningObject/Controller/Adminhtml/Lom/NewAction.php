<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Controller\Adminhtml\Lom;

class NewAction extends \Magento\Backend\App\Action
{
	public function execute()
	{
		$this->_forward('edit');
	}
}
