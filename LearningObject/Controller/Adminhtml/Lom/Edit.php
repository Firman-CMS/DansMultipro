<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Controller\Adminhtml\Lom;

class Edit extends \Magento\Backend\App\Action
{
    protected $_coreRegistry;
    protected $sessionForm;
    protected $_interfacesFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\Session $sessionForm,
        \Magento\Framework\Registry $coreRegistry,
        \DansMultipro\LearningObject\Model\LearningObFactory $interfacesFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->sessionForm = $sessionForm;
        $this->_interfacesFactory = $interfacesFactory;
        parent::__construct($context);
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
	public function execute()
    {
        # Get ID and create model
        $id = $this->getRequest()->getParam('id');
		
        $model = $this->_interfacesFactory->create();
		
        # Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This row no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        # Set entered data if was error when we do save
        $data = $this->sessionForm->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('interfaces_interfaces', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
