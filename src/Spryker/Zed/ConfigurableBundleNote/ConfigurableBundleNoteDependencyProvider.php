<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleNote;

use Spryker\Zed\ConfigurableBundleNote\Dependency\Facade\ConfigurableBundleNoteToQuoteFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\ConfigurableBundleNote\ConfigurableBundleNoteConfig getConfig()
 */
class ConfigurableBundleNoteDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_QUOTE = 'FACADE_QUOTE';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addQuoteFacade($container);

        return $container;
    }

    protected function addQuoteFacade(Container $container): Container
    {
        $container->set(static::FACADE_QUOTE, function (Container $container) {
            return new ConfigurableBundleNoteToQuoteFacadeBridge($container->getLocator()->quote()->facade());
        });

        return $container;
    }
}
