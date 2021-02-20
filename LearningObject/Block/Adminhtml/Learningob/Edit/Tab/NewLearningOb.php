<?php
/**
 * 
 */
namespace DansMultipro\LearningObject\Block\Adminhtml\Learningob\Edit\Tab;
class NewLearningOb extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = array()
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    public function _prepareLayout()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_coreRegistry->registry('learningob_learningob');
        $title = $id ? __('Edit Learning Object') . ' '. $model->getInterfaceName() : __('New Learning Object');
        $this->pageConfig->getTitle()->set($title);
        return parent::_prepareLayout();
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('learningob_learningob');
        $isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Detail Interface')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

        $fieldset->addField(
            'title',
            'text',
            array(
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true
            )
        );
        $fieldset->addField(
            'summary',
            'text',
            array(
                'name' => 'summary',
                'label' => __('Summary'),
                'title' => __('Summary'),
                'class' => 'required-entry',
                'required' => true,
            )
        );
        $fieldset->addField(
            'image',
            'text',
            array(
                'name' => 'image',
                'label' => __('Gambar'),
                'title' => __('Gambar'),
                'class' => 'required-entry',
                'required' => true,
            )
        );
        $fieldset->addField(
            'detail',
            'text',
            array(
                'name' => 'detail',
                'label' => __('Detail'),
                'title' => __('Detail'),
                'class' => 'required-entry',
                'required' => true,
            )
        );

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        $model = $this->_coreRegistry->registry('interfaces_interfaces');
        if ($model->getId()) {
            return __('Learning Object Info');
        } else {
            return __('New Learning Object');
        }
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        $model = $this->_coreRegistry->registry('interfaces_interfaces');
        if ($model->getId()) {
            return __('Learning Object Info');
        } else {
            return __('New Learning Object');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

}
