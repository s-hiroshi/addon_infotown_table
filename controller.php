<?php
namespace Concrete\Package\InfotownTable;

use Package;
use BlockType;

/**
 * Infofown Table
 *
 * @category   Interface Elements
 * @package    Infotown Table
 * @author     Hiroshi Sawai <info@info-town.jp>
 * @copyright  2016 Hiroshi Sawai
 */
class Controller extends Package
{
    protected $pkgHandle = 'infotown_table';
    protected $appVersionRequired = '5.7.5.8';
    protected $pkgVersion = '0.9.1';
    protected $pkgAutoloaderMapCoreExtensions = true;

    public function getPackageDescription()
    {
        return t('Add Bootstrap base table block.');
    }

    public function getPackageName()
    {
        return t('Infotown Table');
    }

    public function install()
    {
        $pkg = parent::install();
        BlockType::installBlockType('infotown_table', $pkg);
    }
}
