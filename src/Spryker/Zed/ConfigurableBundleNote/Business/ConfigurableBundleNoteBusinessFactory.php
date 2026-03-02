<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleNote\Business;

use Spryker\Zed\ConfigurableBundleNote\Business\Collector\ConfigurableBundleNoteSalesOrderItemCollector;
use Spryker\Zed\ConfigurableBundleNote\Business\Collector\ConfigurableBundleNoteSalesOrderItemCollectorInterface;
use Spryker\Zed\ConfigurableBundleNote\Business\Hydrator\CartReorderItemHydrator;
use Spryker\Zed\ConfigurableBundleNote\Business\Hydrator\CartReorderItemHydratorInterface;
use Spryker\Zed\ConfigurableBundleNote\Business\Setter\ConfigurableBundleNoteSetter;
use Spryker\Zed\ConfigurableBundleNote\Business\Setter\ConfigurableBundleNoteSetterInterface;
use Spryker\Zed\ConfigurableBundleNote\ConfigurableBundleNoteDependencyProvider;
use Spryker\Zed\ConfigurableBundleNote\Dependency\Facade\ConfigurableBundleNoteToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\ConfigurableBundleNote\ConfigurableBundleNoteConfig getConfig()
 */
class ConfigurableBundleNoteBusinessFactory extends AbstractBusinessFactory
{
    public function createConfigurableBundleNoteSetter(): ConfigurableBundleNoteSetterInterface
    {
        return new ConfigurableBundleNoteSetter($this->getQuoteFacade());
    }

    public function createCartReorderItemHydrator(): CartReorderItemHydratorInterface
    {
        return new CartReorderItemHydrator();
    }

    public function createConfigurableBundleNoteSalesOrderItemCollector(): ConfigurableBundleNoteSalesOrderItemCollectorInterface
    {
        return new ConfigurableBundleNoteSalesOrderItemCollector();
    }

    public function getQuoteFacade(): ConfigurableBundleNoteToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleNoteDependencyProvider::FACADE_QUOTE);
    }
}
