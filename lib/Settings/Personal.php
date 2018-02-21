<?php
/**
 * CMS Pico - Integration of Pico within your files to create websites.
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Maxence Lange <maxence@artificial-owl.com>
 * @copyright 2017
 * @license GNU AGPL version 3 or any later version
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

namespace OCA\CMSPico\Settings;

use OCA\CMSPico\AppInfo\Application;
use OCA\CMSPico\Compat\Settings;
use OCA\CMSPico\Service\TemplatesService;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IL10N;
use OCP\Settings\ISettings;

class Personal extends Settings implements ISettings {

	/** @var IL10N */
	private $l10n;

	/** @var TemplatesService */
	private $templatesService;

	/**
	 * @param IL10N $l10n
	 * @param TemplatesService $templatesService
	 */
	public function __construct(IL10N $l10n, TemplatesService $templatesService) {
		$this->l10n = $l10n;
		$this->templatesService = $templatesService;
	}

	/**
	 * @return TemplateResponse
	 */
	public function getForm() {
		$data = [
			'templates' => $this->templatesService->getTemplatesList()
		];

		return new TemplateResponse(Application::APP_NAME, 'settings.personal', $data, 'blank');
	}

	/**
	 * @return string the section ID, e.g. 'sharing'
	 */
	public function getSection() {
		return Application::APP_NAME;
	}

	/**
	 * @return int whether the form should be rather on the top or bottom of
	 * the admin section. The forms are arranged in ascending order of the
	 * priority values. It is required to return a value between 0 and 100.
	 *
	 * keep the server setting at the top, right after "server settings"
	 */
	public function getPriority() {
		return 0;
	}

}
