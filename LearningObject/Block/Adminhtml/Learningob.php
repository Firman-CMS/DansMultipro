<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Block\Adminhtml;
class Learningob extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_learningob';
        $this->_blockGroup = 'DansMultipro_LearningObject';
        $this->_headerText = __('Learning Object');
        $this->_addButtonLabel = __('Add New'); 
        parent::_construct();
    }
}
