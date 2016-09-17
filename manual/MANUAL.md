# Infotown Table manual

* [English version](#en)
* [日本語版](#ja)

## <a name="en">English</a>

### Summary

This program provides an easy way to make a table by intuitive User Interface.  

### Make/Edit/Preview/Output table

In the following example, it makes 2 rows and 3 columns table.

#### (1) Make table schema. 

You input 2 to Row area and input 3 to Col area.

<img src="screenshot-toolbar.png">

You click "Make Table" button, then 2 rows and 3 columns table schema is made.

<img src="screenshot-make-table.png">

#### (2) Input data to cell.

You click "Edit" button, then Edit data dialog is shown.
In the following example, You click first "Edit" button,  
then You input "This is sample" to text area and click "Save Data" button.

<img src="screenshot-entry-dialog.png">

Cells to which the data has been entered changes to orange color.

<img src="screenshot-first-filled.png">

In the following example, All cell is filled with data.

<img src="screenshot-all-filled.png">

#### (3) Preview Table.

You click "Preview Table" button.

<img src="screenshot-2nd-preview.png">

#### (4) Save data to database.

Just click the "Save Data" button data has not yet been saved to the database .  
When "Save" button that is blue button is clicked, Data will be saved to the database.

#### (5) Edit data.

In the following example, You edit second cell data.  
You click second "Edit" button then edit dialog is shown.

<img src="screenshot-edit-2nd.png">

In the following example, to change the text from "This is sample data2." to "This is edit data2.".

<img src="screenshot-edit-2nd-edit.png">

When You click "Preview Table" button, The changes are reflected.

<img src="screenshot-2nd-preview.png">

You click "Save" button (blue button), then the changes will be saved to the database.

#### (6) Output table.

Suppose you made 2 rows and 3 columns table such as a following.

<img src="screenshot-output-preview.png">

This program will output the table as shown below to the visitors.

<img src="screenshot-output-small.png">

If, for example, you use elemental theme, then it is shown below.

<img src="screenshot-output-big.png">

### Modify schema(Context Menu)

You click "settings" button, then context menu is shown.

<img src="screenshot-context-menu.png">

* Add Row  
  Insert row before of the current row.  
* Del Row  
  Delete current row.  
* Add Col  
  Insert column before of the current column.  
* Del Col  
  Delete current column.  
* TH  
  Convert data type to TH (Table Header).  
* TD  
  Convert data tape to TD (Table Data).  
* Close  
  Close context menu.  

### Data status.

* Data is Filled.  
  <img src="screenshot-data-fill.png">
* Data is empty.  
  <img src="screenshot-data-empty.png">
* Data is TH (Table Header).  
  Label "Edit"  is italic.  
* Data is TD (Table Data).  
  Label "Edit" is not italic.  


## <a name="ja">日本語</a>

### 概要

本プログラムは直感的なインターフェースでテーブルを作成します。  

### テーブル作成/編集/プレビュー

2行3列を例に使い方を説明します。

#### (1) テーブル構成作成

Row入力域へ2、列入力域へ3を入力します。

<img src="screenshot-toolbar.png">

"Make Table"ボタンをクリックすると2行3列のテーブルが作成されます。

<img src="screenshot-make-table.png">

#### (2) データ入力

各"Edit"ボタンをクリックするとデータ入力ダイアログが表示されます。  
例として最初の"Edit"ボタンをクリックし"This is sample"と入力し"Save Data"ボタンをクリックします。

<img src="screenshot-entry-dialog.png">

データが入力済みのセルはオレンジ色で表示されます。

<img src="screenshot-first-filled.png">

下記は全てのセルへデータが入力されている例です。

<img src="screenshot-all-filled.png">

#### (3) テーブルプレビュー

"Preview Table"ボタンをクリックします。

<img src="screenshot-2nd-preview.png">

### (4) データ保存

"Save Data"をクリックしただけではデータはデータベースへ保存されません。  
青色の"Save"ボタンをクリックするとデータがデータベースへ保存されます。

### (5) データ編集

下記例で2番目のセルを編集します。
2番目の"Edit"ボタンをクリックすると編集ダイアログが表示されます。

<img src="screenshot-edit-2nd.png">

下記例はテキストを"This is sample data2."から"This is edit data2."へ変更します。

<img src="screenshot-edit-2nd-edit.png">

"Preview Table"ボタンをクリックすると、変更が反映されいます。

<img src="screenshot-2nd-preview.png">

"Save"ボタン(青色)をクリックすると変更がデータベースへ保存されます。

#### (6) テーブル表示.

下記のような2行3列のテーブルを作成したとします。

<img src="screenshot-output-preview.png">

テーブルは閲覧者へ下記ように表示されます。

<img src="screenshot-output-small.png">

次の図はelementalテーマを選択しているときの例です。

<img src="screenshot-output-big.png">

### テーブル構成変更(メニュー)

行、列の先頭にある"Settings"ボタンをクリックするとメニューが表示されます。

<img src="screenshot-context-menu.png">

* Add Row  
  行を現在の行の前に挿入します。
* Del Row  
  現在の行を削除します。
* Add Col  
  列を現在の列の前に挿入します。
* Del Col  
  列を現在の列の後に挿入します。
* TH  
  TH (Table Header)へ変更します。
* TD  
  TD (Table Data)へ変更します。
* Close  
  コンテキストメニューを閉じます。


### データ種別

* データが入力済みの状態です。  
  <img src="screenshot-data-fill.png">
* データが未入力の状態です。  
  <img src="screenshot-data-empty.png">
* TH (Table Header)は"Edit"ラベルがイタリックになります。
* TD (Table Data)は"Edit"ラベルがノーマルです。
