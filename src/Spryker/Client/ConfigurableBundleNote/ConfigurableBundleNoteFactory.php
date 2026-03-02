<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ConfigurableBundleNote;

use Spryker\Client\ConfigurableBundleNote\Dependency\Client\ConfigurableBundleNoteToQuoteClientInterface;
use Spryker\Client\ConfigurableBundleNote\Dependency\Client\ConfigurableBundleNoteToZedRequestClientInterface;
use Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\DatabaseQuoteStorageStrategy;
use Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\QuoteStorageStrategyInterface;
use Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\QuoteStorageStrategyProvider;
use Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\QuoteStorageStrategyProviderInterface;
use Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\SessionQuoteStorageStrategy;
use Spryker\Client\ConfigurableBundleNote\Zed\ConfigurableBundleNoteZedStub;
use Spryker\Client\ConfigurableBundleNote\Zed\ConfigurableBundleNoteZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ConfigurableBundleNoteFactory extends AbstractFactory
{
    public function getQuoteStorageStrategy(): QuoteStorageStrategyInterface
    {
        return $this->createQuoteStorageStrategyProvider()->provideStorageStrategy();
    }

    public function createQuoteStorageStrategyProvider(): QuoteStorageStrategyProviderInterface
    {
        return new QuoteStorageStrategyProvider(
            $this->getQuoteClient(),
            $this->getQuoteStorageStrategies(),
        );
    }

    /**
     * @return array<\Spryker\Client\ConfigurableBundleNote\QuoteStorageStrategy\QuoteStorageStrategyInterface>
     */
    public function getQuoteStorageStrategies(): array
    {
        return [
            $this->createSessionQuoteStorageStrategy(),
            $this->createDatabaseQuoteStorageStrategy(),
        ];
    }

    public function createSessionQuoteStorageStrategy(): QuoteStorageStrategyInterface
    {
        return new SessionQuoteStorageStrategy();
    }

    public function createDatabaseQuoteStorageStrategy(): QuoteStorageStrategyInterface
    {
        return new DatabaseQuoteStorageStrategy($this->createConfigurableBundleNoteZedStub());
    }

    public function createConfigurableBundleNoteZedStub(): ConfigurableBundleNoteZedStubInterface
    {
        return new ConfigurableBundleNoteZedStub($this->getZedRequestClient());
    }

    public function getZedRequestClient(): ConfigurableBundleNoteToZedRequestClientInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleNoteDependencyProvider::CLIENT_ZED_REQUEST);
    }

    public function getQuoteClient(): ConfigurableBundleNoteToQuoteClientInterface
    {
        return $this->getProvidedDependency(ConfigurableBundleNoteDependencyProvider::CLIENT_QUOTE);
    }
}
