function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertshortcodes() {
	
	var tagtext;
	
	var shortcodes_panel = document.getElementById('shortcodes_panel');
	
if (shortcodes_panel.className.indexOf('current') != -1) {
		var kayashortcode = document.getElementById('kayashortcodetag').value;
		switch(kayashortcode)
{
case 0:
 	tinyMCEPopup.close();
  break;
  
 
	case 'button_small':
	tagtext="["+kayashortcode + "  linkurl=\"#\"  color=\"blue\"] Insert Button Text <span> </span> [/" + kayashortcode + "]";
	break;
  
	case 'button_big':
	tagtext="["+kayashortcode + "  linkurl=\"#\"  color=\"blue\"  desc=\"desc\"] Insert Button Text <span> </span> [/" + kayashortcode + "]";
	break;  
  
	case 'dropcap':
 	tagtext="["+kayashortcode + " ] insert text [/" + kayashortcode + "]";
	break;
	
	case "toggle_content":
		tagtext = "["+ kayashortcode + "  heading=\"Toggle Heading\"]  Add your content here [/" + kayashortcode + "]";
	break;
	
	case "tabs":
	tagtext="["+ kayashortcode + " tab1=\"Tab 1 Title\" tab2=\"Tab 2 Title\" tab3=\"Tab 3 Title\"]<br /><br />[tab tab1]Insert tab 1 content here[/tab]<br />[tab tab2]Insert tab 2 content here[/tab]<br />[tab tab3]Insert tab 3 content here[/tab]<br /><br />[/" + kayashortcode + "]";
	break;
	
		case "vtabs":
	tagtext="["+ kayashortcode + " vtab1=\"Tab 1 Title\" vtab2=\"Tab 2 Title\" vtab3=\"Tab 3 Title\"]<br /><br />[vtab vtab1]Insert tab 1 content here[/vtab]<br />[vtab vtab2]Insert tab 2 content here[/vtab]<br />[vtab vtab3]Insert tab 3 content here[/vtab]<br /><br />[/" + kayashortcode + "]";
	break;
	
	case 'clear':
 	tagtext="["+kayashortcode + " ] &nbsp; [/" + kayashortcode + "]";
	break;
	
	case 'divider':
 	tagtext="["+kayashortcode + " ] &nbsp; [/" + kayashortcode + "]";
	break;
	
	case 'announcement':
 	tagtext="["+kayashortcode + " ] Add your content here [/" + kayashortcode + "]";
	break;
	case "kaya_table":
	tagtext = "["+ kayashortcode + "  style= \" red \"]<table width=\"100%\"><br /><tbody><br /><tr><br /><th width=\"30%\">Heading 1</th width=\"30%\"><br /><th width=\"30%\">Heading 2</th width=\"30%\"><br /><th width=\"30%\">Heading 3</th><br /><th>Heading 4</th><br /></tr><br /><tr><br /><td>Division 1</td><br /><td>Division 2</td><br /><td>Division 3</td><br /><td>Division 4</td><br /></tr><br /><tr><br /><td>Division 1</td><br /><td>Division 2</td><br /><td>Division 3</td><br /><td>Division 4</td><br /></tr><br /></tbody><br /></table><br />[/" + kayashortcode + "]";
break;

// shortcode columns starts ==================================================
	case "one_fifth":
	tagtext = "[one_fifth]<br /> Insert your content here <br />[/one_fifth]<br /><br />[one_fifth]<br /> Insert your content here 1<br />[/one_fifth]<br /><br />[one_fifth]<br /> Insert your content here <br />[/one_fifth]<br /><br />[one_fifth]<br /> Insert your content here <br />[/one_fifth]<br /><br />[one_fifth_last]<br /> Insert your content here <br />[/one_fifth_last]<br />";
	break;
	
	case "four_fifth":
	tagtext = "[four_fifth]<br /> Insert your content here <br />[/four_fifth]<br /><br />[one_fifth_last]<br /> Insert your content here <br />[/one_fifth_last]<br />";
	break;
	
	case "one_fourth":
	tagtext = "[one_fourth]<br /> Insert your content here <br />[/one_fourth]<br /><br />[one_fourth]<br /> Insert your content here <br />[/one_fourth]<br /><br />[one_fourth]<br /> Insert your content here <br />[/one_fourth]<br /><br />[one_fourth_last]<br /> Insert you content here <br />[/one_fourth_last]<br />";
	 break;
	
	
	case "one_third":
	tagtext = "[one_third]<br /> Insert your content here<br />[/one_third]<br /><br />[one_third]<br /> Insert your content here <br />[/one_third]<br /><br />[one_third_last]<br /> Insert your content here <br />[/one_third_last]<br />";
	break;
	 
	case "one_half":
	tagtext = "[one_half]<br /> Insert your content here <br />[/one_half]<br /><br />[one_half_last]<br /> Insert your content here <br />[/one_half_last]<br />";
	break;
 
	case "fullwidth":
	tagtext = "[fullwidth]<br /> Insert your content here <br />[/fullwidth]";
	break;
 
	case "two_thid":
	tagtext = "[two_third]<br /> Insert your content here <br />[/two_third]<br /><br />[one_third_last]<br /> Insert your content here <br />[/one_third_last]";
	break;
 
	case "three_fourth":
	tagtext = "[three_fourth]<br /> Insert your content here <br />[/three_fourth]<br /><br />[one_fourth_last]<br /> Insert your content here <br />[/one_fourth_last]";
	break;
	
// shortcode columns end ==================================================	

	case 'quotes':
 	tagtext="["+kayashortcode + " ] Insert you content here [/" + kayashortcode + "]";
	break;
	
	
	case "list":
	
	tagtext = "[list style=\"circle\"]<ul><li> Insert your content here </li> <li> Insert your content here </li> <li> Insert your content here </li></ul>[/list]";
	break;
	
	case "testimonial":
		tagtext = "["+ kayashortcode + "  title=\"Testimonial Title\" author_image=\" client image url\" link=\"#\" ]  Add the Testimonial content here [/" + kayashortcode + "]";
	break;
	
	case "teaserbox":
		tagtext = "["+ kayashortcode + "   icon=\" icon url  \" column=\" add column shortcode, ex: one_half, one_half_last  \" title= \" Teaser Title \" link=\"#\" ]  Add the Teaserbox content here [/" + kayashortcode + "]";
	break;
	
	
	case "Teaser Text":
		tagtext = "["+ kayashortcode + "   teasertitle=\" Add your Teaser Title \"]  Add your Teaser Description here [/" + kayashortcode + "]";
	break;
	
	case "Teaser Contact":
		tagtext = "["+ kayashortcode + " ]  Add your Teaser Contact content here [/" + kayashortcode + "]";
	break;
	
	case "social":
		tagtext = "["+ kayashortcode + " icon=\" icon url  \" link=\"#\" ]  [/" + kayashortcode + "]";
	break;
	case "galleria":
	tagtext = "["+ kayashortcode + " width=\" 600  \" height=\"400\"  transition=\"fade\" autoplay=\"3000\"]  [/" + kayashortcode + "]";
	break;
	case "categoryslider":
	tagtext = "["+ kayashortcode + " postlimit=\"4 \" imagewidth=\" 150  \" imageheight=\"100\"  category=\"\" title=\"Enter Slider Title\"]  [/" + kayashortcode + "]";
	break;
	case "portfolioslider":
	tagtext = "["+ kayashortcode + " postlimit=\"4\" imagewidth=\"199\" imageheight=\"245\"  portfolio=\"\" title=\"Enter Slider Title\"]  [/" + kayashortcode + "]";
	break;	
	case "portfolionivoslider":
	tagtext = "["+ kayashortcode + " postlimit=\"4\" imagewidth=\"455 \" imageheight=\"295\"  portfolio=\"\" title=\"Enter Slider Title\"]  [/" + kayashortcode + "]";
	break;
	case "twitter":
	tagtext = "["+ kayashortcode + "   title=\"Recent Tweets\" username=\"envatowebdesign\" limits=\"3\" ]  [/" + kayashortcode + "]";
	break;	
	case "kslider":
	tagtext = "["+ kayashortcode + " width=\"620\"  height=\"300\"] <br> http://www.yoursite.com/images/1.jpg <br>  http://www.yoursite.com/images/2.jpg <br>   [/" + kayashortcode + "]";
	break;
	
  
  default:
tagtext="["+kayashortcode + "] Insert your  content here text[/" + kayashortcode + "]";
}
}
// portfolio panel
var kaya_portfolio = document.getElementById('portfolio_panel');

if (kaya_portfolio.className.indexOf('current') != -1) {

		//var portfolio_tag = document.getElementById('portfolio_tag').value;

			 var portfolio_selected = new Array();
  var selObj = document.getElementById('portfolio_tag');
  var i;
  var count = 0;
  for (i=1; i<selObj.options.length; i++) {
    if (selObj.options[i].selected) {
	
      portfolio_selected[count] = selObj.options[i].value;
	  
      count++;
    }
  }
 
		
    	var max_columns = document.getElementById('max_columns').value;

		var images_pages = document.getElementById('images_pages').value;
		



var title_show = getCheckedValue(document.getElementsByName('title_show'));

var desc_show = getCheckedValue(document.getElementsByName('desc_show'));

var images_links = getCheckedValue(document.getElementsByName('images_links'));
var portfolio_sidebar = getCheckedValue(document.getElementsByName('portfolio_sidebar'));

		if (portfolio_selected != 0 )

			tagtext = "[portfolio id='" + portfolio_selected + "' images=" + images_pages + " column=" + max_columns + "  sidebar=" + portfolio_sidebar + "]";

		else

tagtext = "[portfolio id=\'\' images=" + images_pages + " column=" + max_columns + "  sidebar=" + portfolio_sidebar + "]";
	}
// blog panel
// portfolio panel
var kaya_blog = document.getElementById('blog_panel');

if (kaya_blog.className.indexOf('current') != -1) {

		var blog_tag = document.getElementById('blog_tag').value;

    	var numberof_post = document.getElementById('numberof_post').value;
		var imagewidth = document.getElementById('imagewidth').value;
		var imageheight = document.getElementById('imageheight').value;

var metainfo_show = getCheckedValue(document.getElementsByName('metainfo_show'));

var postimg_show = getCheckedValue(document.getElementsByName('postimg_show'));
var pagination_show = getCheckedValue(document.getElementsByName('pagination_show'));

		if (blog_tag != 0 )

			tagtext = "[blog  id=" + blog_tag + " imagewidth=" + imagewidth+ " imageheight=" + imageheight+ "  postlimit=" + numberof_post + " metainfo=" + metainfo_show + " postimage=" + postimg_show + " pagination=" + pagination_show+ "]";

		else

tagtext = "[blog id=\"\"  imagewidth=" + imagewidth+ " imageheight=" + imageheight+ " postlimit=" + numberof_post + " metainfo=" + metainfo_show + " postimage=" + postimg_show + " pagination=" + pagination_show+ "]";
	}

if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}