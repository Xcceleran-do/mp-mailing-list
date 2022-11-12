<link rel="stylesheet" href="<?php echo mp_mails_PLAGIN_URL . 'public/css/soon.css' ?>">
<link rel="stylesheet" href="<?php echo mp_gl_PLAGIN_URL . 'public/css/edit_profile.css' ?>">

<div class="coming-soon-container">
  <h1 class="comment-title">Mindplex Moderator</h1>
  <p class="sub-content">Interested In being Mindplex Moderator</p>
  <div class="input-container">
    <div class="input-text-container">
        <div class="editor-icons coming-input">
          <button class="bold">B</button>
          <button class="italic">I</button>
          <button class="underline">U</button>
          <button class="link"><img src="<?php echo mp_gl_PLAGIN_URL . 'public/assets/linkIco.svg' ?>" alt="Link" /></button>
        </div>
        <div id="biography"  class="coming-input message" contenteditable="true"></div>
    </div>
  </div>

  <div class="editors-btn-contian">
    <a href="#" onClick="history.back()"> Go to Previous page</a>
    <button class="notify-btn" id="submitLetter">Send message</button>
  </div>
  
</div>
<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  window.addEventListener("DOMContentLoaded", () => {
    const submitLetter = document.getElementById('submitLetter');
    let isBold = false
    let isUnderlined = false
    let isItalic = false

    function makeBold() {
        document.execCommand("bold");
        if (isBold) {
            document.querySelector(".bold").style.color = "var(--color-white-universal)";
            isBold = false;
        } else {
            document.querySelector(".bold").style.color = "var(--color-new-lightblue)";
            isBold = true;
        }
    }

    function makeItalic() {
        document.execCommand("italic");
        if (isItalic) {
            document.querySelector(".italic").style.color = "var(--color-white-universal)";
            isItalic = false;
        } else {
            document.querySelector(".italic").style.color = "var(--color-new-lightblue)";
            isItalic = true;
        }
    }

    function doUnderline() {
        document.execCommand("underline");
        if (isUnderlined) {
            document.querySelector(".underline").style.color = "var(--color-white-universal)";
            isUnderlined = false;
        } else {
            document.querySelector(".underline").style.color = "var(--color-new-lightblue)";
            isUnderlined = true;
        }
      }

    function linkCommand() {
        const linkElement = document.createElement("a");
        linkElement.href = prompt("add the url below", "https://www.")
        linkElement.target = "_blank"
        linkElement.contentEditable = "false"
        linkElement.style.cursor = "pointer"
        linkElement.style.color = "var(--color-new-cyan)"

        const userSelection = window.getSelection();
        const selectedTextRange = userSelection.getRangeAt(0);
        selectedTextRange.surroundContents(linkElement);
    }
    document.querySelector('.editor-icons .bold').addEventListener("click", makeBold)
    document.querySelector('.editor-icons .italic').addEventListener("click", makeItalic)
    document.querySelector('.editor-icons .underline').addEventListener("click", doUnderline)
    document.querySelector('.editor-icons .link').addEventListener("click", linkCommand)

    const message = document.querySelector('.message')

    submitLetter.addEventListener('click',()=>{
      if(message.textContent !== ''){
      jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'mp_mails_save_moderator',
            message: message.innerHTML,
        },
        success: function(response) {
          console.log(response);
          alert("Message Sent !")
          message.textContent = ''
        }
      });
    }else alert("Please specify your reason")
    })
  })
</script>