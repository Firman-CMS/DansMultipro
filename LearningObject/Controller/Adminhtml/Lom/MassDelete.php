<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Controller\Adminhtml\Lom;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_interfacesFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \DansMultipro\LearningObject\Model\LearningObFactory $interfacesFactory
    ) {
        parent::__construct($context);
        $this->_interfacesFactory = $interfacesFactory;
    }
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('id');
        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addError(__('Please select learning object(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $row = $this->_interfacesFactory->create()->load($id);
                    $row->delete();
				}
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}
