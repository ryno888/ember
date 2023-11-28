<?php
namespace sessions;

class quote_wizard extends \Kwerqy\Ember\com\session\intf\session_helper {

    public string $id;
    public array $quote_item_arr = [];
    public string $quote_nr = '';
    public string $quo_email = '';
    public bool $quo_is_complete = false;

    public string $per_firstname = '';
    public string $per_lastname = '';
    public string $per_contactnr = '';
    public string $per_company_name = '';
    public string $per_tellnr_work = '';
    public string $per_address_shipping = '';
    public string $per_address_billing = '';


    //--------------------------------------------------------------------------------
    protected function __construct($options = []) {

        $this->quote_nr = $this->generate_quote_number();
        $this->id = \Kwerqy\Ember\com\str\str::generate_id();

        parent::__construct($options);
    }
    //--------------------------------------------------------------------------------
    private function generate_quote_number() {
        $quote_nr_parts = [];
        $quote_nr_parts[] = "QUO";
        $quote_nr_parts[] = sizeof(glob(DIR_QUOTES."*"));
        $quote_nr_parts[] = time();
        return implode("-", $quote_nr_parts);
    }
    //--------------------------------------------------------------------------------
    public function set_quote_item(array $data, $options = []) {
        $options = array_merge([
            "index" => \Kwerqy\Ember\com\str\str::generate_id()
        ], $options);

        $data = array_merge([
            "index" => $options["index"],
            "file_directory" => $this->get_save_directory()."/uploads/{$options["index"]}",
            "qui_supplier" => "",
            "qui_code" => "",
            "qui_qty" => 0,
            "qui_note" => "",
        ], $data);


        $obj = new \stdClass();
        $obj->index = $data["index"];
        $obj->file_directory = $data["file_directory"];
        $obj->qui_supplier = $data["qui_supplier"];
        $obj->qui_code = $data["qui_code"];
        $obj->qui_qty = $data["qui_qty"];
        $obj->qui_note = $data["qui_note"];

        $this->quote_item_arr[$options["index"]] = $obj;
    }
    //--------------------------------------------------------------------------------
    public function remove_quote_item($index) {
        if(isset($this->quote_item_arr[$index]))
            unset($this->quote_item_arr[$index]);
    }
    //--------------------------------------------------------------------------------
    public function get_quote_item($index) {
        if(isset($this->quote_item_arr[$index]))
            return $this->quote_item_arr[$index];
    }
    //--------------------------------------------------------------------------------
    protected function on_clear($options = []) {

        $options = array_merge([
            "delete" => false
        ], $options);

        if($options["delete"]){
            \Kwerqy\Ember\com\os\os::removedir($this->get_save_directory());
        }

        $this->quote_item_arr = [];
        $this->quote_nr = '';
        $this->quo_email = '';
        $this->quo_is_complete = false;
    }
    //--------------------------------------------------------------------------------
    public function get_save_directory() {
        return DIR_QUOTES."/{$this->quote_nr}";
    }
    //--------------------------------------------------------------------------------
    public function set_complete() {
        file_put_contents(DIR_QUOTES."/{$this->quote_nr}/is_complete", "done");
    }
    //--------------------------------------------------------------------------------
    public function is_complete() {

        if(file_exists(DIR_QUOTES."/{$this->quote_nr}/is_complete")) return true;

        return false;
    }
    //--------------------------------------------------------------------------------
    public function save() {

        $filename = $this->get_save_directory()."/quote_data";
        $data_arr = [];
        $data_arr["id"] = $this->id;
        $data_arr["quote_nr"] = $this->quote_nr;
        $data_arr["quo_email"] = $this->quo_email;
        $data_arr["quote_item_arr"] = $this->quote_item_arr;
        $data_arr["quo_is_complete"] = $this->quo_is_complete;

        $data_arr["per_firstname"] = $this->per_firstname;
        $data_arr["per_lastname"] = $this->per_lastname;
        $data_arr["per_contactnr"] = $this->per_contactnr;
        $data_arr["per_company_name"] = $this->per_company_name;
        $data_arr["per_tellnr_work"] = $this->per_tellnr_work;
        $data_arr["per_address_shipping"] = $this->per_address_shipping;
        $data_arr["per_address_billing"] = $this->per_address_billing;

        \Kwerqy\Ember\com\os\os::mkdir(dirname($filename));

        $quote_data = fopen($filename, "w");
        fwrite($quote_data, json_encode($data_arr));
        fclose($quote_data);

        return $filename;
    }
    //--------------------------------------------------------------------------------
    public function load($quote_nr, $options = []) {

        $options = array_merge([
            "update" => true
        ], $options);

        $filename = DIR_QUOTES."/{$quote_nr}/quote_data";

        if(file_exists($filename)){
            $data = json_decode(file_get_contents($filename));
            $fn_load_field = function($name)use($data){
                if(property_exists($data, $name))
                    $this->{$name} = $data->{$name};
            };

            $fn_load_field("id");
            $fn_load_field("quote_nr");
            $fn_load_field("quo_email");
            $fn_load_field("quo_is_complete");

            $fn_load_field("per_firstname");
            $fn_load_field("per_lastname");
            $fn_load_field("per_contactnr");
            $fn_load_field("per_company_name");
            $fn_load_field("per_tellnr_work");
            $fn_load_field("per_address_shipping");
            $fn_load_field("per_address_billing");

            $this->quote_item_arr = [];
            foreach ($data->quote_item_arr as $quote_item){
                $this->quote_item_arr[$quote_item->index] = $quote_item;
            }
            if($options["update"]) $this->update();

            return true;
        }
    }
    //--------------------------------------------------------------------------------
}