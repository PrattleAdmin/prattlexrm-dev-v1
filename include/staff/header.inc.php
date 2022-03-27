<?php
header("Content-Type: text/html; charset=UTF-8");
header("Content-Security-Policy: frame-ancestors ".$cfg->getAllowIframes().";");

$title = ($ost && ($title=$ost->getPageTitle()))
    ? $title : ('osTicket :: '.__('Staff Control Panel'));

if (!isset($_SERVER['HTTP_X_PJAX'])) { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html<?php
if (($lang = Internationalization::getCurrentLanguage())
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo ' dir="rtl" class="rtl"';
if ($lang) {
    echo ' lang="' . Internationalization::rfc1766($lang) . '"';
}

// Dropped IE Support Warning
if (osTicket::is_ie())
    $ost->setWarning(__('osTicket no longer supports Internet Explorer.'));
?>>
<head>
    <!-- Powered by osTicket -->
    <!-- Supercharged by osTicket Awesome -->	
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="x-pjax-version" content="<?php echo GIT_VERSION; ?>">
    <title><?php echo Format::htmlchars($title); ?></title>
    <!--[if IE]>
    <style type="text/css">
        .tip_shadow { display:block !important; }
    </style>
    <![endif]-->
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-3.5.1.min.js?b42ddc7"></script>
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>css/thread.css?b42ddc7" media="all"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>scp/css/scp.css?b42ddc7" media="all"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?b42ddc7" media="screen"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>scp/css/typeahead.css?b42ddc7" media="screen"/>
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?b42ddc7"
         rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>css/jquery-ui-timepicker-addon.css?b42ddc7" media="all"/>
     <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?b42ddc7"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome-ie7.min.css?b42ddc7"/>
    <![endif]-->
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH ?>scp/css/dropdown.css?b42ddc7"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/loadingbar.css?b42ddc7"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?b42ddc7"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/select2.min.css?b42ddc7"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?b42ddc7"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH ?>scp/css/translatable.css?b42ddc7"/>
	<!--osta-->

    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }
    ?>
	<?php include ROOT_DIR . '/osta/inc/staff-head.html'; ?>	
	
</head>
<!--osta-->
<body class="staff-side <?php $phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL); echo basename(substr($phpSelf, 0, strpos($phpSelf, '.php')));  ?>-page">
<script>
	    function popupwindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
	</script>
<div id="container">
    <?php if($ost->getError()) echo sprintf('
    <div id="error_bar">%s</div>', $ost->getError()); elseif($ost->getWarning()) echo sprintf('
    <div id="warning_bar"><div id="warning-inner">%s</div></div>', $ost->getWarning()); elseif($ost->getNotice()) echo sprintf('
    <div id="notice_bar">%s</div>', $ost->getNotice()); ?>
    
    
    
    <div id="header">
    <div id="header-constrain">
        <div id="nav" class="pull-right pjax">
            <!--<?php echo sprintf(__('Welcome, %s.'), '<strong>'.$thisstaff->getFirstName().'</strong>'); ?>-->

            <?php include STAFFINC_DIR . "templates/navigation.tmpl.php"; ?>

            <?php if($thisstaff->isAdmin() && !defined('ADMINPAGE')) { ?> 
            <a href="<?php echo ROOT_PATH ?>scp/admin.php" class="no-pjax">
                <?php echo __( 'Admin Panel'); ?>
            </a>
            <?php }else{ ?> 
            <a href="<?php echo ROOT_PATH ?>scp/index.php" class="no-pjax">
                <?php echo __( 'Agent Panel'); ?>
            </a>
            
            <a href="javascript:void(0)" onclick="popupwindow('<?php echo 'https://prattle.jaapa.tech/sip/phone/index.html?user='.$thisstaff->getSipUser().'&pass='.$thisstaff->getSipPassword().'&server='.$thisstaff->getSipServer().'&display='.$thisstaff->getFirstName().'&realm='.$thisstaff->getSipServer() ?>', 'HI', 320, 500)">Virtual Phone</a>
            <?php } ?> 
            <a href="<?php echo ROOT_PATH ?>scp/profile.php">
                <?php echo $thisstaff->getFirstName(); ?>
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="-293 385 24 24" style="enable-background:new -293 385 24 24;" xml:space="preserve">
				<g>
					<path d="M-289,405.1h16v-2.8c0-2.5-5.3-3.8-8-3.8s-8,1.3-8,3.8V405.1z M-287.8,402.4c0-1.1,3.8-2.6,6.8-2.6c3,0,6.8,1.5,6.8,2.6
						v1.5h-13.6V402.4z"/>
					<path d="M-281,396.7c2.1,0,3.8-1.7,3.8-3.8c0-2.1-1.7-3.8-3.8-3.8s-3.8,1.7-3.8,3.8C-284.8,395-283.1,396.7-281,396.7z M-281,390.3
						c1.4,0,2.6,1.2,2.6,2.6s-1.2,2.6-2.6,2.6c-1.4,0-2.6-1.2-2.6-2.6S-282.4,390.3-281,390.3z"/>
				</g>
				</svg>
            </a>
            <span data-placement="bottom" data-toggle="tooltip" title="" data-original-title="logout">          
            <a href="<?php echo ROOT_PATH ?>scp/logout.php?auth=<?php echo $ost->getLinkToken(); ?>" class="no-pjax">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
				<polygon points="15.5,7.5 14.6,8.4 17.6,11.4 7.4,11.4 7.4,12.6 17.6,12.6 14.6,15.6 15.5,16.5 20,12 "></polygon>
				<path d="M20.6,15.2l-1.3,1.3v2.9H4.6V4.6h14.8v2.9l1.3,1.3V5c0-0.9-0.7-1.6-1.6-1.6H5C4.1,3.4,3.4,4.1,3.4,5v14 c0,0.9,0.7,1.6,1.6,1.6h14c0.9,0,1.6-0.7,1.6-1.6V15.2z"></path>
				</svg>
       		</a>
       	    </span>
        </div>

		<a id="header-logo" href="<?php echo ROOT_PATH; ?>scp/">
        <div id="left-logo">
			<div id="header-text">
				<div id="header-title">
					<?php echo $custom["title"]; ?>   
				</div>
				<div id="header-subtitle">
					<?php echo $custom["subtitle"]; ?>      
				</div>
			</div>		
			
            <div id="header-image">
				<img src="<?php echo get_logo( $custom, "staff" )?>?<?php echo strtotime($cfg->lastModified('staff_logo_id')); ?>" alt="osTicket &mdash; <?php echo __('Customer Support System'); ?>"/> 
            </div>	

            <div id="header-default">
				<?php				
				$file_name = ROOT_DIR ."osta/inc/default-logo.html";
				echo file_get_contents($file_name);
				?>
            </div>			
			
        </div>
		</a>
		
            <div id="right-buttons">
                <a class="mobile-nav" href="<?php echo ROOT_PATH; ?>scp/tickets.php?status=open">
                    <svg style="width:24px;height:24px; padding: 18px;float:right;margin-right:1px;" viewBox="0 0 24 24">
                        <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z"></path>
                    </svg>
                </a>
                <a class="mobile-nav" href="<?php echo ROOT_PATH; ?>scp/users.php">
                    <svg style="width:24px;height:24px; padding: 18px;float:right;margin-right:1px;" viewBox="0 0 24 24">
                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"></path>
                    </svg>
                </a>
                <a class="mobile-nav" href="<?php echo ROOT_PATH; ?>scp/tickets.php?a=open">
                    <svg style="width: 30px; height: 30px; padding: 15px 20px 15px 12px; float: right;" viewBox="0 0 24 24">
                        <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"></path>
                    </svg>
                </a>
            </div>
    	</div>
		</div>
            <div id="right-menu" href="#right-menu">
                <button href="#right-menu" class="c-hamburger c-hamburger--htx" style="">
                    <span>toggle menu</span>
                </button>
                <script>
                    
                    $(document).ready(function() { 
                        "use strict"; 
                        var toggles = document.querySelectorAll(".c-hamburger"); 
                        for (var i = toggles.length - 1; i >= 0; i--) { 
                            var toggle = toggles[i]; 
                            toggleHandler(toggle); 
                        }; 
                        function toggleHandler(toggle) { 
                            toggle.addEventListener("click", function(e) { 
                                e.preventDefault(); 
                                (this.classList.contains("is-active") === true) ? this.classList.remove("is-active"): this.classList.add("is-active"); 
                            }); 
                            toggle.addEventListener("touchstart", function(e) { 
                                e.preventDefault(); 
                                (this.classList.contains("is-active") === true) ? this.classList.remove("is-active"): this.classList.add("is-active"); 
                            }); 
                        } 
                        $('.c-hamburger').sidr({ 
                            name: 'sidr-right',
                            side: 'right',
                            body: '#content',
                            displace: false 
                        }); 
                    }); 
                </script>
            </div>

        <div id="sidr-right" class="sidr right">
            <?php include ROOT_DIR . 'osta/inc/staff-mobile-menu.html'; ?>
        </div>    	
    <!-- END Header -->



    <div id="pjax-container" class="<?php if ($_POST) echo 'no-pjax'; ?>">
<?php } else {
    header('X-PJAX-Version: ' . GIT_VERSION);
    if ($pjax = $ost->getExtraPjax()) { ?>
    <script type="text/javascript">
    <?php foreach (array_filter($pjax) as $s) echo $s.";"; ?>
    </script>
    <?php }
    foreach ($ost->getExtraHeaders() as $h) {
        if (strpos($h, '<script ') !== false)
            echo $h;
    } ?>
    <title><?php echo ($ost && ($title=$ost->getPageTitle()))?$title:'osTicket :: '.__('Staff Control Panel'); ?></title><?php
} # endif X_PJAX ?>
<!--osta-->
   
<!--    <ul id="nav">
<?php include STAFFINC_DIR . "templates/navigation.tmpl.php"; ?>
    </ul>-->
   
    <div id="sub_nav-wrap">
		<ul id="sub_nav">
			<?php include STAFFINC_DIR . "templates/sub-navigation.tmpl.php"; ?>
		</ul>
	</div>
    <div id="content" class="<?php echo basename($_SERVER['PHP_SELF'], '.php');  ?>">
        <?php if($errors['err']) { ?>
            <div id="msg_error"><?php echo $errors['err']; ?></div>
        <?php }elseif($msg) { ?>
            <div id="msg_notice"><?php echo $msg; ?></div>
        <?php }elseif($warn) { ?>
            <div id="msg_warning"><?php echo $warn; ?></div>
        <?php }
        foreach (Messages::getMessages() as $M) { ?>
            <div class="<?php echo strtolower($M->getLevel()); ?>-banner"><?php
                echo (string) $M; ?></div>
<?php   } ?>
