<?php

namespace Kwerqy\Ember\com\os\filetype_group;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 */
class images extends \Kwerqy\Ember\com\os\filetype_group\intf\filetype_group {

	//--------------------------------------------------------------------------------
    public function get_available_classes(): array {
        return [
            \Kwerqy\Ember\com\os\filetype\gif::make(),
            \Kwerqy\Ember\com\os\filetype\jpeg::make(),
            \Kwerqy\Ember\com\os\filetype\jpg::make(),
            \Kwerqy\Ember\com\os\filetype\png::make(),
            \Kwerqy\Ember\com\os\filetype\tiff::make(),
        ];
    }
	//--------------------------------------------------------------------------------
}