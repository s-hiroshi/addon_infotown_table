<?php

namespace Concrete\Package\InfotownTable\Block\InfotownTable;

use Concrete\Core\Block\BlockController;
use Database;

class Controller extends BlockController
{
    protected $btTable = 'btInfotownTable';
    protected $btExportTables = array(
        'btInfotownTable',
        'btInfotownTableEntries',
    );
    protected $btInterfaceWidth = "600";
    protected $btWrapperClass = 'ccm-ui';
    protected $btInterfaceHeight = "465";
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;

    public function getBlockTypeDescription()
    {
        return t("Infotown Table Block");
    }

    public function getBlockTypeName()
    {
        return t("Infotown Table");
    }

    public function getSearchableContent()
    {
        $content = '';
        $db      = Database::connection();
        $v       = array($this->bID);
        $q       = 'select * from btInfotownTableEntries where bID = ?';
        $r       = $db->query($q, $v);
        foreach ($r as $row) {
            $content .= $row['content'];
        }

        return $content;
    }

    public function add()
    {
        $this->requireAsset('core/file-manager');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('redactor');
    }

    public function edit()
    {
        $this->add();

        $db    = Database::connection();
        $query = $db->fetchAll('SELECT * from btInfotownTableEntries WHERE bID = ?', array($this->bID));
        $this->set('rows', $query);
    }

    public function view()
    {
        $db    = Database::connection();
        $query = $db->fetchAll('SELECT * from btInfotownTableEntries WHERE bID = ?', array($this->bID));
        $this->set('rows', $query);
    }

    public function duplicate($newBID)
    {
        $db = Database::connection();
        $v  = array($this->bID);
        $q  = 'select * from btInfotownTableEntries where bID = ?';
        $r  = $db->query($q, $v);
        foreach ($r as $row) {
            $db->executeQuery(
                'INSERT INTO btInfotownTableEntries (bID, content, th) values(?,?,?)',
                array(
                    $newBID,
                    $row['content'],
                    $row['th'],
                )
            );
        }
    }

    public function delete()
    {
        $db = Database::connection();
        $db->executeQuery('DELETE from btInfotownTableEntries WHERE bID = ?', array($this->bID));
        parent::delete();
    }

    public function save($args)
    {
        $db = Database::connection();
        $db->executeQuery('DELETE from btInfotownTableEntries WHERE bID = ?', array($this->bID));
        $count = $args['rowsLength'] * $args['colsLength'];
        $i     = 0;
        parent::save($args);
        while ($i < $count) {
            $db->executeQuery(
                'INSERT INTO btInfotownTableEntries (bID, content, th) values(?,?,?)',
                array(
                    $this->bID,
                    $args['content'][$i],
                    $args['th'][$i],
                )
            );
            ++$i;
        }
    }
}
