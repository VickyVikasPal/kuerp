<?php
namespace App\Common;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Email;
use App\Models\EmailStatus;
use App\Models\OutboundEmailText;
use App\Models\InboundEmailSetup;
use App\Models\InboundEmailText;
use App\Common\SoftdevLog;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Auth;
use SetEnv;
use App\Common\Datetime\TimeDate;
use Illuminate\Support\Facades\DB;
use App\Common\Utils;

class SoftdevMail
{
    use SoftdevLog;
    public function email()
    {
        return view("emails.mail");
    }
    public function sendMail($subject, $to, $cc, $bcc, $attachment, $html, $request_from = '', $module_name = '')
    {
        $datetime = new TimeDate();
        $data = array(
            'subject' => $subject,
            'to' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'attachment' => $attachment,
            'html' => $html,
            'request_from' => $request_from,
        );
        $this->LogDebug('Begin: app->common->SoftdevMail->sendMail()', ['data' => $data]);

        require base_path("vendor/autoload.php");
        
        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        $email = new Email();
        $result = $email->getDbPropertyValue($email->table, array('deleted' => 0));
        if(empty($result)){
            $this->LogCritical("Failed: app->common->SoftdevMail->sendMail()'");
            return  false;
        }

        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $result->smtpserver; //'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $result->smtpuser; //'test@Softdevinfo.com';   //  sender username
            $mail->Password = $result->smtppassword; //'Test@123';       // sender password
            $mail->SMTPSecure = 'tls'; // encryption - ssl/tls
            $mail->Port = $result->smtpport; // port - 587/465
            if(is_array($data['to'])){
            $mail->addReplyTo('test@Softdevinfo.com', 'no-reply');
            }
            $mail->setFrom($result->fromaddress, $result->fromname);
            if(is_array($data['to'])){
                foreach ($data['to'] as $key => $value) {
                    $mail->addAddress($value);
                }
                
            }else{
                $mail->addAddress($data['to']);
            }

            if(is_array($data['cc'])){
                foreach ($data['cc'] as $key => $value) {
                    $mail->addCC($value);
                }
                
            }else{
                $mail->addCC($data['cc']);
            }
            
            if ($data['bcc'] != '') {
                $mail->addBCC($data['bcc']);
            }

            //   $mail->addReplyTo('test@Softdevinfo.com', 'EatsPro');

            if ($data['attachment'] != '') {
                if(is_array($data['attachment'])){

                    foreach ($data['attachment'] as $key => $value) {
                        
                        $attachmentPath = public_path($value['file_path'].$value['file_name']);
                        $fileName = explode("_", basename($attachmentPath));
                        $fName = implode('_', array_slice($fileName, 1));

                        $mail->addAttachment($attachmentPath, $fName);
                    }
                }else{
                    $attachmentPath = public_path($data['attachment']);
                    $mail->addAttachment($attachmentPath, basename($attachmentPath));
                }
                
            }

            $mail->isHTML(true); // Set email content format to HTML

            $mail->Subject = $data['subject'];
            $mail->Body = $data['html'];
            if (!$mail->send()) {
                
                $this->LogInfo('Failed: app->common->SoftdevMail->sendMail()', ['error' => $mail->ErrorInfo]);
                if($module_name == 'ApplicationEmails'){

                    $outbound = new OutboundEmailText();
                    $outbound->to_addrs = implode("|",$data['to']);
                    $outbound->cc_addrs = implode("|",$data['cc']);
                    $outbound->subject = $data['subject'];
                    $outbound->description_html = $data['html'];
                    $outbound->description = $data['html'];
                    $outbound->mail_date = $datetime->get_gmt_db_datetime();
                    $outbound->status = 'Fail';
                    $outbound->save();
                }
               // return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
               return false;
            }
            else {
                //$this->LogInfo('ModuleName is' . $module_name);
                $res = back()->with("success", "Email has been sent.");
                $emailLog = new EmailStatus();
                $emailLog->fromname = $result->fromname;
                $emailLog->fromaddress = $result->fromaddress;
                $emailLog->smtpuser = $result->smtpuser;
                $emailLog->subject = $data['subject'];
                if(is_array($data['to']) && is_array($data['cc'])){
                    $emailLog->to = implode("|",$data['to']);
                    $emailLog->cc = implode("|",$data['cc']);
                    $emailLog->bcc = $data['bcc'];
                    $emailLog->attachment = json_encode($data['attachment']);
                }else{
                    $emailLog->to = $data['to'];
                    $emailLog->cc = $data['cc'];
                    $emailLog->bcc = $data['bcc'];
                    $emailLog->attachment = $data['attachment'];
                }
                
                
                $emailLog->html = $data['html'];
                $emailLog->request_from = $data['request_from'];
                $emailLog->date_sent = date('Y-m-d');
                $emailLog->status = 'Done';
                $emailLog->reply_to_status = '';
                $emailLog->save();

                if($module_name == 'ApplicationEmails'){

                    $outbound = new OutboundEmailText();
                    $outbound->to_addrs = implode("|",$data['to']);
                    $outbound->cc_addrs = implode("|",$data['cc']);
                    $outbound->subject = $data['subject'];
                    $outbound->description_html = $data['html'];
                    $outbound->description = $data['html'];
                    $outbound->attached_file = json_encode($data['attachment']);
                    $outbound->mail_date = $datetime->get_gmt_db_datetime();
                    $outbound->status = 'Success';
                    $outbound->save();
                }

                $this->LogInfo('End: app->common->SoftdevMail->sendMail()', ['email' => $mail]);
                return 'Email has been sent';
            }
        }
        catch (\Throwable $e) {
            $this->LogCritical('Failed: app->common->SoftdevMail->sendMail()', ['error' => $e->getMessage()]);
            return false;
          //  return back()->with('error', 'Message could not be sent.');
        }
    }

    
    public function synchronzeMail($mailBox)
    {
     $datetime = new TimeDate();           
     $mail_id  = Utils::create_guid();
        
        $user = DB::table('users')->where('role_id', '1')->where('deleted', '0')->where('branch_id', $mailBox['branch_id'])->get();
       
        try{
            
       $addInbox = DB::table('inbound_email_text')->insert(
          array(
                'id'=>$mail_id,
                'name'=>$mailBox['from_name'],
                'date_entered' => $datetime->get_gmt_db_datetime(),
                'date_modified' => $datetime->get_gmt_db_datetime(),
                'created_by' => $user[0]->id,
                'modified_user_id' => $user[0]->id,
                'from_addr' => $mailBox['from_mail'],
                'to_addrs' => $mailBox['to_mail'],
                'subject' => $mailBox['subject'],
                'has_attachment' => $mailBox['has_attachment'],
                'description_html' => $mailBox['mail_body'],
                'description' => $mailBox['raw_body'],
                'mail_date' => $mailBox['mail_date'],
                'attached_file' => json_encode($mailBox['files_arr']),
                'branch_id' => $mailBox['branch_id']
            )
          );

          if($addInbox){
            $this->LogInfo("mail received done");
          }else{
            $this->LogInfo("new mail not found");
          }
        }
        catch (\Throwable $e)
        {
            $this->LogInfo($e);
        }
    }

    public function synchronizedMail($default_branch='', $exception='')
    {
        if($default_branch !=''){
       // $this->LogInfo("mail funciton call". $default_branch);
        $current_date = date('d.m.Y');
        $config = InboundEmailSetup::where('deleted', 0)->where('branch_id', $default_branch)->get();
        $imapConfig = $config->toArray();

        $host = '';
        $port = '';
        $encryp = '';
        $user_name = '';
        $password = '';
         if(count($imapConfig) > 0){
            $host = $imapConfig[0]['server_url'];
            $port = $imapConfig[0]['port'];
            $encryp = $imapConfig[0]['mailbox_type'];
            $user_name = $imapConfig[0]['email_user'];
            $password = $imapConfig[0]['email_password'];

        }else{
            $host="imap.gmail.com";
            $port=993;
            $encryp="ssl";
            $user_name="test@Softdevinfo.com";
            $password="Test@123";
        }       

        $client = Client::account('default');
        $client = Client::make([
            'host'          => $host,
            'port'          => $port,
            'encryption'    => $encryp,
            'validate_cert' => true,
            'username'      => $user_name,
            'password'      => $password,
            'protocol'      => 'imap',
            'authentication' => null,
            'proxy' => [
                'socket' => null,
                'request_fulluri' => false,
                'username' => null,
                'password' => null,
            ],
            "timeout" => 30,
            "extensions" => []
        ]);
        $client->connect();
                    
        $folders =  $client->getFolders('INBOX');
            
        //Loop through every Mailbox
            /** @var \Webklex\PHPIMAP\Folder $folder */
            
            foreach($folders as $folder){
                //Get all Messages of the current Mailbox $folder ->unseen()
                /** @var \Webklex\PHPIMAP\Support\MessageCollection $messages */ 
                            
                $messages = $folder->messages()->all()->markAsRead()->since($current_date)->unseen()->get();

                /** @var \Webklex\PHPIMAP\Message $message */
                foreach($messages as $message){
                    
                    $date_obj = $message->getDate();
                    $date_arr = $date_obj[0]->toArray();
                    $files_arr = array();
                    
                    if ($message->hasAttachments()) {
                        $attachments = $message->getAttachments();
                        
                    foreach ($attachments as $attachment) {
                        $fileExt = $attachment->getExtension();                        
                        $files = $attachment->getAttributes();
                        // Save or process the attachment as needed
                        // For example, you can save the attachment to a local directory
                        if (!is_dir(public_path('uploads/mail_attachments'))) {
                            mkdir(public_path('uploads/mail_attachments'), 0775, true);
                        }
                        $filePath = 'uploads/mail_attachments/'.time().'_'.$files['name'];
                        $attachment->save(public_path('uploads/mail_attachments/'), time().'_'.$files['name']);
                       $filename = time().'_'.$files['name'];
                        array_push($files_arr, array('file_path'=>$filePath, 'file_name'=>$filename));
                        
                    }
                }
                 
                    $data = array(
                       'uid'=>$message->getUid(),
                       'from_name'=>$message->getFrom()[0]->personal,
                       'from_mail'=>$message->getFrom()[0]->mail,
                       'to_name'=>$message->getTo()[0]->personal,
                       'to_mail'=>$message->getTo()[0]->mail,
                       'subject'=>$message->getSubject()[0],
                       'has_attachment'=>$message->getAttachments()->count() > 0 ? 'yes' : 'no',
                       'mail_body'=>$message->getHTMLBody(),
                       'attach_file'=>$message->getAttachments(),
                       'raw_body'=>$message->getRawBody(),
                       'mail_date'=>$date_arr['formatted'],
                       'branch_id'=>$default_branch,
                       'files_arr'=>$files_arr
                   );

                   self::synchronzeMail($data);
                   
                  
                  /*  echo $message->getSubject().'<br />';
                    echo 'Attachments: '.$message->getAttachments()->count().'<br />';
                    echo $message->getHTMLBody(); 

                    //Move the current Message to 'INBOX.read'
                     if($message->move('INBOX.read') == true){
                        echo 'Message has ben moved';
                    }else{
                        echo 'Message could not be moved';
                    } */
                }
                
                
            }
            echo "Email Synchronizing Done"; 
            $this->LogInfo("Email Synchronizing Done ");
        }else{
            echo $exception;
            $this->LogInfo("mail funciton call ". $exception);
        }
    }

}
