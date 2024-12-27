<?php 
/******************************************
Plugin Name: Notepad
Description: Plugin adds tab menu link to a notepad page in backend. 
Version: 1.0 - Sep.2012
Author: Wojciech Jodła
Author website: http://www.wujitsu.pl/
*******************************************
Installation and usage: 
1. Unzip and upload notepad.php file into /plugins directory
2. click on "notepad" tab and follow instructions, or create a new page named "notepad"

*******************************************/

# get correct id for plugin
$thisfile = basename(__FILE__, '.php'); 

# register plugin
register_plugin(
	$thisfile, 
	'WJ Notepad', 	
	'1.1', 		
	'W Jodła',
	'http://www.wujitsu.pl/', 
	'Store your notes, guides, hints, and todos for later usage.',
	'wj_notepad',
	'wj_notepad_show'  
);
# activate filters & hooks
add_action('header','wj_notepad_fancybox');
add_action('header','wj_notepad_css');
add_action('content','wj_notepad_show');
//sidebars
add_action('nav-tab','wj_notepad_tab');
add_action('pages-sidebar','wj_notepad_sidebar', array($thisfile,'Notepad Modal'));

# functions
function wj_notepad_show(){
	$notefilepath = GSDATAPAGESPATH."notepad.xml";
	  if (file_exists($notefilepath) ){
		$notedata    = getXML($notefilepath);
		//show note's file content if page==private
			if ($notedata->private =='Y') {
				echo '<h3><svg xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle" width="1.2em" height="1.2em" viewBox="0 0 20 20"><rect width="20" height="20" fill="none"/><path fill="currentColor" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414a1.5 1.5 0 0 0-.44-1.06l-3.914-3.915A1.5 1.5 0 0 0 10.586 2zM5 4a1 1 0 0 1 1-1h4v3.5A1.5 1.5 0 0 0 11.5 8H15v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm9.793 3H11.5a.5.5 0 0 1-.5-.5V3.207z"/></svg> Notepad</h3><hr id="notepadhr">';
				echo stripslashes(html_entity_decode($notedata->content, ENT_QUOTES, 'UTF-8') );
				echo '<hr id="notepadhr">
				<p class="notepadp"><a class="notepadit" href="edit.php?id=notepad">Edit Notes</a></p>';
			}else echo '<p class="notepadp nofile">Notepad\'s page visibility is set to public !</p>
						<p class="notepadp">Setting page\'s visibility to <b>private</b> is required.</p>
						<p class="notepadp"><a class="notepadit" href="edit.php?id=notepad">edit page settings</a></p>';
	   } else echo '<p class="notepadp nofile">Notepad page is non existent !</p>
	   <p style="text-align:center;">Please <a href="edit.php">create new page</a> named "<i><b>notepad</b></i>", and set its visibility to <i><b>Private</b></i>.</p>
  ';
}
function wj_notepad_tab() {
	echo '<li id="nav_notepad"><a href="load.php?id=wj_notepad"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><rect width="20" height="20" fill="none"/><path fill="currentColor" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414a1.5 1.5 0 0 0-.44-1.06l-3.914-3.915A1.5 1.5 0 0 0 10.586 2zM5 4a1 1 0 0 1 1-1h4v3.5A1.5 1.5 0 0 0 11.5 8H15v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm9.793 3H11.5a.5.5 0 0 1-.5-.5V3.207z"/></svg> Notepad</a></li>';
}
function wj_notepad_sidebar() {
	echo '<li id="sb_notepad"><a id="notepadmodal" href="load.php?id=wj_notepad">Check Notes <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle" width="1.5em" height="1.5em" viewBox="0 0 20 20"><rect width="20" height="20" fill="none"/><path fill="currentColor" d="M6 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7.414a1.5 1.5 0 0 0-.44-1.06l-3.914-3.915A1.5 1.5 0 0 0 10.586 2zM5 4a1 1 0 0 1 1-1h4v3.5A1.5 1.5 0 0 0 11.5 8H15v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm9.793 3H11.5a.5.5 0 0 1-.5-.5V3.207z"/></svg></a></li>';
}
function wj_notepad_fancybox() {
//some magicscript being done here
?>
<script type="text/javascript">
	eval(function(p,a,c,k,e,d){while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+c.toString(a)+'\\b','g'),k[c])}}return p}('$(b).9(4(){$("a#f").j({\'e\':\'5\',\'h\':i,\'d\':2,\'7\':1,\'8\':1,\'c\':1,\'g\':\'3\',\'q\':\'3\',\'k\':s,\'u\':2,\'v\':\'t r\',\'5\':{m:4(6){l n(6).o(\'#p\')[0]}}})});',32,32,'|false|400|elastic|function|ajax|data|autoDimensions|autoScale|ready||document|autoSize|height|type|notepadmodal|transitionIn|width|707|fancybox|speedIn|return|dataFilter|jQuery|find|maincontent|transitionOut|Notes|500|User|speedOut|title'.split('|')))
</script>
<?php
}
function wj_notepad_css() { 
	echo '<style type="text/css">
		tr#tr-notepad,tr#tr-user-note {display:none !important;}a.notepadit {display:none;}hr#notepadhr, div.fancybox-inner hr{xwidth:95%;height:3px;margin:10px auto;background-color: #D8D8D8;outline:none;border:none;border-top:1px solid #F6F6F6;border-bottom:1px solid #F6F6F6;}p.notepadp {text-align:center;font-size:10pt;}p.notepadp.nofile {color:#CF3805;font-weight:bold;font-size:12pt;}/*fancybox fixes*/div.fancybox-inner {background: #FFF; border:1px solid #E1E1E1; box-shadow: 0 0 4px rgba(0, 0, 0, 0.06);}div.fancybox-inner #maincontent .main {margin: 0;padding: 15px;color: #000;border:none !important;box-shadow: none;}div.fancybox-inner p{padding:5px 0; line-height:1.3em;}.fancybox-title-float-wrap .child {border: 2px solid #FFFFFF !important;border-radius: 15px 15px 0 0 !important;}.fancybox-title-float-wrap {top: 0 !important;bottom:auto !important;margin-top: -30px !important;margin-bottom: 0 !important;}
 ';
	if (get_filename_id()=='load' && $_GET['id']=='wj_notepad') {
	echo '
		body#load #maincontent {width:960px !important;}a.notepadit{clear:both;display:inline-block;margin:10px auto;padding:5px 10px;color:#000;font-weight:bold;text-shadow: 0 1px 0 #FFF;text-decoration:none !important;border:1px solid #FFF;box-shadow: 0 2px 10px 0 #eeeeee, inset 0 -2px 5px 0 #cccccc;border-radius:6px;background: #eeeeee;url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2VlZWVlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNjY2NjY2MiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc));background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%);background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%);background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%);background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%);filter:none;}a.notepadit:hover {box-shadow: 0 0 8px 0 #eeeeee, inset 0 -2px 5px 0 #BFBFBF;}a.notepadit:active {margin:12px auto 8px;box-shadow: 0 0 5px 0 #eeeeee, inset 0 2px 5px 0 #cccccc;}/* GS tab button styles */#load .wrapper .nav li#nav_notepad a {color:#111;background:#f6f6f6;background: -moz-linear-gradient(top, #FFF 3%, #F6F6F6 100%); /* firefox */background: -webkit-gradient(linear, left top, left bottom, color-stop(3%,#FFF), color-stop(100%,#F6F6F6)); /* webkit */font-weight:bold !important;text-shadow: 1px 1px 0px rgba(255,244,255,.2);box-shadow: rgba(0,0,0, 0.10) 2px -2px 2px;-moz-box-shadow: rgba(0,0,0, 0.10) 2px -2px 2px;-webkit-box-shadow: rgba(0,0,0, 0.10) 2px -2px 2px;}
	';
	}
	echo '</style>';
}
?>