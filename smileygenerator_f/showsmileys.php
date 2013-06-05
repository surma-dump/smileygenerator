<?
  define('IN_PHPBB', 'true');
  $phpbb_root_path = './';
  include($phpbb_root_path . 'extension.inc');
  include($phpbb_root_path . 'common.'.$phpEx);

  $userdata = session_pagestart($user_ip, PAGE_INDEX, $session_length);
  init_userprefs($userdata);

  $gen_simple_header = 1;
  $page_title = $lang['Smilie_creator'];
  include($phpbb_root_path . 'includes/page_header.'.$phpEx);

  $smileydir = opendir ("./smileygenerator") ;
  $i == 0 ;
  ?>
<script language="javascript" type="text/javascript">
<!--
function emoticon(text) {
        text = '[smiley poster=' + text + ']' + document.forms['eingabeform'].eingabe.value + '[/smiley] ';
        if (opener.document.forms['post'].message.createTextRange && opener.document.forms['post'].message.caretPos) {
                var caretPos = opener.document.forms['post'].message.caretPos;
                caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
                opener.document.forms['post'].message.focus();
        } else {
        opener.document.forms['post'].message.value  += text;
        opener.document.forms['post'].message.focus();
        window.close() ;
        }
}
//-->
</script>
<center><table border=0 class="forumline">
      <tr>
        <th class="thHead">
          <table border=0 width="100%">
            <tr>
              <td><center><b><font>Bild</font></b></center></td>
              <td><center><b>Key</b></center></td>
              <td><center><b>Bild</b></center></td>
              <td><center><b>Key</b></center></td>
            </tr>
          </table>
        </th>
      </tr><tr>
        <td class="row1">
          <table border=0>
            <tr>
  <?
  while ($file = readdir ($smileydir))
  {
    if ($file != "." && $file != "..")
    {
      if (preg_match ("/smiley\_(.+)\.png/i", $file))
      {
        $key = preg_replace ("/smiley\_(.+)\.png/i", "\\1", $file) ;
        echo "<td><center><a href=\"javascript: emoticon ('$key')\"><img src=\"./smileygenerator/smileygenerator.php?smiley=$key&text=\" border=0></a></center></td>" ;
        echo "<td><center>&quot;$key&quot;</center></td>" ;
        if ($i % 2 == 1)
          echo "</tr><tr>" ;
        $i++ ;
      }
    }
  }
  if ($i % 2 == 1)
  {
    echo "<td>&nbsp;</td>" ;
    echo "<td>&nbsp;</td>" ;
  }
?>
            </tr>
            <tr>
              <td colspan=2>Text:</td>
              <td colspan=2><form name="eingabeform">
                <input type="text" name="eingabe" size=14>
              </form></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td class="catBottom"><center><b><a href="javascript:window.close()">Schliessen</a></b></center></td>
      </tr>
    </table></center>
  </body>
</html>