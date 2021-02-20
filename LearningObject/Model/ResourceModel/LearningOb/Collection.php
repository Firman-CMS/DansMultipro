<?php
/**
 * 
 */
namespace DansMultipro\LearningObject\Model\ResourceModel\LearningOb;

/**
 * LearningObject Collection
 *
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(\DansMultipro\LearningObject\Model\LearningOb::class, \DansMultipro\LearningObject\Model\ResourceModel\LearningOb::class);
    }
}
