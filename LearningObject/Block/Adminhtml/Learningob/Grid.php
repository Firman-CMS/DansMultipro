<?php
/**
 * Copyright © 2021
 */
namespace DansMultipro\LearningObject\Block\Adminhtml\LearningOb;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_collectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \DansMultipro\LearningObject\Model\ResourceModel\LearningOb\Collection $collectionFactory,
        array $data = []
    ) {
		
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
		
        $this->setId('learningobGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        try{
            $collection =$this->_collectionFactory->load();
            $this->setCollection($collection);
            parent::_prepareCollection();

            return $this;
        }
            catch(Exception $e)
        {
            echo $e->getMessage();die;
        }
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
                'class' => 'title'
            ]
        );
		$this->addColumn(
            'summary',
            [
                'header' => __('Summary'),
                'index' => 'summary',
                'class' => 'summary'
            ]
        );
		$this->addColumn(
            'image',
            [
                'header' => __('Image'),
                'index' => 'image',
                'class' => 'image'
            ]
        );
		$this->addColumn(
            'detail',
            [
                'header' => __('Detail'),
                'index' => 'detail',
                'class' => 'detail'
            ]
        );

        return parent::_prepareColumns();
    }

     /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => __('Delete'),
                'url' => $this->getUrl('learningob/*/massDelete'),
                'confirm' => __('Are you sure?')
            )
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('learningob/*/index', ['_current' => true]);
    }

    /**
     * @param \Magento\Catalog\Model\Product|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'learningob/*/edit',
            ['store' => $this->getRequest()->getParam('store'), 'id' => $row->getId()]
        );
    }
}
