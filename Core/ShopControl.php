<?php
/**
 * @package   ocb_cleartmp
 * @category  OXID Module
 * @version   2.0.0
 * @license   GNU License http://opensource.org/licenses/GNU
 * @author    Joscha Krug <krug@marmalade.de> / OXID Community
 * @link      https://github.com/OXIDprojects/adminsearch
 * @see       https://github.com/OXIDCookbook/ocb_cleartmp
 */

namespace OxidCommunity\OcbClearTmp\Core;

/**
 * Class ShopControl
 *
 * @package OxCom\OcbClearTmp\Core
 */
class ShopControl extends ShopControl_parent
{

    protected function _runOnce()
    {
        $config = \OxidEsales\Eshop\Core\Registry::getConfig();
        $ocbcleartmpDevMode = $config->getShopConfVar('ocbcleartmpDevMode', null, 'module:ocb_cleartmp');

        if ($ocbcleartmpDevMode && !$config->isProductiveMode()) {
            $tmpDirectory = realpath($config->getShopConfVar('sCompileDir'));
            $fles = glob($tmpDirectory . '{/smarty/,/ocb_cache/,/}*{.php,.txt,.json}', GLOB_BRACE);
            if (count($fles) > 0) {
                foreach ($fles as $file) {
                    @unlink($file);
                }
            }
        }
        parent::_runOnce();
    }
}