<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\GraphQlCatalog\Model\Resolver\Products\FindArgument;

use Magento\Framework\GraphQl\Argument\Find\FindArgumentValueFactory;
use Magento\Framework\GraphQl\Argument\ValueParserInterface;

/**
 * Parses a mixed value to a FindArgumentValue
 */
class ValueParser implements ValueParserInterface
{
    /** @var AstConverter */
    private $clauseConverter;

    /** @var FindArgumentValueFactory */
    private $findArgumentValueFactory;

    /**
     * @param AstConverter $clauseConverter
     * @param FindArgumentValueFactory $findArgumentValueFactory
     */
    public function __construct(
        AstConverter $clauseConverter,
        FindArgumentValueFactory $findArgumentValueFactory
    ) {
        $this->clauseConverter = $clauseConverter;
        $this->findArgumentValueFactory = $findArgumentValueFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function parse($value)
    {
        $filters = $this->clauseConverter->getFilterFromAst(\Magento\Catalog\Model\Product::ENTITY, $value);
        return $this->findArgumentValueFactory->create($filters);
    }
}
