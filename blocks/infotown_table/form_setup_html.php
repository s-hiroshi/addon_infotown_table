<?php defined('C5_EXECUTE') or die( "Access Denied." );

$fp = FilePermissions::getGlobal();
$tp = new TaskPermission();
?>

<style>
    .it-table {
        padding: 0;
    }
    .it-table-toolbar input[type="number"] {
        width:5em !important;
    }
    .it-table-schema {
        display: block;
        margin: 1.5em 0;
    }

    .it-table-schema span {
        display: inline-block;
        width: 6em;
        margin: 0.25em;
    }

    .it-table-context {
        position: relative;
    }

    .it-table-context-menu {
        background: #eee;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-top: 1px solid #ccc;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 1em;
        left: 2em;
        width: 8em;
        z-index: 10;
    }

    .it-table-context-menu li {
        border-bottom: 1px solid #ccc;
        cursor: pointer;
        list-style-type: none;
        padding: 0.25em 1em;
        text-align: left;
        width: 8em;
    }

    .it-table-schema .it-table-blank {
        background: #fff;
        border: none;
    }

    #it-table-entry-dialog {
        display: none;
    }

    /* helper */
    .it-table-display {
        display: block;
    }

    .it-table-display-none {
        display: none;
    }

    .it-table-th {
        font-weight: bold !important;
    }

    .it-table-td {
        font-weight: normal;
    }

    .it-table-data-fill {
        color: #ff9900 !important;
    }
</style>

<div class="it-table">
    <div class="it-table-toolbar form-inline">
        <label><?php echo t('Row'); ?></label>
        <?php $disabled = (!empty( $rows )) ? ' disabled' : ''; ?>
        <input class="it-table-toolbar-rows form-control" type="number" min="1" max="9999" name="showRowsLength"
               value="<?php echo $rowsLength; ?>"<?php echo $disabled; ?>>
        <input type="hidden" type="text" name="rowsLength" value="<?php echo $rowsLength; ?>">
        <label><?php echo t('Col'); ?></label>
        <input class="it-table-toolbar-cols form-control" type="number" min="1" max="9999" name="showColsLength"
               value="<?php echo $colsLength; ?>"<?php echo $disabled; ?>>
        <input type="hidden" type="text" name="colsLength" value="<?php echo $colsLength; ?>">
        <?php if (empty( $rows )): ?>
            <button class="it-table-toolbar-make btn btn-default"><?php echo t('Make Table'); ?></button>
        <?php endif; ?>
        <button class="it-table-toolbar-preview btn btn-default"><?php echo t('Preview Table'); ?></button>
    </div>
    <!-- .it-table-toolbar -->
    <div class="it-table-schema">
        <?php if (!empty( $rows ) && $rowsLength > 0 && $colsLength > 0) : ?>
            <div class="it-table-add-col-area">
                <?php for ($k = 0; $k < $colsLength; $k++) : ?>
                    <?php if ($k === 0) : ?>
                        <span class="it-table-blank">&nbsp;</span>
                    <?php endif; ?>
                    <span class="it-table-context">
                        <a class="it-table-show-context btn btn-default btn-sm" href="#">
                        <i class="fa fa-cog" aria-hidden="true"></i> <?php echo t('Settings'); ?></a>
                        <ul class="it-table-context-menu it-table-display-none">
                            <li class="it-table-add-col"><i class="fa fa-plus" aria-hidden="true"></i>&emsp;<?php echo t('Add Col'); ?></li>
                                <li class="it-table-rm-col"><i class="fa fa-minus"
                                                               aria-hidden="true"></i>&emsp;<?php echo t(
                                        'Del Col'
                                    ); ?></li>
                                <li class="it-table-convert-col-th"><i class="fa fa-arrow-right"
                                                                       aria-hidden="true"></i>&emsp;<?php echo t(
                                        'TH'
                                    ); ?></li>
                                <li class="it-table-convert-col-td"><i class="fa fa-arrow-right"
                                                                       aria-hidden="true"></i>&emsp;<?php echo t(
                                        'TD'
                                    ); ?></li>
                                <li class="it-table-close-context"><i class="fa fa-times"
                                                                      aria-hidden="true"></i>&emsp;<?php echo t(
                                        'Close'
                                    ); ?></li>
                        </ul>
                    </span>
                <?php endfor; ?>
            </div>
            <!-- .it-table-add-col-area -->
            <?php for ($i = 0; $i < $rowsLength; $i++) : ?>
                <div class="it-table-row">
                    <?php for ($j = 0; $j < $colsLength; $j++) : ?>
                        <?php if ($j === 0): ?>
                            <span class="it-table-context">
                                        <a class="it-table-show-context btn btn-default btn-sm" href="#"><i
                                                class="fa fa-cog" aria-hidden="true"></i> <?php echo t('Settings'); ?></a>
                                        <ul class="it-table-context-menu it-table-display-none">
                                            <li class="it-table-add-row"><i class="fa fa-plus"
                                                                            aria-hidden="true"></i>&emsp;<?php echo t(
                                                    'Add Row'
                                                ); ?></li>
                                            <li class="it-table-rm-row"><i class="fa fa-minus"
                                                                           aria-hidden="true"></i>&emsp;<?php echo t(
                                                    'Del Row'
                                                ); ?></li>
                                            <li class="it-table-convert-row-th"><i class="fa fa-arrow-right"
                                                                                   aria-hidden="true"></i>&emsp;<?php echo t(
                                                    'TH'
                                                ); ?></li>
                                            <li class="it-table-convert-row-td"><i class="fa fa-arrow-right"
                                                                                   aria-hidden="true"></i>&emsp;<?php echo t(
                                                    'TD'
                                                ); ?></li>
                                            <li class="it-table-close-context"><i class="fa fa-times"
                                                                                  aria-hidden="true"></i>&emsp;<?php echo t(
                                                    'Close'
                                                ); ?></li>
                                        </ul>
                                    </span>
                        <?php endif; ?>
                        <?php
                        if ($rows[$i * $colsLength + $j]['content'] === '' ) {
                            $filledClass = '';
                           $editIcon = 'fa-pencil-square-o';
                        } else {
                            $filledClass = ' it-table-data-fill';
                           $editIcon = 'fa-pencil-square'; 
                        }
                        $dataType = ( (string) $rows[$i * $colsLength + $j]['th'] === 'true' ) ? 'it-table-th' : 'it-table-td';
                        ?>
                        <span class="btn btn-default it-table-entry <?php echo $dataType . $filledClass; ?>">
                                <?php echo t('Edit'); ?> <i class="fa <?php echo $editIcon; ?>" aria-hidden="true"></i>
                                <input type="hidden" name="content[]"
                                       value="<?php echo $rows[$i * $colsLength + $j]['content'] ?>">
                                      <input type="hidden" name="th[]"
                                             value="<?php echo $rows[$i * $colsLength + $j]['th'] ?>">
                            </span>
                    <?php endfor; ?>
                </div>
                <!-- .it-table-row -->
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <!-- .it-table-schema -->
</div>
<!-- .it-table -->
<script>
    (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){"use strict";Object.defineProperty(exports,"__esModule",{value:true});exports.default=function(){var current=void 0;function save(){var data=$("#it-table-editor-content").val();var content=$(current).children('input[name="content[]"]');if(data!==""){content.parent().removeClass("it-table-data-empty");content.parent().addClass("it-table-data-fill");$("i",content.parent()).removeClass("fa-pencil-square-o");$("i",content.parent()).addClass("fa-pencil-square")}if(data===""){content.parent().removeClass("it-table-data-fill");content.parent().addClass("it-table-data-empty");$("i",content.parent()).removeClass("fa-pencil-square");$("i",content.parent()).addClass("fa-pencil-square-o")}content.val(data);$("#it-table-entry-dialog").dialog("destroy");return false}function edit(){current=this;var content=$('input[name="content[]"]',this);$("#it-table-editor-content").val(content.val());$("#it-table-entry-dialog").dialog();return false}return{edit:edit,save:save}}()},{}],2:[function(require,module,exports){"use strict";Object.defineProperty(exports,"__esModule",{value:true});exports.default=function(){function preview(params){var data=params.data;var th=params.th;var rowsLength=params.rowsLength;var colsLength=params.colsLength;var previewTable=$('<table class="preview-table table">');for(var i=0;i<rowsLength;i++){var row=$("<tr>").appendTo(previewTable);for(var j=0;j<colsLength;j++){if(th[i*colsLength+j]==="true"){$("<th>"+filterBr(data[i*colsLength+j])+"</th>").appendTo(row)}else{$("<td>"+filterBr(data[i*colsLength+j])+"</td>").appendTo(row)}}}return previewTable}function filterBr(data){return data.replace(/\n/g,"<br>")}return{preview:preview}}()},{}],3:[function(require,module,exports){"use strict";Object.defineProperty(exports,"__esModule",{value:true});exports.default=function(){var contextColMenu='<span class="it-table-context">\n                    <a class="it-table-show-context btn btn-default btn-sm" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>\n                    <ul class="it-table-context-menu it-table-display-none">\n                        <li class="it-table-add-col"><i class="fa fa-plus" aria-hidden="true"></i>&emsp;Add Col</li>\n                        <li class="it-table-rm-col"><i class="fa fa-minus" aria-hidden="true"></i>&emsp;Del Col</li>\n                        <li class="it-table-convert-col-th"><i class="fa fa-arrow-right" aria-hidden="true"></i>&emsp;TH</li>\n                        <li class="it-table-convert-col-td"><i class="fa fa-arrow-right" aria-hidden="true"></i>&emsp;TD</li>\n                        <li class="it-table-close-context"><i class="fa fa-times" aria-hidden="true"></i>&emsp;Close</li>\n                    </ul>\n                    </span>';var contextRowMenu='<span class="it-table-context">\n                    <a class="it-table-show-context btn btn-default btn-sm" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>\n                    <ul class="it-table-context-menu it-table-display-none">\n                        <li class="it-table-add-row"><i class="fa fa-plus" aria-hidden="true"></i>&emsp;Add Row</li>\n                        <li class="it-table-rm-row"><i class="fa fa-minus" aria-hidden="true"></i>&emsp;Del Row</li>\n                        <li class="it-table-convert-row-th"><i class="fa fa-arrow-right" aria-hidden="true"></i>&emsp;TH</li>\n                        <li class="it-table-convert-row-td"><i class="fa fa-arrow-right" aria-hidden="true"></i>&emsp;TD</li>\n                        <li class="it-table-close-context"><i class="fa fa-times" aria-hidden="true"></i>&emsp;Close</li>\n                    </ul>\n                    </span>';function makeSchema(params){var schema=params.schema;var rowsLength=params.rowsLength;var colsLength=params.colsLength;var head=$('<div class="it-table-add-col-area">');for(var k=0;k<colsLength;k++){if(k===0){$('<span class="it-table-blank">&nbsp;</span>').appendTo(head)}$(contextColMenu).appendTo(head)}head.appendTo(schema);for(var i=0;i<rowsLength;i++){var row=$('<div class="it-table-row">').appendTo(schema);for(var j=0;j<colsLength;j++){if(j===0){$(contextRowMenu).appendTo(row)}var entryMarkup='<span class="btn btn-default it-table-entry">\n                                          Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i>\n                                          <input type="hidden" name="content[]">\n                                          <input type="hidden" name="th[]">\n                                      </span>';$(entryMarkup).appendTo(row)}}$('input[name="showRowsLength"]').prop("disabled",true);$('input[name="showColsLength"]').prop("disabled",true);setHandler(schema);return schema}function setHandler(schema){setRowHandler(schema);setColHandler(schema)}function setRowHandler(schema){$(".it-table-add-row",schema).click(addRow);$(".it-table-rm-row",schema).click(removeRow);$(".it-table-convert-row-th",schema).click(convertRowToTh);$(".it-table-convert-row-td",schema).click(convertRowToTd)}function setColHandler(schema){$(".it-table-add-col",schema).click(addCol(schema));$(".it-table-rm-col",schema).click(removeCol(schema));$(".it-table-convert-col-th",schema).click(convertColToTh(schema));$(".it-table-convert-col-td",schema).click(convertColToTd(schema))}function showContext(){var context=$(this).next();context.removeClass("it-table-display-none");context.addClass("it-table-display");return false}function closeContext(){var context=$(this).parents(".it-table-context-menu");context.remove("it-table-display");context.addClass("it-table-display-none");return false}function addRow(){var row=$(this).parents(".it-table-row");var menu=$(".it-table-context-menu",row);menu.removeClass("it-table-display");menu.addClass("it-table-display-none");var addedRow=row.clone(true);var addedInput=$('input[name="content[]"]',addedRow);addedInput.val("");addedInput.parent().removeClass("it-table-th");addedInput.parent().addClass("it-table-td");addedInput.parent().removeClass("it-table-data-fill");$("i",addedInput.parent()).removeClass("fa-pencil-square");$("i",addedInput.parent()).addClass("fa-pencil-square-o");$('input[name="th[]"]',addedRow).val("false");row.before(addedRow);incRowsLength();return false}function removeRow(){if($(".it-table-row").length<2){return false}var row=$(this).parents(".it-table-row");row.remove();decRowsLength();return false}function convertRowToTh(){var row=$(this).parents(".it-table-row");var data=$('input[name="th[]"]',row);var menu=$(".it-table-context-menu",row);data.each(function(){$(this).val("true");$(this).parent().removeClass("it-table-td");$(this).parent().addClass("it-table-th")});menu.removeClass("it-table-display");menu.addClass("it-table-display-none");return false}function convertRowToTd(){var row=$(this).parents(".it-table-row");var data=$('input[name="th[]"]',row);var menu=$(".it-table-context-menu",row);data.each(function(){$(this).val("false");$(this).parent().removeClass("it-table-th");$(this).parent().addClass("it-table-td")});menu.removeClass("it-table-display");menu.addClass("it-table-display-none");return false}function addCol(schema){return function(){var rowsLength=$("div",schema).length;var colsLength=$("div:first-child span",schema).length;var index=getIndex($(this).parents(".it-table-context"),".it-table-add-col-area span");for(var i=0;i<rowsLength;i++){var row=schema.children().eq(i);for(var j=0;j<colsLength;j++){if(j===index){if(i===0){$(".it-table-context-menu",row).removeClass("it-table-display");$(".it-table-context-menu",row).addClass("it-table-display-none")}var col=row.children().eq(j);var addedCol=col.clone(true);$('input[name="content[]"]',addedCol).val("");$('input[name="th[]"]',addedCol).val("false");if(j>0){$("i",addedCol).removeClass("fa fa-pencil-square");$("i",addedCol).addClass("fa fa-pencil-square-o")}addedCol.removeClass("it-table-th");addedCol.addClass("it-table-td");addedCol.removeClass("it-table-data-fill");col.before(addedCol)}}}incColsLength();return false}}function removeCol(schema){return function(){var rowsLength=$("div",schema).length;var colsLength=$("div:first-child span",schema).length;if(colsLength<=2){return false}var index=getIndex($(this).parents(".it-table-context"),".it-table-add-col-area span");for(var i=0;i<rowsLength;i++){var row=schema.children().eq(i);for(var j=0;j<colsLength;j++){if(j===index){var col=row.children().eq(j);col.remove()}}}decColsLength();return false}}function convertColToTh(schema){return function(){var rowsLength=$("div",schema).length;var colsLength=$("div:first-child span",schema).length;var index=getIndex($(this).parents(".it-table-context"),".it-table-add-col-area span");for(var i=0;i<rowsLength;i++){var row=schema.children().eq(i);for(var j=0;j<colsLength;j++){if(j===index){if(i===0){$(".it-table-context-menu",row).removeClass("it-table-display");$(".it-table-context-menu",row).addClass("it-table-display-none")}var col=row.children().eq(j);var input=$('input[name="th[]"]',col);input.val("true");input.parent().removeClass("it-table-td");input.parent().addClass("it-table-th")}}}return false}}function convertColToTd(schema){return function(){var rowsLength=$("div",schema).length;var colsLength=$("div:first-child span",schema).length;var index=getIndex($(this).parents(".it-table-context"),".it-table-add-col-area span");for(var i=0;i<rowsLength;i++){var row=schema.children().eq(i);for(var j=0;j<colsLength;j++){if(j===index){if(i===0){$(".it-table-context-menu",row).removeClass("it-table-display");$(".it-table-context-menu",row).addClass("it-table-display-none")}var col=row.children().eq(j);var input=$('input[name="th[]"]',col);input.val("false");input.parent().removeClass("it-table-th");input.parent().addClass("it-table-td")}}}return false}}function incRowsLength(){var rowsLength=$('input[name="rowsLength"]');var showRowsLength=$('input[name="showRowsLength"]');rowsLength.val(parseInt(rowsLength.val(),10)+1);showRowsLength.prop("disabled",false);showRowsLength.val(parseInt(rowsLength.val(),10));showRowsLength.prop("disabled",true)}function decRowsLength(){var rowsLength=$('input[name="rowsLength"]');var showRowsLength=$('input[name="showRowsLength"]');rowsLength.val(parseInt(rowsLength.val(),10)-1);showRowsLength.prop("disabled",false);showRowsLength.val(parseInt(rowsLength.val(),10));showRowsLength.prop("disabled",true)}function incColsLength(){var colsLength=$('input[name="colsLength"]');var showColsLength=$('input[name="showColsLength"]');colsLength.val(parseInt(colsLength.val(),10)+1);showColsLength.prop("disabled",false);showColsLength.val(parseInt(colsLength.val(),10));showColsLength.prop("disabled",true)}function decColsLength(){var colsLength=$('input[name="colsLength"]');var showColsLength=$('input[name="showColsLength"]');colsLength.val(parseInt(colsLength.val(),10)-1);showColsLength.prop("disabled",false);showColsLength.val(parseInt(colsLength.val(),10));showColsLength.prop("disabled",true)}function getIndex(target,selector){return $(selector).index(target)}return{makeSchema:makeSchema,showContext:showContext,closeContext:closeContext,setHandler:setHandler}}()},{}],4:[function(require,module,exports){"use strict";var _TableSchema=require("./TableSchema.js");var _TableSchema2=_interopRequireDefault(_TableSchema);var _TableEntry=require("./TableEntry.js");var _TableEntry2=_interopRequireDefault(_TableEntry);var _TablePreview=require("./TablePreview.js");var _TablePreview2=_interopRequireDefault(_TablePreview);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{default:obj}}var table=$(".it-table");var schema=$(".it-table-schema");var rows=$(".it-table-toolbar-rows");var cols=$(".it-table-toolbar-cols");var btnMaker=$(".it-table-toolbar-make");var btnPreview=$(".it-table-toolbar-preview");if($("#it-table-entry-dialog").length<1){var editor='<div id="it-table-entry-dialog" title="Edit data.">\n                    <div class="form-group">\n                            <textarea id="it-table-editor-content" class="form-control"></textarea>\n                        </div>\n                        <div>\n                            <button class="btn btn-default btn-block it-table-entry-save">Save Data</button>\n                        </div>\n                    </div>\n                    <!-- #it-table-entry-dialog -->';$(editor).appendTo(table)}rows.on("change",function(){$('input[name="rowsLength"]').val(parseInt($(this).val(),10))});cols.on("change",function(){$('input[name="colsLength"]').val(parseInt($(this).val(),10))});btnMaker.on("click",function(){$(".it-table-schema").empty();_TableSchema2.default.makeSchema({schema:schema,rowsLength:parseInt($('input[name="rowsLength"]').val(),10),colsLength:parseInt($('input[name="colsLength"]').val(),10)});$(this).prop("disabled",true);return false});btnPreview.on("click",function(){var data=[];var th=[];var thData=$('input[name="th[]"]');var entryData=$('input[name="content[]"]');entryData.each(function(i){data[i]=$(this).val()});thData.each(function(i){th[i]=$(this).val()});var preview=$(".preview-table");if(preview.children().length>0){preview.remove()}var previewTable=_TablePreview2.default.preview({data:data,th:th,rowsLength:parseInt(rows.val(),10),colsLength:parseInt(cols.val(),10)});previewTable.appendTo(table);return false});$(document).on("click",".it-table-show-context",_TableSchema2.default.showContext);$(document).on("click",".it-table-close-context",_TableSchema2.default.closeContext);$(document).on("click",".it-table-entry",_TableEntry2.default.edit);$(document).on("click",".it-table-entry-save",_TableEntry2.default.save);if(schema.children().length>0){$(_TableSchema2.default.setHandler(schema))}},{"./TableEntry.js":1,"./TablePreview.js":2,"./TableSchema.js":3}]},{},[4]);
</script>
