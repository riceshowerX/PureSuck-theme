<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->footer(); ?>

<!-- 回到顶端 -->
<body>
  <div class="go-top dn" id="go-top">
    <a href="#" class="go icon-up-open" aria-label="返回顶部"></a>
  </div>
</body>

<!-- AOS -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
      duration: 450,
      easing: 'cubic-bezier(0.345, 0.045, 0.345, 1)',
      delay: 0,
    });
  });
</script>

<!-- Highlight -->
<?php
// 获取代码块设置
$codeBlockSettings = Typecho_Widget::widget('Widget_Options')->codeBlockSettings;
?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 确保代码块高亮
    document.querySelectorAll('pre code').forEach((block) => {
      hljs.highlightElement(block);
      
      // 显示行号
      <?php if (is_array($codeBlockSettings) && in_array('ShowLineNumbers', $codeBlockSettings)): ?>
        addLineNumber(block);
      <?php endif; ?>
    });

    // 显示复制按钮
    <?php if (is_array($codeBlockSettings) && in_array('ShowCopyButton', $codeBlockSettings)): ?>
      addCopyButtons();
    <?php endif; ?>
  });

  // 添加行号
  function addLineNumber(codeDom) {
    const codeHtml = codeDom.innerHTML;
    const lines = codeHtml.split("\n").map((line, index) => 
      `<span class="code-block-extension-code-line" data-line-num="${index + 1}">${line}</span>`
    ).join("\n");
    codeDom.innerHTML = lines;
  }

  // 添加复制按钮
  function addCopyButtons() {
    document.querySelectorAll('pre code').forEach((codeBlock) => {
      const pre = codeBlock.parentElement;
      
      // 创建复制按钮
      const button = document.createElement('button');
      button.className = 'copy-button';
      button.innerText = 'Copy';

      // 绑定点击事件
      button.addEventListener('click', () => handleButtonClick(codeBlock, button));

      // 将按钮添加到 <pre> 元素
      pre.appendChild(button);
    });
  }

  // 复制按钮点击事件处理
  async function handleButtonClick(codeBlock, button) {
    const code = codeBlock.textContent;
    const scrollY = window.scrollY;

    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(code);
        button.innerText = 'Copied!';
      } else {
        const textArea = document.createElement('textarea');
        textArea.value = code;
        textArea.style.position = 'fixed'; // 避免滚动到页面底部
        textArea.style.top = '0';
        textArea.style.left = '-9999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        if (document.execCommand('copy')) {
          button.innerText = 'Copied!';
        } else {
          alert('复制文本失败，请重试。');
        }
        document.body.removeChild(textArea);
      }
    } catch (err) {
      console.error('复制文本失败:', err);
      alert('复制文本失败，请重试。');
    }

    // 恢复滚动位置
    window.scrollTo(0, scrollY);

    setTimeout(() => {
      button.innerText = 'Copy';
    }, 2000);
  }
</script>

<!-- 后台script标签 -->
<?php if ($this->options->footerScript): ?>
  <?php echo $this->options->footerScript; ?>
<?php endif; ?>

</html>
