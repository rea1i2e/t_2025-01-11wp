import 'scroll-hint/css/scroll-hint.css'
import ScrollHint from 'scroll-hint'

// .js-scroll-hint要素の存在チェック
const scrollableElements = document.querySelectorAll('.js-scroll-hint');

// 要素が存在する場合のみ処理を実行
if (scrollableElements.length > 0) {
  // ScrollHintの初期化
  new ScrollHint('.js-scroll-hint', {
    i18n: {
      scrollable: 'スクロールできます'
    },
    remainingTime: 5000, // 5秒で消える
  });

  /* ------------------------------
  スクロールのドラッグ有効化
  ------------------------------ */
  function mousedragscrollable(element) {
    let target;
    element.forEach(e => {
      e.addEventListener('mousedown', function (event) {
        event.preventDefault();
        target = e;
        target.dataset.down = true;
        target.dataset.move = false;
        target.dataset.x = event.clientX;
        target.dataset.y = event.clientY;
        target.dataset.scrollleft = e.scrollLeft;
        target.dataset.scrolltop = e.scrollTop;
      });

      e.addEventListener('click', function (event) {
        if (target.dataset.move === "true") {
          event.preventDefault();
        }
      });
    });

    document.addEventListener('mousemove', function (event) {
      if (target && target.dataset.down === "true") {
        event.preventDefault();
        let move_x = target.dataset.x - event.clientX;
        let move_y = target.dataset.y - event.clientY;
        if (move_x !== 0 || move_y !== 0) {
          target.dataset.move = true;
        } else {
          return;
        }
        target.scrollLeft = parseInt(target.dataset.scrollleft) + move_x;
        target.scrollTop = parseInt(target.dataset.scrolltop) + move_y;
      }
    });

    document.addEventListener('mouseup', function () {
      if (target) {
        target.dataset.down = false;
      }
    });
  }

  mousedragscrollable(scrollableElements);
}
