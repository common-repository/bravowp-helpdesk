<?php

function bwhd_mailboxes_startmailboxescheckjobfromschedule()
{

        $params = array();
        $params["testmode"] = 0;
        bwhd_mailboxes_startmailboxescheckjob( $params );

}


//Params -> "testmode" bool
function bwhd_mailboxes_startmailboxescheckjob( $params )
{

        $htmlTestResult = "";

        $params_testMode = $params["testmode"];

        bwhd_systemlog_addentry("FUNCTION","bwhd_mailboxes_startmailboxescheckjob","Start");
        $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep'>Process Started.</span>";

        if ( !function_exists('imap_open') )
        {
                bwhd_systemlog_addentry("ERROR","bwhd_mailboxes_startmailboxescheckjob","Imap is not enabled");
                $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep bwhd-admin-settings-emailtoticket-teststep-error'>Error: IMAP PHP extension is not installed. Please, enable the IMAP extension and try again.</span>";
                return $htmlTestResult;
        }

        $username = get_option( "bwhd_emailtoticket_username", "" );
        $password = get_option( "bwhd_emailtoticket_password", "" );
        $server = get_option( "bwhd_emailtoticket_server", "" );
        $port = get_option( "bwhd_emailtoticket_port", "" );

        if ($username == "")
        {
                bwhd_systemlog_addentry("WARNING","bwhd_mailboxes_startmailboxescheckjob","var username is empty. Aborting");
                $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep bwhd-admin-settings-emailtoticket-teststep-error'>Error: Username cannot be empty.</span>";
                return $htmlTestResult;
        }

        if ($password == "")
        {
                bwhd_systemlog_addentry("WARNING","bwhd_mailboxes_startmailboxescheckjob","var password is empty. Aborting");
                $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep bwhd-admin-settings-emailtoticket-teststep-error'>Error: Password cannot be empty.</span>";
                return $htmlTestResult;
        }

        if ($server == "")
        {
                bwhd_systemlog_addentry("WARNING","bwhd_mailboxes_startmailboxescheckjob","var server is empty. Aborting");
                $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep bwhd-admin-settings-emailtoticket-teststep-error'>Error: Server cannot be empty.</span>";
                return $htmlTestResult;
        }

        if ($port == "")
        {
                bwhd_systemlog_addentry("WARNING","bwhd_mailboxes_startmailboxescheckjob","var port is empty. Aborting");
                $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep bwhd-admin-settings-emailtoticket-teststep-error'>Error: Port cannot be empty.</span>";
                return $htmlTestResult;
        }

        $mailbox_connection = bwhd_mailboxes_connect( $server, $username , $password, $port );

        if ( $mailbox_connection == false )
        {
                $connectionImapError = imap_last_error();
                imap_errors();
                imap_alerts();
                bwhd_systemlog_addentry("WARNING","bwhd_mailboxes_startmailboxescheckjob","Could not connect to server, error message: " . $connectionImapError);
                $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep bwhd-admin-settings-emailtoticket-teststep-error'>Error: Could not connect to specified server. Message: " . $connectionImapError . "</span>";
                return $htmlTestResult;
        }

        $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep'>Succesfully connected to the server.</span>";

        $messagesProcessed = bwhd_mailboxes_processmessages( $mailbox_connection, $params_testMode );

        $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep'>New Emails found: " . $messagesProcessed  . "</span>";
        $htmlTestResult .= "<span class='bwhd-admin-settings-emailtoticket-teststep'>Process finished correctly, all looks good!</span>";

        bwhd_systemlog_addentry("FUNCTION","bwhd_mailboxes_startmailboxescheckjob","End");

        return $htmlTestResult;

}


function bwhd_mailboxes_connect( $serverAddress, $username, $password, $port )
{

        $serviceType = get_option( "bwhd_emailtoticket_servicetype", "custom" );
        if ( $serviceType == "custom" )
        {
                $connectionString = '{'. $serverAddress . ':' . $port . '/notls/norsh/novalidate-cert}';
        }
        elseif (  $serviceType == "gmail" )
        {
                $connectionString = "{imap.gmail.com:993/imap/ssl}Inbox";
        }

        bwhd_systemlog_addentry("FUNCTION","bwhd_mailboxes_connect","Connection String: " . $connectionString);
        return @imap_open( $connectionString, $username, $password, NULL, 1 );

}

function bwhd_mailboxes_processmessages( $mailbox_connection, $testmode )
{


        bwhd_systemlog_addentry("FUNCTION","bwhd_mailboxes_processmessages","Test mode: " . $testmode);

        $inboxList = imap_search($mailbox_connection,'UNSEEN');

        bwhd_systemlog_addentry("FUNCTION","bwhd_mailboxes_processmessages","Found Messages: " . count($inboxList));

        if ($inboxList == false)
        {
                return 0;
        }


        $inboxContentArray = array();

        foreach($inboxList as $foundEmailId) {

                $email_date =  imap_headerinfo($mailbox_connection, $foundEmailId)->date;
                $email_subject = imap_headerinfo($mailbox_connection, $foundEmailId)->subject;
                $email_fromname = imap_headerinfo($mailbox_connection, $foundEmailId)->from[0]->mailbox;  //personal;
                $email_fromaddress = imap_headerinfo($mailbox_connection, $foundEmailId)->from[0]->mailbox . "@" . imap_headerinfo($mailbox_connection, $foundEmailId)->from[0]->host;

                $email_body = (imap_fetchbody($mailbox_connection,$foundEmailId,1.1));
                if($email_body == '')
                {
                        $email_body = (imap_fetchbody($mailbox_connection,$foundEmailId,1));
                }
                $email_body = utf8_encode(quoted_printable_decode($email_body));

                //bwhd_systemlog_addentry("FUNCTION","bwhd_mailboxes_processmessages","Date:" . $email_date . ":::Subject:" . $email_subject . ":::FromName:" . $email_fromname . ":::FromAddress:" . $email_fromaddress . ":::Message:" . $email_body);

                if ($testmode == 0)
                {

                        //create new support ticket
                        $createTicketsParams = array();
                        $createTicketsParams["ticket_title"] = $email_subject;
                        $createTicketsParams["ticket_problem"] = $email_body;
                        $createTicketsParams["category_id"] = 0;
                        $createTicketsParams["priority_id"] = 0;
                        $createTicketsParams["ticket_assigned_userid"] = 0;
                        $createTicketsParams["ticket_customer_userid"] = 0;
                        $createTicketsParams["ticket_customer_fullname"] = $email_fromname;
                        $createTicketsParams["ticket_customer_email"] = $email_fromaddress;
                        $createTicketsParams["ticket_sla_resp_date"] = '';
                        $createTicketsParams["woocommerce_product_id"] = 0;
                        $createTicketsParams["ticket_creation_mode"] = 'email';
                        $CreatedTicketId = bwhd_controllers_tickets_insert( $createTicketsParams );

                        //send notification about the new created ticket

                        //delete the email
                        imap_delete($mailbox_connection, $foundEmailId);

                }

        }

        //needed for deletion of email messages
        imap_expunge($mailbox_connection);

        return count($inboxList);

}


?>
