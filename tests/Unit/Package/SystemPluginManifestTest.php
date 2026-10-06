<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */

namespace Tests\Unit\Package;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

/**
 * Verifies the system plugin package metadata and translations.
 *
 * @since 1.0.0
 */
final class SystemPluginManifestTest extends TestCase
{
	private const array CONFIGURATION_LANGUAGE_KEYS = [
		'PLG_SYSTEM_WISHBOXMODULBANK_MERCHANT_ID_LABEL',
		'PLG_SYSTEM_WISHBOXMODULBANK_MERCHANT_ID_DESCRIPTION',
		'PLG_SYSTEM_WISHBOXMODULBANK_TEST_MODE_LABEL',
		'PLG_SYSTEM_WISHBOXMODULBANK_TEST_MODE_DESCRIPTION',
	];

	/**
	 * Ensure package and plugin manifests use the same plugin group.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function testPluginGroupIsSystemEverywhere(): void
	{
		$projectRoot = dirname(__DIR__, 3);
		$pluginManifest = simplexml_load_file(
			$projectRoot . '/plg_system_wishboxmodulbank/wishboxmodulbank.xml'
		);

		self::assertInstanceOf(SimpleXMLElement::class, $pluginManifest);
		self::assertSame('plugin', (string) $pluginManifest['type']);
		self::assertSame('system', (string) $pluginManifest['group']);

		$packageManifest = simplexml_load_file($projectRoot . '/pkg_wishboxmodulbank.xml');

		self::assertInstanceOf(SimpleXMLElement::class, $packageManifest);

		$pluginFile = $packageManifest->xpath(
			'files/file[@type="plugin" and @id="wishboxmodulbank"]'
		);

		self::assertIsArray($pluginFile);
		self::assertCount(1, $pluginFile);
		self::assertSame('system', (string) $pluginFile[0]['group']);
	}

	/**
	 * Ensure configuration field labels and descriptions are translated.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function testConfigurationLanguageKeysExist(): void
	{
		$pluginRoot = dirname(__DIR__, 3) . '/plg_system_wishboxmodulbank';

		foreach (['en-GB', 'ru-RU'] as $locale)
		{
			$translations = parse_ini_file(
				$pluginRoot . '/language/' . $locale . '/plg_system_wishboxmodulbank.ini'
			);

			self::assertIsArray($translations);

			foreach (self::CONFIGURATION_LANGUAGE_KEYS as $languageKey)
			{
				self::assertArrayHasKey($languageKey, $translations);
				self::assertNotSame('', $translations[$languageKey]);
			}
		}
	}
}
