<?php

namespace DansMultipro\LearningObject\Block\Adminhtml\Interfaces\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('checkmodule_interfaces_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Learning Object Information'));
    }
}