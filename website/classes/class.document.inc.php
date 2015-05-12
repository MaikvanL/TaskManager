<?php
class document {
		
	// ####################################################################
		public function open_html() {
			print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">' . PHP_EOL;
			print '<html class="';
			if (isset($_GET['var1'])) { print ($_GET['var1']); } 
			print '" xmlns="http://www.w3.org/1999/xhtml">' . PHP_EOL . PHP_EOL; 
		}
		
	// ####################################################################
		public function open_head() {
			print '<head>' . PHP_EOL . PHP_EOL;
		}
		
	// ####################################################################
		public function open_body() {
			print '<body>' . PHP_EOL . PHP_EOL;
		}
	
	// ####################################################################
		public function load_stylesheets() {
			print '<!-- STYLESHEET -->' . PHP_EOL;
			print '<link rel="stylesheet" type="text/css" href="'.HTTP_WEBSITE.'css/stylesheet.css" />'. PHP_EOL;
			print '<!-- STYLESHEET -->' . PHP_EOL . PHP_EOL;
		}

	// ####################################################################
		public function get_stylesheets_systeem() {
			$css_dir = ROOT_CURRENT.'css/';
			$css_dir_open = opendir($css_dir);   
			while(false !== ($file = readdir($css_dir_open))) {
				if (strpos('[start]'.$file, '.css')==true or strpos('[start]'.$file, '.less')==true) {
					$stylesheets[] = $css_dir.$file;
				}   
			} 
			closedir($css_dir_open);
			return $stylesheets;
		}
		
	// ####################################################################
		public function get_stylesheets_plugins() {
			if (PLUGINS!='') { $plugins = explode(',',PLUGINS); } else { $plugins=array(); }
			foreach($plugins as $plugin) {
				if (file_exists(ROOT_CURRENT.'plugins/'.$plugin.'/config.ini')==true) {
					$ini_array = parse_ini_file(ROOT_CURRENT.'plugins/'.$plugin.'/config.ini',true);
					if (is_array($ini_array['stylesheets'])==true) {
						foreach ($ini_array['stylesheets'] as $item) {
							if (file_exists(ROOT_CURRENT.$item)==true) { $stylesheets[] = ROOT_CURRENT.$item; }
						}
					}
				}
			}
			
			return $stylesheets;
		}
		
	// ####################################################################
		public function load_analytics(){
			if (file_exists(ROOT_CURRENT.'includes/analytics.php')==true) { include(ROOT_CURRENT.'includes/analytics.php'); }
		}
	
	// ####################################################################
		public function checkUserlevel($session, $userlevel){
			if ($session & USER_LEVEL) {
	 			
			}
			else {
				die("<script>alert('U heeft geen bevoegdheden voor deze pagina.');</script><script>location.href = 'http://taskmgr.mvlcreatie.nl/home'</script>");
			}
		}
	
	// ####################################################################
		public function cache_stylesheets() {
		
			if (file_exists(ROOT_CURRENT.'_chache')==false) { mkdir(ROOT_CURRENT.'_chache', 0777); }
			
			$stylesheets_plugins = $this->get_stylesheets_plugins();
			$stylesheets_systeem = $this->get_stylesheets_systeem();
			if (is_array($stylesheets_plugins)==false) { $stylesheets_plugins=array(); }
			if (is_array($stylesheets_systeem)==false) { $stylesheets_systeem=array(); }
			$stylesheets = array_merge($stylesheets_plugins,$stylesheets_systeem);
			$time = mktime(0,0,0,21,5,1980);
			$cache_css = ROOT_CURRENT.'_chache/stylesheet.css';
			$cache_less = ROOT_CURRENT.'_chache/stylesheet.less';
		    foreach($stylesheets as $file) {
		        $fileTime = filectime($file);
		        if($fileTime > $time) { $time = $fileTime; }
		    }
		    
		    if(file_exists($cache_css)) { $cache_Time = filectime($cache_css); }
		    if(file_exists($cache_less)) { if (filectime($cache_less)<$cache_Time) { $cache_Time = filectime($cache_less); } }
		    
		    if(file_exists($cache_css) and file_exists($cache_less)) {
		        if($cacheTime < $time) {
		            $time = $cacheTime;
		            $recache = true;
		        } else {
		            $recache = false;
		        }
		    } else {
		        $recache = true;
		    }

	        if($recache==true) {
	        	print '<!-- NEW CHACHE STYLESHEET -->' . PHP_EOL;
	            $css = '';
	            $less = '';
	            foreach($stylesheets as $file){
	            	$inhoud = file_get_contents($file);
	            	$inhoud = str_replace('[http]',HTTP_CURRENT,$inhoud);
	            	if (strpos('[start]'.$file, '.less')>0) { $less .= $inhoud; }
	            	if (strpos('[start]'.$file, '.css')>0) { $css .= $inhoud; }
	            }
	            if ($css!='') { file_put_contents($cache_css,$css); }
	            if ($less!='') { file_put_contents($cache_less,$less); }
	        }
		}
	
	
	
	
	
	
	
	public function load_javascripts(){
		print '<!-- JAVASCRIPT -->' . PHP_EOL;
			print '<script language="javaScript" src="'.HTTP_CURRENT.'javascript/script.js" type="text/javascript">//</script>'. PHP_EOL;
		print '<!-- JAVASCRIPT -->' . PHP_EOL . PHP_EOL;		
	}
	
	public function load_metatags($title='',$description='',$keywords='',$lang='nl'){
		
		if (empty($title)==true) { 
			$title=HTTP_CURRENT; 
		}
		
		print '<title>Task Manager - '.$title.'</title>'.PHP_EOL;
		print '<meta name="description" content="'.$description.'" />'.PHP_EOL;
		print '<meta name="keywords" content="'.$keywords.'" />'.PHP_EOL;
		print '<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />'.PHP_EOL;
        print '<meta http-equiv="content-language" content="'.$lang.'" />'.PHP_EOL.PHP_EOL;
   
	} 
	public function success($onderdeel, $actie){
		print '<div class="alert alert-success" role="alert"><strong>Geslaagd</strong>, uw '. $onderdeel .' is succesvol '.$actie.'.</div>';
	}
	public function failed($onderdeel, $actie){
		print '<div class="alert alert-danger" role="alert"><strong>Oeps</strong>, uw '. $onderdeel .' is niet '.$actie.'. Controleer de velden en probeer het opnieuw.</div>';
	}
	public function load_plugins(){	
			if (file_exists(ROOT_WEBSITE.'plugins/load.php')==true) { include(ROOT_WEBSITE.'plugins/load.php'); }

	}
		
	public function close_body()
	{
		$this->load_analytics();
		echo '</body>' . PHP_EOL . PHP_EOL;
	}
	
	
	public function close_html()
	{
		echo '</html>';
	}
	public function close_head()
	{
		echo '</head>' . PHP_EOL . PHP_EOL;
	}
	
	public function simple_open(){
		$this->open_html();
		$this->open_head();
			$this->load_metatags();
			$this->load_plugins();
			$this->load_stylesheets();
		$this->close_head();
		$this->open_body();	
	}
	
	public function simple_close(){
		$this->close_body();
		$this->close_html();
	}

    public function convertToSQLDate($date){
        $dt = DateTime::createFromFormat('d-m-Y',$date);
        $convertedDate = $dt->format('Y-m-d');
        return $convertedDate;

    }
	
	public function convertFromSQLDate($date){
        $dt = DateTime::createFromFormat('Y-m-d',$date);
        $convertedDate = $dt->format('d-m-Y');
        return $convertedDate;

    }
}