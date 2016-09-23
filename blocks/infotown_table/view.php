<?php defined('C5_EXECUTE') or die( "Access Denied." ); ?>
<?php if (count($rows) > 0 && $rowsLength > 0 && $colsLength > 0) : ?>
    <table>
        <?php for ($i = 0; $i < $rowsLength; $i++) : ?>
            <tr>
                <?php for ($j = 0; $j < $colsLength; $j++) : ?>
                    <?php if ((string) $rows[$i * $colsLength + $j]['th'] === 'true') : ?>
                        <th><?php echo h($rows[$i * $colsLength + $j]['content']); ?></th>
                    <?php else : ?>
                        <td><?php echo h($rows[$i * $colsLength + $j]['content']); ?></td>
                    <?php endif; ?>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
<?php endif; ?>
