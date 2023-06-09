<?php

namespace Kwerqy\Ember\com\os\filetype_group\intf;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
abstract class filetype_group extends \Kwerqy\Ember\com\intf\standard {
	//--------------------------------------------------------------------------------
    public function get_mime_type_str() {
        return implode(", ", $this->get_mime_type_arr());
    }
	//--------------------------------------------------------------------------------
	public function has_extension($extension) {
		// checks if we have this extension in the group
		foreach ($this->get_extension_arr() as $allowed_extension) {
			if ($allowed_extension == $extension) return true;
		}

		// done
		return false;
	}
	//--------------------------------------------------------------------------------

    public function get_mime_type_arr(): array {
        $available_classes_arr = $this->get_available_classes();

        $return_arr = [];
        foreach ($available_classes_arr as $available_class){
            $return_arr[] = $available_class->get_mimetype();
        }

        return $return_arr;
    }
	//--------------------------------------------------------------------------------
    public function get_extension_arr(): array {
        $available_classes_arr = $this->get_available_classes();

        $return_arr = [];
        foreach ($available_classes_arr as $available_class){
            $return_arr[] = $available_class->get_extension();
        }

        return $return_arr;
    }
	//--------------------------------------------------------------------------------

    /**
     * @return \Kwerqy\Ember\com\os\filetype\intf\filetype[]
     */
    abstract public function get_available_classes(): array;
	//--------------------------------------------------------------------------------
}