# ガチャ
転職活動用に書いたものです。

ガチャを引くサンプルスクリプトです。

public/gacha.phpを次のような形で実行してください。

## 例1. CLIで実行する。

```
$ php ./gacha/public/gacha.php --gacha_id=1
```

## 例2. Web上で実行する。

```
$ docker run --rm -v ./gacha:/var/www/html/php:ro php:8.3.1RC3-apache
```

  ./gachaは状況に応じて変更してください。

  その後ブラウザから `http://localhost/public/gacha.php?gacha_id=1` にアクセスする。

----------------------------------------

gacha_id=1をgacha_id=2に変更するとガチャ対象を変更できます。

```plaintext:text.txt
gacha_id=1 ... 初代御三家ガチャ
  ポ●モン赤緑の御三家が出てきます。
  ☆     ... 60%
  ☆☆   ... 30%
  ☆☆☆ ... 10%
```

```
gacha_id=2 ... 二代目御三家ガチャ
  ポ●モン金銀の御三家が出てきます。
  ☆     ... 60%
  ☆☆   ... 30%
  ☆☆☆ ... 10%
``````

----------------------------------------

データは./gacha/Dataディレクトリ下にcsv形式で格納しています。
先頭行が#になっている行はコメント行になります。

* ms_gacha.txt ... ガチャデータ
* ms_gacha_group.txt ... レア度ごとのグループデータ
* ms_gacha_drop.txt ... グループ内での排出カードデータ
* ms_card.txt ... カードの情報

