<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Model\ResourceModel;

/**
 * LearningOb resource
 */
class LearningOb extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('learning_object', 'id');
    }
}
