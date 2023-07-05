<?php

namespace Kwerqy\Ember\com\email;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class email extends \Kwerqy\Ember\com\intf\standard {

    /**
     * @var CodeIgniter\Email
     */
    protected $email;

    protected $to_email;
    protected $to_name;

	//--------------------------------------------------------------------------------
    public function __construct() {
        
        $this->email = \Config\Services::email(); 
        $this->email->sendMultipart = false;
        $this->email->setMailType("html");

        $this->email->fromName = getenv("email.fromName");
        $this->email->fromEmail = getenv("email.fromEmail");
        $this->email->setFrom(getenv("email.fromEmail"), getenv("email.fromName"));

    }
    //--------------------------------------------------------------------------------
    public function set_from($from, $name = '') {
        $this->email->setFrom($from, $name);
    }
    //--------------------------------------------------------------------------------
    public function add_bcc($bcc) {

        $bcc = $this->validate_email($bcc);

        $this->email->setBCC($bcc);
    }
    //--------------------------------------------------------------------------------
    public function add_cc($cc) {

        $cc = $this->validate_email($cc);

        $this->email->setCC($cc);
    }
    //--------------------------------------------------------------------------------
    public function set_to($to, $name = '') {

        $to = $this->validate_email($to);

        $this->to_name = $name;
        $this->to_email = $to;

        $this->email->setTo($to);
    }
    //--------------------------------------------------------------------------------
    private function validate_email($email) {
        if(\Kwerqy\Ember\Ember::is_dev()) $email = getenv("ember.email.developer");
        if(\Kwerqy\Ember\Ember::is_test()) $email = getenv("ember.email.developer");

        if(!$email) throw new \CodeIgniter\Exceptions\CriticalError("No email supplied");

        return $email;
    }
    //--------------------------------------------------------------------------------
    public function set_subject($subject) {
        $this->email->setSubject($subject);
    }
    //--------------------------------------------------------------------------------
    public function set_body($mixed, $options = []) {

        $options = array_merge([
            "template" => DIR_COM."/email/template/template.html"
        ], $options);

        if(!is_string($mixed) && is_callable($mixed)) $mixed = $mixed($this);

        if($options["template"]){

            $template = file_get_contents($options["template"]);

            $logo = \Kwerqy\Ember\com\asset\asset::get_logo_slim_filename();
            $this->email->attach($logo);
            $cid = $this->email->setAttachmentCID($logo);

            $template = str_replace("%logo%", \Kwerqy\Ember\com\ui\ui::make()->image("cid:$cid", ["@align" => "center", "@border" => "0", "@width" => "250", "@style" => "outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 250px;"]), $template);
            $template = str_replace("%heading%", ($this->to_name ? "Dear {$this->to_name}" : ""), $template);
            $template = str_replace("%content%", $mixed, $template);
            $template = str_replace("%company_tellnr%", getenv("ember.tell.nr.contact"), $template);
            $template = str_replace("%company_email%", getenv("ember.email.contact"), $template);
            $template = str_replace("%company_website%", getenv("ember.website"), $template);
            $template = str_replace("%company_copyright%", \Kwerqy\Ember\Ember::get_copyright(), $template);

            $mixed = $template;

        }

        $this->email->setMessage($mixed);
    }
    //--------------------------------------------------------------------------------
    public function send() {

        $result = $this->email->send();
        if(!$result) throw new \CodeIgniter\Exceptions\AlertError($this->email->printDebugger());

        return $result;
    }
    //--------------------------------------------------------------------------------
}