<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy;

interface QuoteStorageStrategyProviderInterface
{
    /**
     * @return \Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\QuoteStorageStrategyInterface
     */
    public function provideStorageStrategy(): QuoteStorageStrategyInterface;
}
