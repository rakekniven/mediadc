<?php

declare(strict_types=1);

/**
 * @copyright Copyright (c) 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @copyright Copyright (c) 2021-2022 Alexander Piskun <bigcat88@icloud.com>
 *
 * @author 2021-2022 Andrey Borysenko <andrey18106x@gmail.com>
 *
 * @license AGPL-3.0-or-later
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\MediaDC\BackgroundJob;

use OCA\MediaDC\Service\CollectorService;
use OCP\AppFramework\Utility\ITimeFactory;
use OCP\BackgroundJob\TimedJob;


class CollectorCleanupJob extends TimedJob
{

	/** @var CollectorService */
	private $collectorService;

	private const collectorEveryWeekInterval = 24 * 60 * 60 * 7;

	public function __construct(
		ITimeFactory $time,
		CollectorService $collectorService
	) {
		parent::__construct($time);
		$this->collectorService = $collectorService;
		$this->setInterval(self::collectorEveryWeekInterval);
		$this->setTimeSensitivity(\OCP\BackgroundJob\IJob::TIME_INSENSITIVE);
	}

	/**
	 * @param array $argument
	 *
	 * @return void
	 */
	protected function run($argument)
	{
		$this->collectorService->cleanup();
	}
}
