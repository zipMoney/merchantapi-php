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
     * Gets allowable values of the enum
     * @return string[]
     */
    private static function getAllowedCurrencyList()
    {
        return array(
            self::CURRENCY_AUD,
            self::CURRENCY_NZD,
            self::CURRENCY_USD,
            self::CURRENCY_GBP,
            self::CURRENCY_ZAR,
            self::CURRENCY_CAD,
        );
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
            $result['message'] = "invalid value for 'currency', must be one of '".implode("','",$allowed_values)."'.";
        }
        return $result;
    }

    public static function getAvailableRegions()
    {
        return array(
            'au' => 'Australia',
            'nz' => 'New Zealand',
            'us' => 'United States',
            'uk' => 'United Kingdom',
            'za' => 'South Africa',
            'ca' => 'Canada',
        );
    }
}
