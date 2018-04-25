# Docker Toolbox インストール手順
1. [Docker toolbox](https://docs.docker.com/toolbox/overview/#whats-in-the-box) をダウンロード・実行
2. ダウンロードファイルの実行とインストール開始:Nextをクリック
![](./images/1.png)
3. インストール先の確認:Nextをクリック
![](./images/2.png)
4. インストールコンポーネントの選択:全てチェックがついていることを確認してNextをクリック
![](./images/3.png)
5. 追加設定:全てチェックしていることを確認してNextをクリック
![](./images/4.png)
6. インストール開始:Installをクリック
![](./images/5.png)
7. インストール完了:Finishをクリック
![](./images/6.png)
8. Docker Quick Start Terminalの起動:デスクトップのアイコンをクリック:そこそこ時間かかる  
![](./images/7.png)
9. インストール成功
![](./images/8.png)

## 補足事項
* デスクトップまでのパス(Docker Quick Start Terminal上の表記)
```
/c/Users/ユーザ名/Desktop
```
* IEではローカルにアクセスできないのでChromeなど他のブラウザを使う
* インストールの段階(手順1～5)の段階でチェックが外れているとDockerが動かない
  * その場合は一度ソフトウェアをアンインストールして再インストールする
  * アンインストールの手順
    1. コントロールパネルを開く
    2. プログラム -> プログラムのアンインストール
    3. 以下のプログラムをアンインストール(あるやつ)
      + Docker Toolbox version ～
      + Git version ～
      + Oracle VM VirtualBox ～
