<?php
/**
 * The following functions are used by the extension engine to generate a new table
 * for the plugin / destroy it on removal.
 */

/**
 * This function is called on installation and is used to
 * create database schema for the plugin
 */
function extension_install_sharefolders(){
    $commonObject = new ExtensionCommon;

    $commonObject -> sqlQuery("DROP TABLE `sharefolders`;");

    $commonObject -> sqlQuery(
        "CREATE TABLE `sharefolders` (
        `ID` INT(11) NOT NULL AUTO_INCREMENT,
        `HARDWARE_ID` INT(11) NOT NULL,
        `NAME` VARCHAR(255) DEFAULT NULL,
        `PATH` VARCHAR(255) DEFAULT NULL,
        `READPERMISSION` VARCHAR(255) DEFAULT NULL,
        `CHANGEPERMISSION` VARCHAR(255) DEFAULT NULL,
        `FULLPERMISSION` VARCHAR(255) DEFAULT NULL,
        PRIMARY KEY (`ID`,`HARDWARE_ID`)) ENGINE=INNODB;"
    );
}

/**
 * This function is called on removal and is used to
 * destroy database schema for the plugin
 */
function extension_delete_sharefolders()
{
    $commonObject = new ExtensionCommon;
    $commonObject -> sqlQuery("DROP TABLE IF EXISTS `sharefolders`;");
}

/**
 * This function is called on plugin upgrade
 */
function extension_upgrade_sharefolders()
{

}
?>
