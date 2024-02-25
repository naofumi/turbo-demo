# Messages

`messages-redirect`はHTMLの`dialog`を使ってモーダルを出しているが、ここではBootStrapを使ってモーダルを出す。

ただし、modalの飾り枠的なコードをTurboFrameの外側に出すやり方ではなく、TurboFrameの内側に入れてしまった方法を実装し、その問題点を示す。

悪い例として見ていただきたい

# 動作解説

## モーダルを出す仕組み

1. `data-turbo-frame="edit-modal"`がついているリンクをクリックすると、TurboFrameの内容がダウンロードされる
2. TurboFrameの中にStimulusの`modal` controllerがあり、DOMに挿入された時点で`connect()`が走る。その結果、モーダルが表示される。

## 問題点

1. モーダルを出す
2. モーダルを閉じる
3. `About`のボタンを押す
4. `戻る`ボタンをクリックするか、ブラウザの`バック`ボタンにより、前のページを表示する
5. モーダルがなぜか復活する上、`戻る`ボタンを押した場合はしばらくすると消える。一方で`バック`ボタンの場合はずっとモーダルが残る

### 何が起こっているか `戻る`ボタンの場合

Turboはヌルサク感を出すために、[キャッシンを積極的に行っている](https://turbo.hotwired.dev/handbook/building#understanding-caching)。

1. `戻る`ボタンを押した場合は、Turboの通常の[Application Visit](https://turbo.hotwired.dev/handbook/drive#application-visits)が行われる。その時はまずキャッシュからページが読み込まれる。
2. キャッシュの中には`TurboFrames`の中身、つまりモーダルの中身が残っている。そこでキャッシュからこのページが復活してDOMに差し込まれると、`modal` Stimulus controllerの`connect()`が呼び出され、モーダルが表示されてしまう。
3. TurboのApplication Visitの場合は、キャッシュからページを表示しつつ、裏で同時にページをサーバから取得する。取得されたページは既存のものを差し替える。
4. サーバから取得されたページにはTurboFrameの中身は入っていない。そのため、差し替えの際にモーダルは消える

### 何が起こっているか ブラウザの`back`ボタンの場合

1. `back`ボタンを押した場合は、Turboの通常の[Restoration Visit](https://turbo.hotwired.dev/handbook/drive#restoration-visits)が行われる。その時はキャッシュからページが読み込まれる。サーバに対して新しいページをリクエストしない。
2. キャッシュの中には`TurboFrames`の中身、つまりモーダルの中身が残っている。そこでキャッシュからこのページが復活してDOMに差し込まれると、`modal` Stimulus controllerの`connect()`が呼び出され、モーダルが表示されてしまう。
3. Restoration visitではサーバに新しいリクエストはしていないので、ページは差し替えられることはなく、古いページが表示されたままになる
