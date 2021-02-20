<?php
/**
 * Copyright (C) 2021
 */

namespace DansMultipro\LearningObject\Controller\Api;

use \Magento\Framework\App\CsrfAwareActionInterface;
use \Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\Request\InvalidRequestException;

class List extends \Magento\Framework\App\Action\Action implements CsrfAwareActionInterface
{
	protected $resultJsonFactory;
    protected $learningOb;
    protected $return;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \DansMultipro\LearningObject\Model\LearningObFactory $learningOb,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->learningOb = $learningOb;
        $this->return = ['status' => false, 'message' => __('Wrong Method or Empty Parameters'), 'data' => []];
    }

    public function execute()
    {
        $loId = $this->getRequest()->getParam('id');

        if ($loId) {
            try {
                $modelFactory = $this->LearningObFactory->create();
		        $_collection = $modelFactory->getCollection()
		            ->addFieldToFilter('id', $loId);
		        $data = $_collection->getFirstItem();

                if ($data) {
                    $this->return['status'] = true;
                    $this->return['message'] = __('Success');
                    $this->return['data'] = $data;
                } else {
                    $this->return['message'] = __('Empty Data');
                }
            } catch (Exception $e) {
                $this->return['message'] = $e->getMessage();
            }
        }

        $result = $this->resultJsonFactory->create();
        $result->setData($this->return);

        return $result;
    }
}