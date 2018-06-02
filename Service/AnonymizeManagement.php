<?php
/**
 * Copyright © 2018 OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Flurrybox\EnhancedPrivacy\Service;

use Magento\Framework\ObjectManager\TMap;

/**
 * Class AnonymizeManagement
 */
class AnonymizeManagement
{
    /**
     * @var \Magento\Framework\ObjectManager\TMap
     */
    private $processorPool;

    /**
     * @param \Magento\Framework\ObjectManager\TMap $processorPool
     */
    public function __construct(
        TMap $processorPool
    ) {
        $this->processorPool = $processorPool;
    }

    /**
     * Anonymize all data related to a given entity ID
     *
     * @param int $entityId
     * @return bool
     */
    public function execute(int $entityId): bool
    {
        /** @var \Flurrybox\EnhancedPrivacy\Service\Anonymize\ProcessorInterface $processor */
        foreach ($this->processorPool as $processor) {
            if (!$processor->execute($entityId)) {
                return false;
            }
        }

        return true;
    }
}
