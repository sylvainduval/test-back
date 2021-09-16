<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

trait SharedContextTrait
{
	/** @var SharingContext */
	private $sharingContext;

	/**
	 * @BeforeScenario
	 * @param BeforeScenarioScope $scope
	 */
	public function gatherSharingContext(BeforeScenarioScope $scope): void
	{
		/** @var InitializedContextEnvironment $environment */
		$environment = $scope->getEnvironment();
		$this->sharingContext = $environment->getContext(SharingContext::class);
	}
}
