<?php

/*
 *  iNET LMS
 *
 *  (C) Copyright 2001-2012 LMS Developers
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License Version 2 as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 *  USA.
 *
 */



$DB->BeginTrans();

$DB->Execute("DROP VIEW IF EXISTS customersview;");
$DB->Execute("DROP VIEW IF EXISTS contractorview;");


if (!$DB->GetOne("SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? ;",array($DB->_dbname,'customers','url'))) 
    $DB->Execute("ALTER TABLE customers ADD url VARCHAR( 255 ) NULL DEFAULT NULL ;");

if (!$DB->GetOne("SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? ;",array($DB->_dbname,'customers','ctying'))) 
    $DB->Execute("ALTER TABLE customers ADD ctying INT (11) NOT NULL DEFAULT 0;"); 	// data rozwiąznia umowy

if (!$DB->GetOne("SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = ? AND TABLE_NAME = ? AND COLUMN_NAME = ? ;",array($DB->_dbname,'customers','dtying'))) 
    $DB->Execute("ALTER TABLE customers ADD dtying TEXT DEFAULT NULL;");		// przyczyna/opis rozwiązania umowy


$DB->Execute("
CREATE VIEW customersview AS
SELECT c.* FROM customers c
WHERE NOT EXISTS (
SELECT 1 FROM customerassignments a
JOIN excludedgroups e ON (a.customergroupid = e.customergroupid)
WHERE e.userid = lms_current_user() AND a.customerid = c.id) 
AND c.type IN ('0','1');
");

$DB->Execute("
CREATE VIEW contractorview AS
SELECT c.* FROM customers c
WHERE c.type = '2';
");


$DB->Execute("UPDATE dbinfo SET keyvalue = ? WHERE keytype = ?", array('2014061400', 'dbvex'));
$DB->CommitTrans();

?>