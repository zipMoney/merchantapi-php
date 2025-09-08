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

    public static function isValidCurrency($currency)
    {
        $result = array(
            'valid' => true,
            'message' => '',
        );
        $allowed_values = self::getAllowedCurrencyList();
        if (!in_array($currency, $allowed_values)) {
            $result['valid'] = false;
            $result['message'] = "invalid value for 'currency', must be one of '" . implode("','", $allowed_values) . "'.";
        }
        return $result;
    }

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    private static function getAllowedCurrencyList()
    {
        return array(
            self::CURRENCY_AUD,
            self::CURRENCY_NZD,
            self::CURRENCY_USD,
        );
    }
}
