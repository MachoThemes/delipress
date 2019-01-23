<?php
namespace DeliSkypress\Models\Specification;

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

use DeliSkypress\Models\Specification\AbstractSpecification;

/**
 * @version 1.0.0
 * @since 1.0.0
 * 
 * @author DeliPress <thomasdeneulin@gmail.com> 
 */
class AndX extends AbstractSpecification
{

    protected $left;
    protected $right;

    /**
     *
     * @param SpecificationInterface $left
     * @param SpecificationInterface $right
     */
    public function __construct(SpecificationInterface $left, SpecificationInterface $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     *
     * @param $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $this->left->isSatisfedBy($item) && $this->right->isSatisfedBy($item);
    }
}