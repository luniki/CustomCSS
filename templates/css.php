<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    textarea[name=custom_css] {
        background-color: #eeeeee;
        border: thin solid #aaaaaa;
        margin: 5px;
        width: 95%;
        height: 400px; 
        font-family: Courier New, MONOSPACE
    }
    textarea[name=custom_css]:focus {
        box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
    }
</style>

<form action="?" method="post">
    <textarea name="custom_css" id="custom_css"><?= htmlReady($customcss['css']) ?></textarea>
    <br>
    <?= \Studip\Button::create(_("speichern")) ?>
</form>

<script>
jQuery(function () {
    jQuery("#custom_css").bind("keydown", function (event) {
        if (event.keyCode === 9) { //tab
            jQuery("#custom_css").insertAtCaret("    ");
            return false;
        }
        if (event.keyCode === 13) { //enter
            var line = jQuery(this).val();
            line = line.substr(0, this.selectionStart);
            line = line.substr(lastIndexOf("n"));
            console.log(line);
        }
    });
    jQuery("#share_via_blubber").bind("click", function () {
        if (window.confirm("Jetzt Ihr CSS in Blubber �ffentlich machen und teilen?")) {
            jQuery.ajax({
                'url': STUDIP.ABSOLUTE_URI_STUDIP + "plugins.php/customcss/share",
                'type': "post",
                'dataType': "json",
                'success': function (output) {
                    alert("Ihr CSS steht jetzt im globalen Blubberstream.");
                }
            });
            return false;
        } else {
            return false;
        }
    });
});

jQuery.fn.extend({
insertAtCaret: function(myValue){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      var sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  });
}
});
</script>


<?
$infobox = array(
    array(
        'kategorie' => _("Information"),
        'eintrag' => array(
            array('icon' => "icons/16/black/code", 'text' => _("Geben Sie eigenes CSS ein, das Stud.IP exklusiv nur f�r Sie anders aussehen l�sst.")),
            array('icon' => "icons/16/black/community", 'text' => sprintf(_("Teilen Sie Ihr CSS mit anderen �ber %sBlubber%s."), '<a href="'.URLHelper::getLink("plugins.php/blubber/streams/global?hash=MeinCSS").'" id="share_via_blubber">', '</a>'))
        )
    )
);

$infobox = array(
    'picture' => $GLOBALS['ABSOLUTE_URI_STUDIP'].$plugin->getPluginPath()."/assets/infobox.jpg",
    'content' => $infobox
);