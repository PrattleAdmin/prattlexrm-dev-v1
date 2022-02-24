<?php
if ($cfg)
    header("Content-Security-Policy: frame-ancestors ".$cfg->getAllowIframes().";");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html <?php
if (($lang = Internationalization::getCurrentLanguage())
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo 'dir="rtl" class="rtl"';

// Dropped IE Support Warning
if (osTicket::is_ie())
    $warning = __('osTicket no longer supports Internet Explorer.');
?>>
<head>
    <title><?php echo $wizard['title']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/wizard.css?b42ddc7"/>
        <!--osta-->
	<link rel="shortcut icon" href="<?php echo ROOT_PATH; ?>osta/css/themes/cool/favicon.ico">
	<link rel="shortcut icon" href="<?php echo ROOT_PATH; ?>osta/css/themes/cool/favicon.png">	
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?b42ddc7"/>
	<?php include ROOT_DIR . '/osta/inc/setup-head.html'; ?>
</head>
<body class="client-side <?php echo basename($_SERVER['PHP_SELF'], '.php');  ?>-page">


<div id="container">

   <div id="header">
      <!--osta-->
      <div id="header-inner">


               <div id="header-default">
                  <?php				
                     $file_name = ROOT_DIR ."osta/inc/default-logo.html";
                     echo file_get_contents($file_name);
                     ?>
               </div>
            </div>

      </div>
   </div>
</div>
<div class="clear"></div>

<div id="nav-wrapper">
   <div id="nav-inner">
		<ul id="nav" class="flush-left">
			<li>
			   <?php
			   foreach($wizard['menu'] as $k=>$v)
				echo sprintf('<a target="_blank" href="%s">%s</a> &mdash; ',$v,$k);
			   ?>
				<a target="_blank" href="https://osticketawesome.com/contact/"><?php echo __('Contact Us');?></a>
			</li>
		</ul>
		<div id="lang-wrapper">			
		<div class="button-container">
			<div class="button-text-container shrink" style="width:?">
				<div id="flags">
					<?php
					if (($all_langs = Internationalization::getConfiguredSystemLanguages())
						&& (count($all_langs) > 1)
					) {
						$qs = array();
						parse_str($_SERVER['QUERY_STRING'], $qs);
						foreach ($all_langs as $code=>$info) {
							list($lang, $locale) = explode('_', $code);
							$qs['lang'] = $code;
					?>
							<a class="flag flag-<?php echo strtolower($locale ?: $info['flag'] ?: $lang); ?>"
								href="?<?php echo http_build_query($qs);
								?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a>
					<?php }
					} ?>
				</div> 
			</div>
			<div class="button-icon-container" id="myButton">
				<svg style="width:24px;height:24px" viewBox="0 0 24 24">
					<path fill="#ffffff" d="M5.59,7.41L7,6L13,12L7,18L5.59,16.59L10.17,12L5.59,7.41M11.59,7.41L13,6L19,12L13,18L11.59,16.59L16.17,12L11.59,7.41Z" />
				</svg>
			</div>
		</div>
		</div>	
      <div id="language-select">
      </div>
   </div>
</div>




    <div id="wizard">
        <?php if ($warning) echo sprintf('<div class="warning_bar">%s</div>', $warning); ?>
        <div id="header">
            <!--<img id="logo" src="./images/<?php echo $wizard['logo'] ?: 'logo.png'; ?>" alt="osTicket">-->
            <div class="info"><?php echo $wizard['tagline']; ?>
			<span class="forslash"> //</span>		
            <?php $themev = ROOT_DIR ."osta/version"; echo file_get_contents($themev); ?></div>
			<!--
            <br/>
            <ul class="links">
                <li>
                   <?php
                   foreach($wizard['menu'] as $k=>$v)
                    echo sprintf('<a target="_blank" href="%s">%s</a> &mdash; ',$v,$k);
                   ?>
                    <a target="_blank" href="https://osticketawesome.com/contact/"><?php echo __('Contact Us');?></a>
                </li>
            </ul>
            <div class="flags">
<?php
if (($all_langs = Internationalization::availableLanguages())
    && (count($all_langs) > 1)
) {
    foreach ($all_langs as $code=>$info) {
        list($lang, $locale) = explode('_', $code);
?>
        <a class="flag flag-<?php echo strtolower($locale ?: $info['flag'] ?: $lang); ?>"
            href="?<?php echo urlencode($_GET['QUERY_STRING']); ?>&amp;lang=<?php echo $code;
            ?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a>
<?php }
} ?>

-->
            </div>
        </div>
        <div class="clear"></div>
        <div id="content">
