<?php
namespace Concrete\Package\InfoTownTable;

use Package;
use BlockType;

/**
 * InfoTown Table
 *
 * @category   Interface Elements
 * @package    InfoTown Table
 * @author     Hiroshi Sawai <info@info-town.jp>
 * @copyright  2016 Hiroshi Sawai
 */
class Controller extends Package
{
    protected $pkgHandle = 'infotown_table';
    protected $appVersionRequired = '5.7.5.8';
    protected $pkgVersion = '0.9.0';
    protected $pkgAutoloaderMapCoreExtensions = true;

    public function getPackageDescription()
    {
        return t('Add Bootstrap base table block.');
    }

    public function getPackageName()
    {
        return t('InfoTown Table');
    }

    public function install()
    {
        $pkg = parent::install();
        BlockType::installBlockType('infotown_table', $pkg);
    }
}
