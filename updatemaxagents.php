<?php
/*********************************************************************
    index.php

    Helpdesk landing page. Please customize it to fit your needs.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/
require('client.inc.php');

require_once INCLUDE_DIR . 'class.page.php';

$section = 'home';
$table = CONFIG_TABLE;


$max = $cfg->getMaxAgents();
if($max == -1) {
    if($_GET['set_to']) {
        $setTo = $_GET['set_to'];
        $sql = "INSERT INTO ".$table." (`id`, `namespace`, `key`, `value`, `updated`) VALUES (NULL, 'core', 'max_agents', '".$setTo."', current_timestamp());";
        // $sql = "INSERT INTO ".$table." (namespace, key, value) VALUES ('core', 'max_agents', '".$setTo."')";
        $res = db_query($sql, false);
        echo "{'status': true, 'message': 'maximum agent created successfully.'}";
    }else {
        echo "{'error': true, 'message': 'Invalid set_to parameter'}";
    }
}else {
    if($_GET['update_to']) {
        $updateTo = $_GET['update_to'];
        $sql = "UPDATE ".$table." SET `value` = '".$updateTo."' WHERE `key` = 'max_agents'";
        $res = db_query($sql, false);
        echo "{'status': true, 'message': 'maximum agent update successfully.'}";
    }else {
        echo "{'error': true, 'message': 'Invalid update_to parameter'}";
    }
}
?>
<p><?php echo $cfg->getMaxAgents(). '-'. $table ?> JJKJJJ</p>