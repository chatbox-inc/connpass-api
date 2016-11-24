# タイトル
グループのイベントを取得するAPIと自動ツイート機能を提供します。

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

## グループID(SERIES_ID)の確認&登録方法

1. connpassのグループページより、「グループを編集する」をクリックしてください。
2. URLの{SERIES_ID}部分がグループのIDです。

```
https://connpass.com/series/{SERIES_ID}/edit/
```

3. Config VariablesにKeyをSERIES_IDに設定しValueにグループIDを設定してください。

## ツイート設定方法

イベントが作成された時やイベント開催の前日に自動的にツイートします。

### TwitterAPIキーの設定
事前にTwitterAPIのキーを取得しといてください。

1. herokuダッシュボードを開く
2. Setting画面へ
3. Config VariablesのRveal Config Varsをクリック
4. 下の値を追加

|Key|Value|
|:-:|:-:|
|TWITTER_ACCESS_TOKEN|TwitterのACCESS_TOKEN|
|TWITTER_ACCESS_TOKEN_SECRET|TwitterのACCESS_TOKEN_SECRET|
|TWITTER_CONSUMER_KEY|TwitterのCONSUMER_KEY|
|TWITTER_CONSUMER_SECRET|TwitterのCONSUMER_SECRET|


### 新しいイベントが作成された時にツイートする
heroku scheduler の設定画面から以下のjobを追加してください。

|DYNO SIZE|COMMAND|FREQUENCY|
|:-:|:-:|:-:|
|free|php artisan newevent|frequencyは任意で選んでください


### 開催日が明日のイベントをツイートする
heroku scheduler の設定画面から以下のjobを追加してください。

|DYNO SIZE|COMMAND|FREQUENCY|
|:-:|:-:|:-:|
|free|php artisan previose|frequencyは任意で選んでください　

### 自動ツイートにハッシュタグをつける
connpassのイベント情報についているハッシュタグとは別にグループのハッシュタグをつけることができます。

Config VariablesのRveal Config Varsに以下の値を設定してください。

|Key|Value|
|:-:|:-:|
|SERIES_HASH_TAG|hogehoge|
※ #はつけないでください。
