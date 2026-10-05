<?php
/**
 * @copyright   (c) 2013-2026 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */

namespace Tests\Unit\Service;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use WishboxModulBankLibrary\Service\PaymentLinkCreationService;

/**
 * Tests payment link service validation and transport failures.
 *
 * @since 1.0.0
 */
final class PaymentLinkCreationServiceTest extends TestCase
{
	/**
	 * Reject non-positive request timeouts.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function testRejectsNonPositiveTimeout(): void
	{
		$this->expectException(InvalidArgumentException::class);

		new PaymentLinkCreationService(0);
	}

	/**
	 * Reject an empty API endpoint.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function testRejectsEmptyEndpoint(): void
	{
		$this->expectException(InvalidArgumentException::class);

		new PaymentLinkCreationService(30, '');
	}

	/**
	 * Convert cURL transport failures into domain-level exceptions.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 *
	 * @noinspection PhpUnused
	 */
	public function testReportsTransportFailure(): void
	{
		$service = new PaymentLinkCreationService(1, 'http://127.0.0.1:1/');

		$this->expectException(RuntimeException::class);
		$this->expectExceptionMessage('The ModulBank request failed');

		$service->create([]);
	}
}
