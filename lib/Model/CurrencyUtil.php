<?php
/**
 * CurrencyUtil
 *
 * @category Class
 * @package  zip
 * @author    Zip Plugin Team <integration@zip.co>
 */

namespace zipMoney\Model;

class CurrencyUtil
{
    // allowed currency codes
    const CURRENCY_AUD = 'AUD';
    const CURRENCY_NZD = 'NZD';
    const CURRENCY_GBP = 'GBP';
    const CURRENCY_USD = 'USD';
    const CURRENCY_ZAR = 'ZAR';
    const CURRENCY_CAD = 'CAD';

    /**
     * Gets all available regions
     */
    public static function getAvailableRegions()
    {
        return array(
            'au' => 'Australia',
            'nz' => 'New Zealand',
            'us' => 'United States',
            'uk' => 'United Kingdom',
            'za' => 'South Africa',
            'ca' => 'Canada',
            'mx' => 'Mexico',
            'ae' => 'United Arab Emirates',
            'sg' => 'Singapore',
        );
    }
}
