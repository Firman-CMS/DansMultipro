<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Controller\Adminhtml\Lom;

class Save extends \Magento\Backend\App\Action
{
    protected $_interfacesFactory;
    protected $sessionForm;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\Session $sessionForm,
        \DansMultipro\LearningObject\Model\LearningObFactory $interfacesFactory
    ) {
        parent::__construct($context);
        $this->_interfacesFactory = $interfacesFactory;
        $this->sessionForm = $sessionForm;
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
	public function execute()
    {
        $data = $this->getRequest()->getParams();
        if ($data) {
            $model = $this->_interfacesFactory->create();
		
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
			
            $model->setData($data);
			
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
                $this->sessionForm->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving'));
            }

            $this->_redirect('*/*/');
            return;
        }
        $this->_redirect('*/*/');
    }
}
