<?php
declare(strict_types=1);

/**
 * CurrencyUtil.
 *
 * @category Class
 * @package  zip
 * @author    Zip Plugin Team <integration@zip.co>
 */

namespace zipMoney\Model;

class CurrencyUtil
{
    // allowed currency codes
    public const CURRENCY_AUD = 'AUD';
    public const CURRENCY_NZD = 'NZD';
    public const CURRENCY_GBP = 'GBP';
    public const CURRENCY_USD = 'USD';
    public const CURRENCY_ZAR = 'ZAR';
    public const CURRENCY_CAD = 'CAD';

    /**
     * Gets all available regions.
     */
    public static function getAvailableRegions()
    {
        return [
            'au' => 'Australia',
            'nz' => 'New Zealand',
            'us' => 'United States',
            'uk' => 'United Kingdom',
            'za' => 'South Africa',
            'ca' => 'Canada',
            'mx' => 'Mexico',
            'ae' => 'United Arab Emirates',
            'sg' => 'Singapore',
        ];
    }
}
