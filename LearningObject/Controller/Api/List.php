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
        $this->return = ['status' => false, 'message' => __('Wrong Method or Empty Result'), 'data' => []];
    }

    public function execute()
    {
        $data = $this->learningOb->create()->getCollection();

        if ($data) {
        	$this->return['status'] = true;
            $this->return['message'] = __('Success');
            $this->return['data'] = $data;
        }
        
        $result = $this->resultJsonFactory->create();
        $result->setData($this->return);

        return $result;
    }
}